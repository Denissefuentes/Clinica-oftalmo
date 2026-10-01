<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->foreignId('id_expediente')->constrained('expedientes', 'id_expediente')->cascadeOnDelete();
            $table->foreignId('id_cita')->nullable()->constrained('citas', 'id_cita')->nullOnDelete();
            $table->string('enfermedad_actual')->nullable();
            $table->text('diagnostico')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
