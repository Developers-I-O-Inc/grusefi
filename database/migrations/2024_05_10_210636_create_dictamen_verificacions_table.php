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
        Schema::create('op_dictamen_verificacion', function (Blueprint $table) {
            $table->id();
            $table->string("folio");
            $table->string("lugar");
            $table->datetime("fecha");
            $table->string("hora");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('op_dictamen_verificacion');
    }
};
