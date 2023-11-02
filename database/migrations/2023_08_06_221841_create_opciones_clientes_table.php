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
        Schema::create('opciones_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('notificar', ['Si', 'No'])->nullable()->default('Si');
            $table->string('emails')->nullable();
            $table->enum('exento_iva', ['Si', 'No'])->nullable()->default('Si');
            $table->enum('importaciones', ['Si', 'No'])->nullable()->default('Si');
            $table->enum('remuneraciones', ['Si', 'No'])->nullable()->default('Si');
            $table->enum('contabilidad', ['Si', 'No'])->nullable()->default('Si');
            $table->enum('facturacion', ['Si', 'No'])->nullable()->default('Si');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones_clientes');
    }
};
