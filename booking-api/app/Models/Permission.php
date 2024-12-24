<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    // Связь с пользователями через роли
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_id', 'role_id');
    }
}
