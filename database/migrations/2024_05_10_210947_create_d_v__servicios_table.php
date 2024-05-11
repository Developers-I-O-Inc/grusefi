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
        Schema::create('dv_servicios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dv_id')->unsigned()->index();
            $table->bigInteger('servicio_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('dv_id')->references('id')->on('op_dictamen_verificacion');
            $table->foreign('servicio_id')->references('id')->on('cat_servicios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dv_servicios');
    }
};
