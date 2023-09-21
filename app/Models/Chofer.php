<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;

    protected $table = 'Chofer';
    protected $primaryKey = 'ID_Usuario';
    
    protected $fillable = [
        'Licencia',
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'ID_Usuario');
    }

    public function camion()
    {
        return $this->hasOne(Asignado::class, 'ID_Usuario');
    }
}
