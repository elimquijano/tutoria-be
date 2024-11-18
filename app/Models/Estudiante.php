<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tutor_id', 'codigo_universitario', 'anio', 'situacion', 'en_riesgo_academico'];
}
