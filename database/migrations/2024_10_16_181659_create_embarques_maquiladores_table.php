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
        Schema::create('op_embarques_maquiladores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('embarque_id')->unsigned()->index();
            $table->bigInteger('maquilador_id')->unsigned()->index();
            $table->foreign('embarque_id')->references('id')->on('op_embarques');
            $table->foreign('maquilador_id')->references('id')->on('cat_empaques');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('op_embarques_maquiladores');
    }
};
