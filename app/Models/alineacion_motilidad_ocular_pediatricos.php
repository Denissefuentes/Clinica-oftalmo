<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alineacion_motilidad_ocular_pediatricos extends Model
{
    protected $table = 'alineacion_motilidad_ocular_pediatricos';

    protected $primaryKey = 'id_alineacion';

    protected $fillable = [
        'id_examen',

        'hirschberg_resultado',
        'hirschberg_direccion',
        'hirschberg_desviacion',

        'cover_resultado',
        'cover_tipo_tropia',
        'cover_modalidad',
        'cover_distancia',
        'cover_cerca',

        'versiones_resultado',
        'versiones_limitadas',

        'ducciones_resultado',
        'ducciones_limitadas',

        'nistagmo',
        'nistagmo_tipo',

        'ojo_dominante',
    ];

    public function examen()
    {
        return $this->belongsTo(Examenes::class,'id_examen','id_examen');
    }
}

