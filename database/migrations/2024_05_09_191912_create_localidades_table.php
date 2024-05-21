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
        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('municipio_id')->unsigned()->index();
            $table->string('nombre');
            $table->string('nombre_corto');
            $table->string('codigo');
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('municipio_id')->references('id')->on('cat_municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_localidades');
    }
};
