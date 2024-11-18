<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPrivilegio extends Model
{
    protected $fillable = ['rol_id', 'privilegio_id'];
    use HasFactory;
}
