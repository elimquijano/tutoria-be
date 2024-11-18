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
        Schema::create('users', function (Blueprint $table) {
            $table->string('dni')->unique();
            $table->string('nombres');
            $table->string('ape_paterno');
            $table->string('ape_materno');
            $table->string('genero');
            $table->string('email');
            $table->string('password');
            $table->string('image')->default('images/profiles/default.png');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
