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
        Schema::create('cat_paises', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre', 50);
            $table->string('nombre_corto', 10)->nullable();
            $table->string('codigo', 10)->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_paises');
    }
};
