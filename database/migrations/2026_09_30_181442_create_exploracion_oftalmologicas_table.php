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
        Schema::create('exploracion_oftalmologicas', function (Blueprint $table) {
            $table->id('id_exploracion');
            $table->unsignedBigInteger('id_examen');

            $table->text('presion_intraocular_od')->nullable();
            $table->text('parpados_anexos_od')->nullable();
            $table->text('conjuntiva_od')->nullable();
            $table->text('cornea_od')->nullable();
            $table->text('camara_anterior_od')->nullable();
            $table->text('iris_od')->nullable();
            $table->text('pupilas_od')->nullable();
            $table->text('cristalino_od')->nullable();
            $table->text('fondo_ojo_od')->nullable();

            $table->text('presion_intraocular_oi')->nullable();
            $table->text('parpados_anexos_oi')->nullable();
            $table->text('conjuntiva_oi')->nullable();
            $table->text('cornea_oi')->nullable();
            $table->text('camara_anterior_oi')->nullable();
            $table->text('iris_oi')->nullable();
            $table->text('pupilas_oi')->nullable();
            $table->text('cristalino_oi')->nullable();
            $table->text('fondo_ojo_oi')->nullable();
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
        Schema::dropIfExists('exploracion_oftalmologicas');
    }
};
