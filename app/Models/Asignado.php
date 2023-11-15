<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignado extends Model
{
    use HasFactory;
    protected $table = 'Asignado';
    protected $primaryKey = 'id';

    public function chofer()
    {
        return $this->hasOne(Asignado::class, 'Num_Serie');
    }
}
