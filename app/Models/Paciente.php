<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;


class Paciente extends Model
{
    use HasFactory;
     protected $primaryKey = 'id_paciente';
    protected $fillable = [
           'nombre',
           'f_nacimiento',
           'sexo',
           'direccion',
           'tipo_paciente',
           'cedula',
           'ocupacion',
           'telefono'
    ]; 

    public function citas(){
        return $this->hasMany(Cita::class, 'id_paciente');
    }

    public function expediente(){
        return $this->hasOne(Expediente::class, 'id_paciente');
    }
}
