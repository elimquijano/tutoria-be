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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->string('codigo_universitario')->nullable();
            $table->string('anio')->nullable();
            $table->string('situacion')->default('REGULAR');
            $table->string('en_riesgo_academico')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('dni')->on('users');
            $table->foreign('tutor_id')->references('id')->on('tutors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
