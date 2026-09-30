<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examen;

class agudeza_visual_pediatrico extends Model
{
    protected $table = 'agudeza_visual_pediatricos';

    protected $primaryKey = 'id_agudeza';

    protected $fillable = [
        'id_examen',
        'av_con_cicloplejia_od',
        'av_con_cicloplejia_os',
        'av_sin_cicloplejia_od',
        'av_sin_cicloplejia_os',
        'metodo_optotipos',
        'metodo_test_lea',
        'metodo_mirada_preferencial',
        'metodo_reflejo_rojo',
        'observaciones',
    ];

    protected $casts = [
        'metodo_optotipos' => 'boolean',
        'metodo_test_lea' => 'boolean',
        'metodo_mirada_preferencial' => 'boolean',
        'metodo_reflejo_rojo' => 'boolean',
    ];

    public function examen()
    {
        return $this->belongsTo(Examenes::class,'id_examen','id_examen');
    }

}
