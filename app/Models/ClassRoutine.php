<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;

    protected $table = 'class_routines'; // Define the table name

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id_number',
        'day_of_week',
        'start_time',
        'end_time',
        'room_number',
    ];

    /**
     * Relationship with Class
     */
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    /**
     * Relationship with Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * Relationship with Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(AllTeacher::class, 'teacher_id_number', 'teacher_id_number');
    }
}
