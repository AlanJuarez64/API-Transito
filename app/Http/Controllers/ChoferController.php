<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ChoferController extends Controller
{
    public function Buscar($id){
        try{
            $chofer = Chofer::findOrFail($id);
            return response()->json($chofer);

        }catch(ModelNotFoundException $exception) {
            return response()->json(['error' => 'chofer no encontrado'], 404);
        }
    }

}
