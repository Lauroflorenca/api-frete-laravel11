<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Viagem;
use App\Models\User;

class ViagemTest extends TestCase
{
    public function test_list_viagens()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $response->json('access_token');


        $response = $this->getJson('/api/viagens', ['Authorization' => "Bearer {$token}"]);
        $response->assertStatus(200);
    }

    public function test_get_single_viagem()
    {

        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $response->json('access_token');

        $viagem = Viagem::factory()->create();


        $response = $this->getJson("/api/viagens/{$viagem->id}", [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }
}
