<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exploracion_oftalmologica extends Model
{
    protected $table = 'exploracion_oftalmologicas';

    protected $primaryKey = 'id_exploracion';

    protected $fillable = [
        'id_examen',

        // Ojo derecho
        'presion_intraocular_od',
        'parpados_anexos_od',
        'conjuntiva_od',
        'cornea_od',
        'camara_anterior_od',
        'iris_od',
        'pupilas_od',
        'cristalino_od',
        'fondo_ojo_od',

        // Ojo izquierdo
        'presion_intraocular_oi',
        'parpados_anexos_oi',
        'conjuntiva_oi',
        'cornea_oi',
        'camara_anterior_oi',
        'iris_oi',
        'pupilas_oi',
        'cristalino_oi',
        'fondo_ojo_oi',
    ];

    public function examen()
    {
        return $this->belongsTo(Examenes::class,'id_examen','id_examen');
    }
}
