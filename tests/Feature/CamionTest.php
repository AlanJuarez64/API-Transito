<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CamionTest extends TestCase
{
    public function testBuscarCamionExistente()
    {
        $response = $this->get('/api/camion/101');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'Num_Serie', 'Matricula', 'Capacidad', 'created_at', 'updated_at']);
    }

    public function testBuscarCamionNoExistente()
    {
        $response = $this->get('/api/camion/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Camion no encontrado']);
    }

    public function testObtenerChoferDeCamionExistente()
    {
        $response = $this->get('/api/camion/101/chofer');

        $response->assertStatus(200)
            ->assertJsonStructure(['chofer' => [
                'ID_Usuario', 'Num_Serie', 'created_at','updated_at'
            ]]);
    }

    public function testObtenerChoferDeCamionNoExistente()
    {
        $response = $this->get('/api/camion/999/chofer');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Camion no encontrado']);
    }

    public function testObtenerLotesDeCamionExistente()
    {
        $response = $this->get('/api/camion/101/lotes');

        $response->assertStatus(200)
            ->assertJsonStructure(['*' => [
                'ID_Lote', 'Nombre', 'Descripcion', 'Fecha_Hora_Estimada', 'Num_Serie',
                'created_at', 'updated_at'
            ]]);
    }

    public function testObtenerLotesDeCamionNoExistente()
    {
        $response = $this->get('/api/camion/999/lotes');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Camion no encontrado']);
    }

}
