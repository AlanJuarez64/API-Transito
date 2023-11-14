<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ProductosController;
use App\Http\Middleware\Autenticacion;
use Fruitcake\Cors\HandleCors;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([HandleCors::class])->group(function () {

Route::prefix('articulo')->group(function (){
    Route::get('/{id}', [ArticuloController::class, 'Buscar']);
    Route::get('/{id}/destino', [ArticuloController::class, 'ObtenerDestino'])->middleware(Autenticacion::class);
    Route::put('/{id}/status', [ArticuloController::class, 'CambiarEstado'])->middleware(Autenticacion::class);;
});


Route::prefix('chofer')->group(function (){
    Route::get('/{id}/camion', [ChoferController::class, 'ObtenerCamion'])->middleware(Autenticacion::class);;    
});
});