<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpa extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'gpa',
        'semester',
    ];

    public function student()
    {
        return $this->belongsTo(AllStudent::class, 'student_id', 'student_id');
    }
}
