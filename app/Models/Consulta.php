<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examenes;
class Consulta extends Model
{
    protected $primaryKey = 'id_consulta';

    protected $fillable = [
        'id_expediente',
        'id_cita',
        'enfermedad_actual',
        'diagnostico',
        'proxima_cita',
    ];

        public function expediente()
    {
        return $this->belongsTo(Expediente::class,'id_expediente', 'id_expediente');
    }

    public function cita()
    {
        return $this->belongsTo( Cita::class,'id_cita','id_cita');
    }

    public function examen()
    {
    return $this->hasOne(Examenes::class,'id_consulta','id_consulta');
    }

    public function alineacionMotilidadPediatrico()
    {
    return $this->hasOne(alineacion_motilidad_ocular_pediatricos::class,'id_examen','id_examen');
    }

    public function tratamiento()
    {
    return $this->hasOne(Tratamientos::class,'id_consulta','id_consulta');
    }
}



