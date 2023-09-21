<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'Articulo';

    protected $primaryKey = 'ID_Articulo';
    protected $fillable = [
        'ID_Producto',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Cliente::class, 'ID_Usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }

    public function camion()
    {
        return $this->hasOneThrough(Camion::class, Lote::class, 'ID_Articulo', 'Num_Serie');
    }

    public function chofer()
    {
        return $this->hasOne(Chofer::class, Camion::class, 'Num_Serie');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'ID_Articulo', 'ID_Lote');
    }

    
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'ID_Almacen');
    }



}
