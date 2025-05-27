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
        Schema::create('plantilla_rpv', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('pais_id')->unsigned()->index();
            $table->smallInteger('municipio_id')->unsigned()->index();
            $table->smallInteger('vigencia_id')->unsigned()->index();
            // SERVICIO SOLICITADO
            $table->boolean('ss_dictamen_verificacion');
            $table->boolean('ss_certificado_movilizacion');
            $table->boolean('ss_certificado_internacional');
            $table->string('ss_otro')->nullable();
            // 4 Indique la regulación o requisito que se evaluará:
            $table->string('regulacion_tvaluar')->nullable();
            // 5 De acuerdo al servicio solicitado y a la regulación o requisito que aplica, marque con una “X” los documentos que son requeridos para iniciar el proceso de verificación:
            $table->boolean('dr_certificado_movilizacion');
            $table->string('dr_certificado_movilizacion_t', 500)->nullable();
            $table->boolean('dr_certificado_cumplimiento');
            $table->string('dr_certificado_cumplimiento_t', 500)->nullable();
            $table->boolean('dr_cartilla_fitosanitaria');
            $table->string('dr_cartilla_fitosanitaria_t', 500)->nullable();
            $table->boolean('dr_tarjeta_moscas');
            $table->string('dr_tarjeta_moscas_t', 500)->nullable();
            $table->boolean('dr_copiacfmn');
            $table->string('dr_copiacfmn_t', 500)->nullable();
            $table->boolean('dr_copia_certificado');
            $table->string('dr_copia_certificado_t', 500)->nullable();
            $table->boolean('dr_diagnostico_fitosanitario');
            $table->string('dr_diagnostico_fitosanitario_t', 500)->nullable();
            $table->boolean('dr_certificado_htlmf');
            $table->string('dr_certificado_htlmf_t', 500)->nullable();
            $table->boolean('dr_tvaluacion_conformidad');
            $table->string('dr_tvaluacion_conformidad_t', 500)->nullable();
            $table->boolean('dr_tratamiento_cuarentenario');
            $table->string('dr_tratamiento_cuarentenario_t', 500)->nullable();
            $table->boolean('dr_ninguno');
            $table->boolean('dr_aviso');
            $table->string('dr_aviso_t', 500)->nullable();
            $table->boolean('dr_otro')->nullable();
            $table->string('dr_otro_t', 500)->nullable();
            // 6 ¿El producto, lote o instalación se encuentra identificado, acondicionado y preparado para realizar la verificación?
            $table->boolean('pv');
            // 7 De acuerdo con la regulación o requisito que aplica. ¿El tipo de verificación que se requiere es?
            $table->boolean('tv_constatacion_ocular');
            $table->boolean('tv_diagnostico_fitosanitario');
            $table->boolean('tv_muestreo_sitio');
            $table->boolean('tv_otro');
            $table->string('tv_otro_t', 500)->nullable();
            // 8 De conformidad con el tipo de verificación anote las condiciones fitosanitarias a verificar y sus resultados
            $table->tinyInteger('cf_c_toma_muestra')->nullable();
            $table->decimal('cf_c_toma_muestra_p')->nullable();
            $table->string('cf_c_toma_muestra_o', 500)->nullable();
            $table->tinyInteger('cf_c_plagas_cuarentenaria')->nullable();
            $table->decimal('cf_c_plagas_cuarentenaria_p')->nullable();
            $table->string('cf_c_plagas_cuarentenaria_o', 500)->nullable();
            $table->tinyInteger('cf_c_plagas_economica')->nullable();
            $table->decimal('cf_c_plagas_economica_p')->nullable();
            $table->string('cf_c_plagas_economica_o', 500)->nullable();
            $table->tinyInteger('cf_c_tratamiento_cuarentenario')->nullable();
            $table->decimal('cf_c_tratamiento_cuarentenario_p')->nullable();
            $table->string('cf_c_tratamiento_cuarentenario_o', 500)->nullable();
            $table->tinyInteger('cf_c_residuos_vegetales')->nullable();
            $table->decimal('cf_c_residuos_vegetales_p')->nullable();
            $table->string('cf_c_residuos_vegetales_o', 500)->nullable();
            $table->tinyInteger('cf_c_suelo')->nullable();
            $table->decimal('cf_c_suelo_p')->nullable();
            $table->string('cf_c_suelo_o', 500)->nullable();
            $table->tinyInteger('cf_c_lavado')->nullable();
            $table->decimal('cf_c_lavado_p')->nullable();
            $table->string('cf_c_lavado_o', 500)->nullable();
            $table->tinyInteger('cf_c_cepillado')->nullable();
            $table->decimal('cf_c_cepillado_p')->nullable();
            $table->string('cf_c_cepillado_o', 500)->nullable();
            $table->tinyInteger('cf_c_empaque_nuevo')->nullable();
            $table->decimal('cf_c_empaque_nuevo_p')->nullable();
            $table->string('cf_c_empaque_nuevo_o', 500)->nullable();
            $table->tinyInteger('cf_c_etiquetas_fitosanitarias')->nullable();
            $table->decimal('cf_c_etiquetas_fitosanitarias_p')->nullable();
            $table->string('cf_c_etiquetas_fitosanitarias_o', 500)->nullable();
            $table->tinyInteger('cf_c_diagnostico_fitosanitario')->nullable();
            $table->decimal('cf_c_diagnostico_fitosanitario_p')->nullable();
            $table->string('cf_c_diagnostico_fitosanitario_o', 500)->nullable();
            $table->tinyInteger('cf_c_materia_regulacion')->nullable();
            $table->decimal('cf_c_materia_regulacion_p')->nullable();
            $table->string('cf_c_materia_regulacion_o', 500)->nullable();
            $table->tinyInteger('cf_c_otra')->nullable();
            $table->decimal('cf_c_otra_p')->nullable();
            $table->string('cf_c_otra_o', 500)->nullable();
            // 9 ¿El transporte para la movilización del Lote de producto (s) presenta o se encuentra? (Marque con una X y complemente):
            $table->boolean('tm_residuos_vegetales');
            $table->boolean('tm_sn_residuos_vegetales');
            $table->boolean('tm_lavado');
            $table->boolean('tm_limpio');
            $table->boolean('tm_refrigerado');
            $table->boolean('tm_enlonado');
            $table->boolean('tm_caja_seca');
            $table->boolean('tm_otro')->nullable();
            $table->string('tm_otro_t', 500)->nullable();
            // 10 No requiere Certificado Fitosanitario por movilizarse en una zona bajo un mismo estatus fitosanitario por tratarse de un producto no regulado. ()
            $table->boolean('no_requiere_certificado');
            // 11 Si Cumple () No cumple () con la normatividad, requisitos aplicables y/o condición fitosanitaria evaluada.
            $table->boolean('cfe_si_cumple');
            $table->boolean('cfe_debe_CFMN');
            $table->boolean('cfe_aplica_flete_CFMN');
            $table->string('cfe_folios_CFMN')->nullable();
            $table->boolean('cfe_no_debe_CFMN');
            $table->boolean('cfe_debe_CFI');
            $table->boolean('cfe_aplica_flete_CFI');
            $table->boolean('cfe_no_debe_CFI');
            $table->string('cfe_folios_CFI')->nullable();
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('pais_id')->references('id')->on('cat_paises');
            $table->foreign('municipio_id')->references('id')->on('cat_municipios');
            $table->foreign('vigencia_id')->references('id')->on('cat_vigencias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_rpv');
    }
};
