<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'rtn',
        'empresa',
        'contacto',
        'telefono',
        'categoria',
        'limite_credito',
        'dias_credito',
        'estado',
        'fecha_registro',
    ];
}
