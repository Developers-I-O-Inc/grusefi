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
        Schema::create('plantilla_rpv', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pais_id')->unsigned()->index();
            $table->boolean('ss_dictamen_verificacion');
            $table->boolean('ss_certificado_movilizacion');
            $table->boolean('ss_certificado_internacional');
            $table->string('ss_otro');
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
        Schema::dropIfExists('plantilla_rpv');
    }
};
