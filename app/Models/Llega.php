<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llega extends Model
{
    use HasFactory;
    protected $table = 'Llega';
    protected $fillable = [
        'ID_Lote',
        'ID_Destino',
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'ID_Lote');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'ID_Destino');
    }
}
