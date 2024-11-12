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
        Schema::create('cat_presentaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('variedad_id')->unsigned()->index();
            $table->string("presentacion", 1000);
            $table->decimal('peso', total: 5, places: 3);
            $table->tinyInteger('activo')->default(1);
            $table->foreign('variedad_id')->references('id')->on('cat_variedades');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_presentaciones');
    }
};
