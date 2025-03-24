<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function class_routines()
    {
        return $this->hasMany(ClassRoutine::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
