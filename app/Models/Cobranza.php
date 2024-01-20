<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\FormaPago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cobranza extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }
}
