<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;

    protected $table = 'Choferes';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'Licencia',
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'id');
    }

    public function camion()
    {
        return $this->hasOne(Asignado::class, 'id');
    }
}
