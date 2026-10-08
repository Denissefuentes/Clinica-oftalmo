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
        Schema::table('users', function (Blueprint $table) {

            // Indica si la cuenta de usuario está habilitada
            // para iniciar sesión en el sistema.
            $table->boolean('activo')
                ->default(true)
                ->after('role');
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Eliminar el campo de estado de la cuenta.
            $table->dropColumn('activo');
        });
    }
};