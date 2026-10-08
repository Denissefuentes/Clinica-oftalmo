<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\models\Doctor;

// Campos que pueden ser asignados mediante formularios o asignación masiva.
#[Fillable(['name', 'email', 'password', 'role', 'activo'])]

// Manejo de duración de sesion
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

    // Relación entre la cuenta de usuario y su perfil profesional de doctor.
    // Un usuario con rol doctor puede tener un solo perfil de doctor.
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id_user');
    }

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
