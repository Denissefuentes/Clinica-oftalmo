<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamientos extends Model
{
    protected $table = 'tratamientos';

    protected $primaryKey = 'id_tratamiento';

    protected $fillable = [
        'id_consulta',
        'lentes',
        'oclusion',
        'medicacion',
        'examenes_complementarios',
        'referencias',
        'control_en',
        'manejo_medicamento',
        'cirugia_propuesta',
    ];

    protected $casts = [
        'lentes' => 'boolean',
        'oclusion' => 'boolean',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class,'id_consulta','id_consulta');
    }

}
