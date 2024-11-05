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
        Schema::create('cat_empaques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('localidad_id')->unsigned()->index();
            $table->bigInteger('localidad_doc_id')->unsigned()->index();
            $table->string('nombre_corto');
            $table->string('nombre_fiscal', 500);
            $table->string('domicilio_fiscal', 500);
            $table->string('num_ext');
            $table->string('num_int')->nullable();
            $table->string('cp', 10);
            $table->string('rfc', 30);
            $table->string('telefonos');
            $table->string('imagen', 1000)->nullable();
            $table->string('nombre_embarque');
            $table->string('domicilio_documentacion', 500);
            $table->string('sader');
            $table->string('codigo');
            $table->tinyInteger('exportacion')->default(1);
            $table->tinyInteger('asociado')->default(1);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('localidad_id')->references('id')->on('cat_localidades');
            $table->foreign('localidad_doc_id')->references('id')->on('cat_localidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_empaques');
    }
};
