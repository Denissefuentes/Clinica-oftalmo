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
        Schema::create('examen_visual_adultos', function (Blueprint $table) {
            $table->id('id_examen_visual');
            $table->foreignId('id_examen')->unique()->constrained('examenes', 'id_examen')->cascadeOnDelete();
            $table->string('av_lejos_sin_correccion_od')->nullable();
            $table->string('av_lejos_sin_correccion_os')->nullable();
            $table->string('av_lejos_con_correccion_od')->nullable();
            $table->string('av_lejos_con_correccion_os')->nullable();
            $table->string('av_cerca_od')->nullable();
            $table->string('av_cerca_os')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_visual_adultos');
    }
};
