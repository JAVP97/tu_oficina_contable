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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('personalidad', ['Natural'])->nullable()->default('Natural');
            $table->string('nombre_empresa', 100)->nullable();
            $table->string('rut_empresa', 100)->unique();
            $table->string('giro_cliente', 100)->unique();
            $table->string('profesion', 100)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->integer('comuna_id')->unsigned();
            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->string('comentario', 100)->nullable();
            $table->string('telefono', 100)->nullable();
            $table->string('pass_sii', 100)->nullable();
            $table->string('tasa_ppm', 100)->nullable();
            $table->enum('frecuencia_cobro', ['Diario', 'Semanal', 'Quincenal', 'Mensual'])->default(['Mensual']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
