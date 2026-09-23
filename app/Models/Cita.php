<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;


class Cita extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'id_paciente',
        'id_doctor',
        'fecha',
        'hora',
        'motivo',
        'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }

    public function consulta()
    {
    return $this->hasOne(Consulta::class,'id_cita','id_cita');
    }
}

