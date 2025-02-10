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
            $table->smallInteger('empaque_id')->unsigned()->index();
            $table->smallInteger('municipio_id')->unsigned()->index();//PROCEDENCIA
            $table->smallInteger('destinatario_id')->unsigned()->index();
            $table->smallInteger('pais_id')->unsigned()->index();
            $table->smallInteger('puerto_id')->unsigned()->index()->nullable();
            $table->smallInteger('tefs_id')->unsigned()->index();
            $table->smallInteger('vigencia_id')->unsigned()->index();
            $table->smallInteger('lugar_id')->unsigned()->index();
            $table->smallInteger('uso_id')->unsigned()->index();
            $table->smallInteger('consolidado_id')->nullable();
            $table->string('folio_embarque')->default('EMB-');
            $table->dateTime('fecha_termino')->nullable();
            $table->string('consecutivo')->default('0000');
            $table->string('numero_economico', 50)->nullable();
            $table->string('placas_transporte', 30)->nullable();
            $table->string('origen', 300)->nullable();
            $table->string('inspector')->nullable();
            $table->boolean('consolidado')->default(0);
            $table->string('empresa_transporte')->nullable();
            $table->string('chofer')->nullable();
            $table->enum('status', ['Pendiente', 'Modificado', 'Finalizado'])->default('Pendiente');
            $table->string('observaciones', 1300)->nullable();
            $table->foreign('empaque_id')->references('id')->on('cat_empaques');
            $table->foreign('destinatario_id')->references('id')->on('cat_destinatarios');
            $table->foreign('tefs_id')->references('id')->on('users');
            $table->foreign('pais_id')->references('id')->on('cat_paises');
            $table->foreign('vigencia_id')->references('id')->on('cat_vigencias');
            $table->foreign('municipio_id')->references('id')->on('cat_municipios');
            $table->foreign('lugar_id')->references('id')->on('cat_municipios');
            $table->foreign('uso_id')->references('id')->on('cat_usos');
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
