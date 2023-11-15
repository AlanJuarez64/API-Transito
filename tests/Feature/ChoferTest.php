<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Tests\TestCase;

class ChoferTest extends TestCase
{
    public function testObtenerCamionDeChoferExistente()
    {
        $token = $this->simularAutenticacion();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/chofer/1/camion');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id', 'Num_Serie', 'created_at', 'updated_at'
            ]);
    }

    public function testObtenerCamionDeChoferNoExistente()
    {
        $token = $this->simularAutenticacion();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/chofer/999/camion');

        $response->assertStatus(404)
            ->assertJson(['error' => 'chofer no encontrado']);
    }

    private function simularAutenticacion()
    {
        $user = User::factory()->create();
        
        $response = Http::post('http://localhost:8001/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username' => "$user->email",
            'password' => 'password',
        ]);

        $token = $response->json('access_token');

        return $token;
    }
}
