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
        Schema::create('alineacion_motilidad_ocular_pediatricos', function (Blueprint $table) {
            $table->id('id_alineacion');
            $table->unsignedBigInteger('id_examen');
            // Test de Hirschberg
            $table->string('hirschberg_resultado')->nullable();
            $table->string('hirschberg_direccion')->nullable();
            $table->string('hirschberg_desviacion')->nullable();
            // Cover Test
            $table->string('cover_resultado')->nullable();
            $table->string('cover_tipo_tropia')->nullable();
            $table->string('cover_modalidad')->nullable();
            $table->string('cover_distancia')->nullable();
            $table->string('cover_cerca')->nullable();
            // Versiones
            $table->string('versiones_resultado')->nullable();
            $table->text('versiones_limitadas')->nullable();
            // Ducciones
            $table->string('ducciones_resultado')->nullable();
            $table->text('ducciones_limitadas')->nullable();
            // Nistagmo
            $table->string('nistagmo')->nullable();
            $table->string('nistagmo_tipo')->nullable();
            // Ojo dominante
            $table->string('ojo_dominante')->nullable();
            $table->timestamps();

            $table->foreign('id_examen')->references('id_examen')->on('examenes')->onDelete('cascade');

            $table->unique('id_examen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alineacion_motilidad_ocular_pediatricos');
    }
};
