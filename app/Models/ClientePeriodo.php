<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\Periodo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientePeriodo extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the ClientePeriodo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
