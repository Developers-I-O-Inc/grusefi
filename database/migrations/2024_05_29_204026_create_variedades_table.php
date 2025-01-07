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
        Schema::create('cat_variedades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_cultivo_id')->unsigned()->index();
            $table->string('nombre_cientifico', 50);
            $table->string('variedad', 50);
            $table->enum('tipo', ['Orgánico', 'Convencional']);
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tipo_cultivo_id')->references('id')->on('cat_tipo_cultivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_variedades');
    }
};
