<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_is_redirected_to_the_doctor_dashboard_after_login(): void
    {
        User::create([
            'nama' => 'Dokter',
            'role' => 'dokter',
            'email' => 'dokter@example.com',
            'password' => 'password',
        ]);

        $this->post('/login', [
            'email' => 'dokter@example.com',
            'password' => 'password',
        ])
            ->assertRedirect(route('dokter.dashboard'));

        $this->get(route('dokter.dashboard'))
            ->assertOk()
            ->assertSee('Dokter Dashboard')
            ->assertSee('Halo Selamat Datang Dokter')
            ->assertSee('Dashboard Dokter');
    }
}
