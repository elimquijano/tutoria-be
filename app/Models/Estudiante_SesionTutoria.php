<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante_SesionTutoria extends Model
{
    use HasFactory;
    protected $fillable = ['estudiante_id', 'sesion_tutoria_id'];
}
