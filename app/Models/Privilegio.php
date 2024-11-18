<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $fillable = ['name', 'code','description', 'type', 'id_modulo'];
    use HasFactory;
}
