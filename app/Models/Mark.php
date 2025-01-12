<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $fillable = [
        'student_id', 
        'teacher_id_number', 
        'subject', 
        'marks', 
        'remarks',
    ];

    public function teacher() {
        return $this->belongsTo(AllTeacher::class, 'teacher_id_number', 'teacher_id_number');
    }
    
    public function student() {
        return $this->belongsTo(AllStudent::class, 'student_id', 'student_id');
    }
    
}
