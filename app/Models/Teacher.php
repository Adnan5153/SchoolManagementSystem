<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'class_id', // New field
        'section',  // New field
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship: A teacher belongs to a class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
