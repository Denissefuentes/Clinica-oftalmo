<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {

            // Relaciona cada perfil profesional con una cuenta de usuario.
            // Se permite null porque ya existen doctores registrados
            // que todavía no tienen una cuenta asociada.
            $table->foreignId('id_user')
                ->nullable()
                ->after('id_doctor')
                ->unique()
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {

            // Eliminar primero la relación con users.
            $table->dropForeign(['id_user']);

            // Eliminar la columna de asociación.
            $table->dropColumn('id_user');
        });
    }
};