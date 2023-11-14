<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'Productos';

    protected $primaryKey = 'ID_Producto';

    protected $fillable = [
        'Peso',
        'Cantidad',
    ];

    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'ID_Producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'ID_Usuario', 'ID_Loc');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'Num_Serie', 'Num_Serie');
    }
}
