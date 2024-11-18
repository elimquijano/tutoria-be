<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionTutoria extends Model
{
    use HasFactory;
    protected $fillable = ['tutor_id', 'tema', 'fecha_hora', 'lugar', 'descripcion', 'estado', 'tipo', 'notificacion_enviada'];
}
