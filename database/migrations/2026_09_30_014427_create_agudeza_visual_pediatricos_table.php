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
        Schema::create('agudeza_visual_pediatricos', function (Blueprint $table) {
            $table->id('id_agudeza');
            $table->foreignId('id_examen')->unique()->constrained('examenes', 'id_examen')->cascadeOnDelete();
            $table->string('av_con_cicloplejia_od')->nullable();
            $table->string('av_con_cicloplejia_os')->nullable();
            $table->string('av_sin_cicloplejia_od')->nullable();
            $table->string('av_sin_cicloplejia_os')->nullable();
            $table->boolean('metodo_optotipos')->default(false);
            $table->boolean('metodo_test_lea')->default(false);
            $table->boolean('metodo_mirada_preferencial')->default(false);
            $table->boolean('metodo_reflejo_rojo')->default(false);
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agudeza_visual_pediatricos');
    }
};
