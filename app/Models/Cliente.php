<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['personalidad', 'nombre_empresa', 'rut_empresa','profesion', 'direccion', 'region_id', 'comuna_id', 'comentario', 'telefono', 'pass_sii', 'tasa_ppm', 'fecha_cobro'];
}
