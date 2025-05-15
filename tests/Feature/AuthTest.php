<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase; // garante que o banco de dados de teste será migrado e limpo entre testes

    public function test_login_with_valid_credentials(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('1234'),
        ]);
    
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => '1234',
        ]);
    
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
