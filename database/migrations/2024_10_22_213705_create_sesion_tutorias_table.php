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
        Schema::create('sesion_tutorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained('tutors');
            $table->string('tema');
            $table->string('fecha_hora');
            $table->string('lugar');
            $table->text('descripcion');
            $table->enum('estado', ['programada', 'realizada', 'cancelada']);
            $table->enum('tipo', ['individual', 'grupal']);
            $table->boolean('notificacion_enviada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_tutorias');
    }
};
