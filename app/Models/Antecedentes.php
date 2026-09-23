<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expediente;

class Antecedentes extends Model
{
    protected $primaryKey = 'id_antecedentes';
    protected $fillable = [
        'nombre',
        'categoria',
        'tipo_paciente'
    ];

    public function expedientes(){
        return $this->belongsToMany(Expediente::class,'antecedente_expediente','id_antecedentes','id_expediente');
    }
    
}
