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
        Schema::create('cat_destinatarios', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('empaque_id')->unsigned()->index();
            $table->smallInteger('municipio_id')->unsigned()->index();
            $table->smallInteger('localidad_id')->nullable()->unsigned()->index();
            $table->string("nombre", 500);
            $table->string("nombre_corto", 50)->nullable();
            $table->string("domicilio", 1000);
            $table->string('colonia', 100);
            $table->string('num_ext', 10)->nullable();
            $table->string('num_int', 10)->nullable();
            $table->string('cp', 5);
            $table->string("telefonos", 1000)->nullable();
            $table->string("correos", 1000)->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->softDeletes();
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
            $table->foreign('municipio_id')->references('id')->on('cat_municipios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinatarios');
    }
};
