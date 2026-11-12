<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamentos extends Model
{
    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'categoria',
        'precio',
        'costo',
        'stock',
        'imagen',
        'fecha'
    ];
}
