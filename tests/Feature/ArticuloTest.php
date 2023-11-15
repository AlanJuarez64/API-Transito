<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Articulo;
use App\Models\User;

class ArticuloTest extends TestCase
{
    public function testBuscarArticuloExistente()
    {
        $token = $this->simularAutenticacion();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulo/1');

        $response->assertStatus(200)
            ->assertJsonStructure(['articulo' => [
                'ID_Articulo', 'id', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]]);
    }

    public function testBuscarArticuloNoExistente()
    {
        $token = $this->simularAutenticacion();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulo/999');
        $response->assertStatus(404)
            ->assertJsonStructure(['error']);

    }


    public function testCambiarEstadoDeArticuloExistente()
    {
        $token = $this->simularAutenticacion();

        $data = ['estado' => 'Entregado'];
        $token = $this->simularAutenticacion();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/articulo/1/status', $data);

        $response->assertStatus(200)
            ->assertJson(["message" => "Estado del artículo modificado correctamente"]);


        $updatedArticulo = Articulo::find(1);
        $this->assertEquals('Entregado', $updatedArticulo->Estado);
    }

    public function testCambiarEstadoDeArticuloNoExistente()
    {
        $token = $this->simularAutenticacion();


        $data = ['estado' => 'Entregado'];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/articulo/999/status', $data);

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }


    public function testObtenerDestinoDeArticuloExistente()
    {
        $token = $this->simularAutenticacion();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulo/1/destino');

        $response->assertStatus(200)
            ->assertJsonStructure(['destino' => [
                'ID_Destino', 'ID_Loc', 'Latitud', 'Longitud',
                'created_at', 'updated_at'
            ]]);
    }

    public function testObtenerDestinoDeArticuloNoExistente()
    {
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulo/999/destino');

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
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
