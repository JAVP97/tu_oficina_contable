<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    protected $table = 'forma_pagos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre_fp'];
}
