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
        Schema::create('factura_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->string('nombre_producto')->nullable();
            $table->string('descripcion_producto')->nullable();
            $table->integer('cantidad_producto')->nullable()->default(0);
            $table->integer('unidad')->nullable()->default(0);
            $table->integer('precio_producto')->nullable()->default(0);
            $table->integer('descuento_producto')->nullable()->default(0);
            $table->integer('sub_total_producto')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_productos');
    }
};
