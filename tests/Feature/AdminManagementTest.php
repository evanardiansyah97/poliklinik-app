<?php

namespace Tests\Feature;

use App\Models\Poli;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_welcome_message(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee('Halo Selamat Datang Admin');
    }

    public function test_admin_obat_prices_are_displayed_and_entered_in_rupiah(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
        $obat = Obat::create([
            'nama_obat' => 'Paracetamol',
            'kemasan' => 'Tablet',
            'harga' => 12500,
        ]);

        $this->actingAs($admin)
            ->get(route('obat.index'))
            ->assertOk()
            ->assertSee('Rp 12.500');

        $this->get(route('obat.create'))
            ->assertOk()
            ->assertSee('Harga (Rupiah)')
            ->assertSee('Rp');

        $this->get(route('obat.edit', $obat))
            ->assertOk()
            ->assertSee('Harga (Rupiah)')
            ->assertSee('value="12500"', false);

        $this->from(route('obat.create'))
            ->post(route('obat.store'), [
                'nama_obat' => 'Obat harga negatif',
                'kemasan' => 'Tablet',
                'harga' => -1,
            ])
            ->assertSessionHasErrors('harga');
    }

    public function test_admin_can_manage_polis_dokters_and_pasien(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($admin);

        $this->get(route('polis.index'))
            ->assertOk()
            ->assertSee('Manajemen Poli')
            ->assertSee('Manajemen Dokter')
            ->assertSee('Manajemen Pasien');

        $this->post(route('polis.store'), [
            'nama_poli' => 'Poli Umum',
            'keterangan' => 'Pemeriksaan umum',
        ])->assertRedirect(route('polis.index'));

        $poli = Poli::where('nama_poli', 'Poli Umum')->firstOrFail();

        $this->get(route('polis.create'))->assertOk();
        $this->get(route('polis.edit', $poli))->assertOk();

        $this->put(route('polis.update', $poli), [
            'nama_poli' => 'Poli Penyakit Dalam',
            'keterangan' => 'Pemeriksaan penyakit dalam',
        ])->assertRedirect(route('polis.index'));

        $this->get(route('dokter.create'))->assertOk();

        $this->post(route('dokter.store'), [
            'nama' => 'Dokter Satu',
            'email' => 'dokter@example.com',
            'password' => 'password',
            'id_poli' => $poli->id,
        ])->assertRedirect(route('dokter.index'));

        $dokter = User::where('email', 'dokter@example.com')->firstOrFail();

        $this->get(route('dokter.index'))->assertOk()->assertSee('Dokter Satu');
        $this->get(route('dokter.edit', $dokter))->assertOk();

        $this->put(route('dokter.update', $dokter), [
            'nama' => 'Dokter Dua',
            'email' => 'dokter@example.com',
            'password' => '',
            'id_poli' => $poli->id,
        ])->assertRedirect(route('dokter.index'));

        $this->get(route('pasien.create'))->assertOk();

        $this->post(route('pasien.store'), [
            'nama' => 'Pasien Satu',
            'alamat' => 'Jl. Sehat No. 1',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'email' => 'pasien@example.com',
            'password' => 'password',
        ])->assertRedirect(route('pasien.index'));

        $pasien = User::where('email', 'pasien@example.com')->firstOrFail();
        $this->assertSame('pasien', $pasien->role);
        $this->assertNotEmpty($pasien->no_rm);

        $this->get(route('pasien.index'))->assertOk()->assertSee('Pasien Satu');
        $this->get(route('pasien.edit', $pasien))->assertOk();

        $this->put(route('pasien.update', $pasien), [
            'nama' => 'Pasien Dua',
            'alamat' => 'Jl. Sehat No. 2',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'email' => 'pasien@example.com',
            'password' => '',
        ])->assertRedirect(route('pasien.index'));

        $this->assertDatabaseHas('users', [
            'id' => $dokter->id,
            'nama' => 'Dokter Dua',
            'role' => 'dokter',
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $pasien->id,
            'nama' => 'Pasien Dua',
            'role' => 'pasien',
        ]);

        $this->delete(route('pasien.destroy', $pasien))->assertRedirect(route('pasien.index'));
        $this->delete(route('dokter.destroy', $dokter))->assertRedirect(route('dokter.index'));
        $this->delete(route('polis.destroy', $poli))->assertRedirect(route('polis.index'));

        $this->assertDatabaseMissing('users', ['id' => $pasien->id]);
        $this->assertDatabaseMissing('users', ['id' => $dokter->id]);
        $this->assertDatabaseMissing('poli', ['id' => $poli->id]);
    }

    public function test_admin_cannot_delete_a_poli_that_has_a_doctor(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
        $poli = Poli::create(['nama_poli' => 'Poli Gigi']);
        User::create([
            'nama' => 'Dokter',
            'role' => 'dokter',
            'email' => 'dokter@example.com',
            'password' => 'password',
            'id_poli' => $poli->id,
        ]);

        $this->actingAs($admin)
            ->delete(route('polis.destroy', $poli))
            ->assertRedirect(route('polis.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('poli', ['id' => $poli->id]);
    }
}
