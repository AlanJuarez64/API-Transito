<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'Departamento';
    protected $primaryKey = 'ID_Dep';

    public function localidades()
    {
        return $this->hasMany(Localidad::class, 'ID_Dep', 'ID_Dep');
    }
}
