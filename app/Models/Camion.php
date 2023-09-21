<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $table = 'Camion';

    protected $primaryKey = 'Num_Serie';

    protected $fillable = [
        'Matricula',
        'Capacidad',
    ];

    public function lotes()
    {
        return $this->hasMany(
            Lote::class, 
            'Num_Serie');
    }

    public function chofer()
    {
        return $this->hasOne(
            Asignado::class,
             'Num_Serie');
    }


    public function articulos()
    {
        return $this->hasMany(
            Articulo::class,
             'Num_Serie');
    }

    public function destinos()
    {
        return $this->hasMany
        (Destino::class,
         'Num_Serie');
    }

    public function productos()
{
    return $this->hasManyThrough(Producto::class, Contiene::class, 'ID_Lote', 'Num_Serie', 'ID_Producto')
        ->distinct();
}
}