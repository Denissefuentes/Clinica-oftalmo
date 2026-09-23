<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_doctor';

    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'activo'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_doctor');
    }

    
}
