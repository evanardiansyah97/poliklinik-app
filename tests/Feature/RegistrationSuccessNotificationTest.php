<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationSuccessNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_registration_displays_a_notification_on_the_login_page(): void
    {
        $this->post('/register', [
            'nama' => 'Pasien Baru',
            'alamat' => 'Jalan Sehat No. 1',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'email' => 'pasien.baru@example.com',
            'password' => 'password',
        ])->assertRedirect(route('login'));

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Registrasi berhasil! Silakan login.');
    }
}
