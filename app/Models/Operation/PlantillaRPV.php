<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantillaRPV extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plantilla_rpv';

    protected $fillable = [
        'pais_id',
        'municipio_id',
        'ss_dictamen_verificacion',
        'ss_certificado_movilizacion',
        'ss_certificado_internacional',
        'ss_otro',
        'regulacion_tvaluar',
        'dr_certificado_movilizacion',
        'dr_certificado_movilizacion_t',
        'dr_certificado_cumplimiento',
        'dr_certificado_cumplimiento_t',
        'dr_cartilla_fitosanitaria',
        'dr_cartilla_fitosanitaria_t',
        'dr_tarjeta_moscas',
        'dr_tarjeta_moscas_t',
        'dr_copiacfmn',
        'dr_copiacfmn_t',
        'dr_copia_certificado',
        'dr_copia_certificado_t',
        'dr_diagnostico_fitosanitario',
        'dr_diagnostico_fitosanitario_t',
        'dr_certificado_htlmf',
        'dr_certificado_htlmf_t',
        'dr_tvaluacion_conformidad',
        'dr_tvaluacion_conformidad_t',
        'dr_tratamiento_cuarentenario',
        'dr_tratamiento_cuarentenario_t',
        'dr_ninguno',
        'dr_aviso',
        'dr_aviso_t',
        'dr_otro',
        'dr_otro_t',
        'pv',
        'tv_constatacion_ocular',
        'tv_diagnostico_fitosanitario',
        'tv_muestreo_sitio',
        'tv_otro',
        'tv_otro_t',
        'tm_residuos_vegetales',
        'tm_sn_residuos_vegetales',
        'tm_lavado',
        'tm_limpio',
        'tm_refrigerado',
        'tm_enlonado',
        'tm_caja_seca',
        'tm_otro',
        'tm_otro_t',
        'plantilla_aprobacion',
        'no_requiere_certificado',
        'cfe_si_cumple',
        'cfe_debe_CFMN',
        'cfe_aplica_fleje_CFMN',
        'cfe_folios_CFMN',
        'cfe_no_debe_CFMN',
        'cfe_debe_CFI',
        'cfe_aplica_fleje_CFI',
        'cfe_no_debe_CFI',
        'cfe_folios_CFI',
        'vigencia_id'
    ];
}
