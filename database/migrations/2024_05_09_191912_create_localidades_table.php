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
        Schema::create('cat_localidades', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('municipio_id')->unsigned()->index();
            $table->string('nombre', 100);
            $table->string('nombre_corto', 50);
            $table->string('codigo', 10);
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
