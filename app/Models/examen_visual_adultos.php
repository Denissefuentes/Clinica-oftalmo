<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examenes;


class examen_visual_adultos extends Model
{
    protected $table = 'examen_visual_adultos';

    protected $primaryKey = 'id_examen_visual';

    protected $fillable = [
        'id_examen',
        'av_lejos_sin_correccion_od',
        'av_lejos_sin_correccion_os',
        'av_lejos_con_correccion_od',
        'av_lejos_con_correccion_os',
        'av_cerca_od',
        'av_cerca_os',
        'observaciones',
    ];

    public function examen()
    {
        return $this->belongsTo(Examenes::class,'id_examen','id_examen');
    }
}
