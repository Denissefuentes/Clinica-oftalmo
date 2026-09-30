<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expediente;

class Datos_adicionales extends Model
{
    protected $primaryKey = 'id_datos';

    protected $fillable = [
        'id_expediente',
        'uso_lentes',
        'tipo_lentes',
        'graduacion_previa',
        'quirurgicos_generales',
        'medicamentos_actuales',
        'otros_antecedentes',
        'retraso_desarrollo_psicomotor',
        'complicaciones_embarazo',
        'semanas_nacimiento',
        'peso_al_nacer'
    ];

    public function expediente(){
        return $this->belongsTo(Expediente::class,'id_expediente','id_expediente');
    }
}
