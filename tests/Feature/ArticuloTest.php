<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Articulo;

class ArticuloTest extends TestCase
{
    public function testBuscarArticuloExistente()
    {
        $response = $this->get('/api/articulo/1');

        $response->assertStatus(200)
            ->assertJsonStructure(['articulo' => [
                'ID_Articulo', 'ID_Usuario', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]]);
    }

    public function testBuscarArticuloNoExistente()
    {
        $response = $this->get('/api/articulo/999');
        $response->assertStatus(404)
            ->assertJsonStructure(['error']);

    }


    public function testCambiarEstadoDeArticuloExistente()
    {
        $data = ['estado' => 'En camino'];
        $response = $this->put('/api/articulo/1/status', $data);

        $response->assertStatus(200)
            ->assertJson(["message" => "Estado del artículo modificado correctamente"]);


        $updatedArticulo = Articulo::find(1);
        $this->assertEquals('En camino', $updatedArticulo->Estado);
    }

    public function testCambiarEstadoDeArticuloNoExistente()
    {
        $data = ['estado' => 'En camino'];
        $response = $this->put('/api/articulo/999/status', $data);

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }

    public function testVerEstadoDeArticuloExistente()
    {
        $response = $this->get('/api/articulo/1/status');

        $response->assertStatus(200)
            ->assertJson(["estado" => "En camino"]);
    }

    public function testVerEstadoDeArticuloNoExistente()
    {
        $response = $this->get('/api/articulo/999/status');

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }

    public function testObtenerCamionDeArticuloExistente()
    {
        $response = $this->get('/api/articulo/1/camion');

        $response->assertStatus(200)
            ->assertJsonStructure(['camion' => [
                'Num_Serie', 'Matricula', 'Capacidad', 'created_at', 'updated_at'
            ]]);
    }

    public function testObtenerCamionDeArticuloNoExistente()
    {
        $response = $this->get('/api/articulo/999/camion');

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }

    public function testObtenerDestinoDeArticuloExistente()
    {
        $response = $this->get('/api/articulo/1/destino');

        $response->assertStatus(200)
            ->assertJsonStructure(['destino' => [
                'ID_Destino', 'ID_Loc', 'ID_Dep', 'Latitud', 'Longitud',
                'created_at', 'updated_at'
            ]]);
    }

    public function testObtenerDestinoDeArticuloNoExistente()
    {
        $response = $this->get('/api/articulo/999/destino');

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }
}
