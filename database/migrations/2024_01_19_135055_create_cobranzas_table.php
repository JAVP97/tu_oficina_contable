<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cobranzas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('forma_pago_id')->unsigned();
            $table->foreign('forma_pago_id')->references('id')->on('forma_pagos');
            $table->longText('descripcion')->nullable();
            $table->integer('cantidad')->nullable()->default(0);
            $table->integer('valor_neto')->nullable()->default(0);
            $table->float('iva')->nullable()->default(0);
            $table->integer('valor_iva')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobranzas');
    }
};
