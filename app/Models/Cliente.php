<?php

namespace App\Models;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['personalidad', 'nombre_empresa', 'rut_empresa', 'giro_cliente', 'profesion', 'direccion', 'region_id', 'comuna_id', 'comentario', 'telefono', 'pass_sii', 'tasa_ppm', 'frecuencia_cobro'];

    public function regiones()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }
}
