<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'periodos';
    protected $primaryKey = 'id';
    protected $fillable = ['periodo', 'periodo_cerrado'];

}
