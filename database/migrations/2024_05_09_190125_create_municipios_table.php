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
        Schema::create('cat_municipios', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('estado_id')->unsigned()->index();
            $table->string('nombre', 100);
            $table->string('nombre_corto', 50)->nullable();
            $table->string('codigo', 10);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('estado_id')->references('id')->on('cat_estados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_municipios');
    }
};
