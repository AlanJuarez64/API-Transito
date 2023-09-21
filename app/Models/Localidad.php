<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $table = 'Localidad';
    protected $primaryKey = 'ID_Loc';

    public function destinos()
    {
        return $this->hasMany(Destino::class, 'ID_Loc', 'ID_Loc');
    }

    
}
