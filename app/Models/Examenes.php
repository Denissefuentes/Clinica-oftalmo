<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;
use App\Models\agudeza_visual_pediatrico;
use App\Models\examen_visual_adultos;
use App\Models\alineacion_motilidad_ocular_pediatricos;
use App\Models\exploracion_oftalmologica;


class Examenes extends Model
{
    protected $primaryKey = 'id_examen';

    protected $fillable = ['id_consulta'];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class,'id_consulta','id_consulta');
    }

    public function agudeza_visual_pediatrico()
    {
        return $this->hasOne(agudeza_visual_pediatrico::class,'id_examen','id_examen');
    }

    public function examen_visual_adulto()
    {
        return $this->hasOne(examen_visual_adultos::class,'id_examen','id_examen');
    }

    public function alineacionMotilidadPediatrico()
    {
    return $this->hasOne(alineacion_motilidad_ocular_pediatricos::class,'id_examen','id_examen');
    }

    public function exploracionOftalmologica()
    {
    return $this->hasOne(exploracion_oftalmologica::class,'id_examen','id_examen');
    }   
}

