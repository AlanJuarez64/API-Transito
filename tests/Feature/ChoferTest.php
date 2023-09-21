<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChoferTest extends TestCase
{
    public function testBuscarChoferExistente()
    {
        $response = $this->get('/api/chofer/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ID_Usuario', 'Licencia', 'created_at', 'updated_at'
            ]);
    }

    public function testBuscarChoferNoExistente()
    {
        $response = $this->get('/api/chofer/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'chofer no encontrado']);
    }

    public function testObtenerCamionDeChoferExistente()
    {
        $response = $this->get('/api/chofer/1/camion');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ID_Usuario', 'Num_Serie', 'created_at', 'updated_at'
            ]);
    }

    public function testObtenerCamionDeChoferNoExistente()
    {
        $response = $this->get('/api/chofer/999/camion');

        $response->assertStatus(404)
            ->assertJson(['error' => 'chofer no encontrado']);
    }
}
