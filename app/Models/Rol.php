<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = ['name', 'code','description'];
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'rol_users', 'rol_id', 'user_id');
    }
}
