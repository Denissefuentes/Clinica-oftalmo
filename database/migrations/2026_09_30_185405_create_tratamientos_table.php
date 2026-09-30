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
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id('id_tratamiento');

            $table->unsignedBigInteger('id_consulta');

            $table->boolean('lentes')->default(false);
            $table->boolean('oclusion')->default(false);
            $table->text('medicacion')->nullable();
            $table->text('examenes_complementarios')->nullable();
            $table->text('referencias')->nullable();
            $table->string('control_en')->nullable();
            $table->text('manejo_medicamento')->nullable();
            $table->text('cirugia_propuesta')->nullable();
            $table->timestamps();
            $table->foreign('id_consulta')->references('id_consulta') ->on('consultas') ->onDelete('cascade');
            $table->unique('id_consulta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
