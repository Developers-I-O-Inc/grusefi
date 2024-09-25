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
        Schema::create('op_embarques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empaque_id')->unsigned()->index();
            $table->bigInteger('destinatario_id')->unsigned()->index();
            $table->bigInteger('pais_id')->unsigned()->index();
            $table->bigInteger('puerto_id')->unsigned()->index();
            $table->date('fecha_embarque');
            $table->string('numero_economico');
            $table->string('placas_trasporte')->nullable();
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
            $table->foreign('destinatario_id')->references('id')->on('cat_destinatarios');
            $table->foreign('pais_id')->references('id')->on('cat_paises');
            $table->foreign('puerto_id')->references('id')->on('cat_puertos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('op_embarques');
    }
};
