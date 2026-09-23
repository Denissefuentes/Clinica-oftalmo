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
        Schema::create('datos_adicionales', function (Blueprint $table) {
            $table->id('id_datos');
            $table->foreignId('id_expediente')->unique()->constrained('expedientes','id_expediente')->cascadeOnDelete();
            $table->boolean('uso_lentes');
            $table->string('tipo_lentes')->nullable();
            $table->string('graduacion_previa')->nullable();
            $table->string('quirurgicos_generales')->nullable();
            $table->string('medicamentos_actuales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_adicionales');
    }
};
