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
            $table->bigInteger('categoria_id')->unsigned()->index();
            $table->bigInteger('tipo_cultivo_id')->unsigned()->index();
            $table->bigInteger('presentacion_id')->unsigned()->index();
            $table->bigInteger('calibre_id')->unsigned()->index();
            $table->string('folio_pallet');
            $table->string('sader');
            $table->string('cajas');
            $table->string('lote');
            $table->string('tipo_fruta');
            $table->string('n_registros')->default(1);
            $table->foreign('embarque_id')->references('id')->on('op_embarques');
            $table->foreign('categoria_id')->references('id')->on('cat_categorias');
            $table->foreign('tipo_cultivo_id')->references('id')->on('cat_tipo_cultivos');
            $table->foreign('presentacion_id')->references('id')->on('cat_presentaciones');
            $table->foreign('calibre_id')->references('id')->on('cat_calibres');
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
