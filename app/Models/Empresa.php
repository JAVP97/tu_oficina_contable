<?php

namespace App\Models;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory; 
    protected $table = 'empresas';
    protected $primaryKey = 'id';

    public function regiones()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }
}
