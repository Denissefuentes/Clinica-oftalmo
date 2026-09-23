<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Antecedentes;
use App\Models\Consulta;

class Expediente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_expediente';

    protected $fillable=[
            'id_paciente',
            'fecha_apertura'
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function antecedentes(){
        return $this->belongsToMany(Antecedentes::class,'antecedente_expediente','id_expediente','id_antecedentes');
    }

    public function datos_adicionales(){
        return $this->hasOne(Datos_adicionales::class,'id_expediente','id_expediente');
    }

    public function consultas()
{
    return $this->hasMany(Consulta::class,'id_expediente','id_expediente');
}
}
