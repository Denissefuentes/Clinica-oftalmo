<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Definir la clave primaria personalizada de la tabla doctors.
    protected $primaryKey = 'id_doctor';

    // Campos que pueden ser asignados mediante el modelo.
    protected $fillable = [
        'id_user',
        'nombre',
        'cedula',
        'telefono',
        'activo'
    ];

    // Relación entre el perfil profesional y su cuenta de usuario.
    // Cada doctor pertenece a una cuenta de usuario.
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

     // Relación entre el doctor y sus citas.
     // Un doctor puede tener muchas citas.
     
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_doctor');
    }
}