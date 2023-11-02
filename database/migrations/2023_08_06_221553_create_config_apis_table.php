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
        Schema::create('config_apis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('certificado_digital', 100)->nullable();
            $table->string('pass_certificado_digital', 100)->nullable();
            $table->string('usuario_api', 100)->nullable();
            $table->string('token_api', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_apis');
    }
};
