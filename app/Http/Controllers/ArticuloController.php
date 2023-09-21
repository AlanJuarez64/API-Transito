<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticuloController extends Controller
{

//------------------------Datos del articulo---------------------------------------//
    public function Buscar($id){
        try {
            $articulo = Articulo::findOrFail($id);

            return response()->json(['articulo' => $articulo]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
    }

    public function CambiarEstado(Request $request, $id){
        try {
            $request->validate([
                'estado' => ['required', Rule::in(['En espera', 'En el almacen', 'En camino', 'Entregado'])], 
            ]);
            
            $articulo = Articulo::findOrFail($id);
            $articulo->update($request->all());
    
            return response()->json(['message' => 'Estado del artículo modificado correctamente']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
    }

    public function VerEstado($id)
    {
        try {
            $articulo = Articulo::findOrFail($id);

            return response()->json(['estado' => $articulo->Estado]);

        } catch (ModelNotFoundException $exception) {

        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }
    }

//--------------------Relaciones----------------------------------------------------//

    public function ObtenerCamion($id)
    {   
        try{
        $articulo = Articulo::findOrFail($id);
        $camion = $articulo->lote->camion;

        return response()->json(['camion' => $camion]);
        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
        }

    public function ObtenerDestino($id)
    {
        try{
        $articulo = Articulo::findOrFail($id);
        
        $producto = $articulo->producto;       
        $destino = $producto->destino;
        
        return response()->json(['destino' => $destino]);
        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
        
    }

}


