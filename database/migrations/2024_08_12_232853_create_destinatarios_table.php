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
            $table->id();
            $table->bigInteger('empaque_id')->unsigned()->index();
            $table->string("nombre", 500);
            $table->string("nombre_corto", 50);
            $table->string("domicilio", 1000);
            $table->string("telefonos", 1000);
            $table->string("correos", 1000);
            $table->tinyInteger('activo')->default(1);
            $table->softDeletes();
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
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
