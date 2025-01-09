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
        Schema::create('op_embarques_productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('embarque_id')->unsigned()->index();
            $table->mediumInteger('variedad_id')->unsigned()->index();
            $table->mediumInteger('presentacion_id')->unsigned()->index();
            $table->integer('marca_id')->unsigned()->index()->nullable();
            $table->string('folio_pallet', 20);
            $table->string('lote', 20);
            $table->string('sader', 20);
            $table->string('cartilla', 20);
            $table->integer('cantidad');
            $table->decimal('peso', 10, 2);
            $table->foreign('embarque_id')->references('id')->on('op_embarques');
            $table->foreign('presentacion_id')->references('id')->on('cat_presentaciones');
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
        Schema::dropIfExists('op_embarques_productos');
    }
};
