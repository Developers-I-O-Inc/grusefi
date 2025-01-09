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
        Schema::create('cat_vigencias', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('clave_aprobacion', 50)->unique();
            $table->date('vigencia');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_vigencias');
    }
};
