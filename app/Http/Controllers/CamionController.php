<?php
namespace App\Http\Controllers;

use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CamionController extends Controller
{
    public function Buscar($id)
    {
        try{
            $camion = Camion::findOrFail($id);
            return response()->json($camion);
        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Camion no encontrado'], 404);
        }
    }
    
    

    public function ObtenerChofer($id)
    {
        try{
            $camion = Camion::findOrFail($id);
            $chofer = $camion->chofer;

            return response()->json(['chofer' => $chofer]);

        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Camion no encontrado'], 404);
        }
    }

    public function ObtenerDestinos($id){
        try{
            $camion = Camion::findOrFail($id);
            $articulos = $camion->lotes->flatMap(function ($lote) {
                return $lote->articulos;
            });
            $productos = $articulos->map(function ($articulo) {
                return $articulo->producto;
            });
            $destinos = $productos->map(function ($producto) {
                return $producto->destino;
            });
    
            return response()->json($destinos);

        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Camion no encontrado'], 404);
        }
    }
    

    public function ObtenerLotes($id){
        try{
            $camion = Camion::findOrFail($id);
            $lotes = $camion->lotes;
            return response()->json($lotes);

        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Camion no encontrado'], 404);
        }
    }


    
}

