<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
    protected $table = 'Destino';
    protected $primaryKey = 'ID_Destino';

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'ID_Loc');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'ID_Dep', 'ID_Dep');
    }
    
    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'ID_Destino');
    }

    public function llega()
    {
        return $this->hasOne(Llega::class, 'ID_Destino');
    }
}
