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
        Schema::create('op_embarques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empaque_id')->unsigned()->index();
            $table->bigInteger('destinatario_id')->unsigned()->index();
            $table->bigInteger('pais_id')->unsigned()->index();
            $table->bigInteger('puerto_id')->unsigned()->index();
            $table->bigInteger('tefs_id')->unsigned()->index();
            $table->bigInteger('variedad_id')->unsigned()->index();
            $table->bigInteger('vigencia_id')->unsigned()->index();
            $table->bigInteger('consolidado_id')->nullable();
            $table->string('folio_embarque')->default('EMB-');
            $table->string('consecutivo')->default('0000');
            $table->date('fecha_embarque');
            $table->string('numero_economico', 50)->nullable();
            $table->string('placas_trasporte', 30)->nullable();
            $table->string('inspector')->nullable();
            $table->boolean('consolidado')->default(0);
            $table->string('empresa_transporte')->nullable();
            $table->string('chofer')->nullable();
            $table->enum('status', ['Pendiente', 'Modificado', 'Finalizado'])->default('Pendiente');
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
            $table->foreign('destinatario_id')->references('id')->on('cat_destinatarios');
            $table->foreign('tefs_id')->references('id')->on('users');
            $table->foreign('pais_id')->references('id')->on('cat_paises');
            $table->foreign('puerto_id')->references('id')->on('cat_puertos');
            $table->foreign('variedad_id')->references('id')->on('cat_variedades');
            $table->foreign('vigencia_id')->references('id')->on('cat_vigencias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('op_embarques');
    }
};
