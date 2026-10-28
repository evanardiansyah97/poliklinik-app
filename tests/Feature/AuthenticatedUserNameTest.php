<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedUserNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_dashboard_displays_the_users_real_name(): void
    {
        $user = User::create([
            'nama' => 'Nama Asli Pasien',
            'role' => 'pasien',
            'email' => 'pasien@example.com',
            'password' => 'password',
        ]);

        $response = $this->actingAs($user)->get('/pasien/dashboard');

        $response->assertOk()->assertSee('Nama Asli Pasien');
        $this->assertMatchesRegularExpression('/<span[^>]*>\s*N\s*<\/span>/', $response->getContent());
    }
}
