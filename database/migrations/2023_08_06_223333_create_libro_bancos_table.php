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
        Schema::create('libro_bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_ingreso')->nullable();
            $table->enum('tipo_operacion', ['Honorarios', 'Gastos', 'Ingresos'])->nullable();
            $table->date('fecha_periodo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('factura')->nullable();
            $table->integer('debe')->nullable()->default(0);
            $table->integer('haber')->nullable()->default(0);
            $table->integer('saldo')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_bancos');
    }
};
