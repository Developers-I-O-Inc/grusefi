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
        Schema::create('cat_marcas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empaque_id')->unsigned()->index();
            $table->string("nombre");
            $table->tinyInteger('activo')->default(1);
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_marcas');
    }
};
