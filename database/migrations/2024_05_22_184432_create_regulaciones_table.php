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
        Schema::create('cat_regulaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pais_id')->unsigned()->index();
            $table->string("dictamen_apartado_4");
            $table->string("dictamen_apartado_5");
            $table->string("dictamen_apartado_11");
            $table->string("nombre_pais_dictamen");
            $table->string("nombre_pais_certificado");
            $table->boolean("activo_embarques");
            $table->boolean("rq_inspector");
            $table->boolean("rq_huertas");
            $table->boolean("rq_estudios_analisis");
            $table->boolean("rq_impresion");
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('pais_id')->references('id')->on('cat_paises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_regulaciones');
    }
};
