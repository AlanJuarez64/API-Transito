<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = 'Lote';

    protected $primaryKey = 'ID_Lote';

    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'ID_Lote', 'ID_Articulo');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'Num_Serie');
    }
    
    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
             'Contiene',
              'ID_Lote', 
              'ID_Producto');
    }


    public function destino()
    {
        return $this->belongsTo(Destino::class, 'ID_Destino');
    }
    public function contiene()
    {
        return $this->hasOne(Contiene::class, 'ID_Lote');
    }

    public function llega()
    {
        return $this->hasOne(Llega::class, 'ID_Lote');
    }
}
