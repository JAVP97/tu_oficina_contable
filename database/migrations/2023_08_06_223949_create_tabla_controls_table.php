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
        Schema::create('tabla_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Vigente', 'Vencido', 'Pagado', 'Abonado'])->nullable()->default('Vigente');
            $table->string('concepto_facturado')->nullable();
            $table->integer('monto')->nullable()->default(0);
            $table->integer('monto_iva')->nullable()->default(0);
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_controls');
    }
};
