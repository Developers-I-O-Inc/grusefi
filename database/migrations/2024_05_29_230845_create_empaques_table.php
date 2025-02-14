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
            $table->smallIncrements('id');
            $table->smallInteger('municipio_id')->unsigned()->index();
            $table->smallInteger('localidad_id')->unsigned()->index()->nullable();
            $table->smallInteger('localidad_doc_id')->unsigned()->index()->nullable();
            $table->string('nombre_corto', 50)->nullable();
            $table->string('nombre_fiscal', 200);
            $table->string('domicilio_fiscal', 500);
            $table->string('colonia', 100)->nullable();
            $table->string('num_ext', 10)->nullable();
            $table->string('num_int', 10)->nullable();
            $table->string('cp', 5);
            $table->string('rfc', 13);
            $table->string('telefonos', 100);
            $table->enum('tipo', ["Física", "Moral"]);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('municipio_id')->references('id')->on('cat_municipios');
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
