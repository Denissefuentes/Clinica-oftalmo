<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
     protected $primaryKey = 'id_consulta';

    protected $fillable = [
        'id_expediente',
        'id_cita',
        'enfermedad_actual',
        'proxima_cita'
    ];

        public function expediente()
    {
        return $this->belongsTo(Expediente::class,'id_expediente', 'id_expediente');
    }

    public function cita()
    {
        return $this->belongsTo( Cita::class,'id_cita','id_cita');
    }
}
