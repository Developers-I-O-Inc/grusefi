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
        Schema::create('cat_puertos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('municipio_id')->unsigned()->index();
            $table->string('puerto', 50);
            $table->string('nombre_corto', 10);
            $table->string('medio_transporte', 50);
            $table->tinyInteger('placas')->default(1);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_puertos');
    }
};
