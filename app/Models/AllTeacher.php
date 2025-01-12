<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTeacher extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'allteachers';

    // Specify the primary key for this model
    protected $primaryKey = 'teacher_id_number';

    // Indicate if the IDs are auto-incrementing
    public $incrementing = false; // Because 'teacher_id_number' is not auto-incrementing

    // The "type" of the primary key
    protected $keyType = 'string'; // Use 'string' if the ID is not numeric

    // The attributes that are mass assignable
    protected $fillable = [
        'teacher_id_number',
        'first_name',
        'last_name',
        'class',
        'section',
        'subject',
        'gender',
        'date_of_birth',
        'joining_date',
        'nid_number',
        'religion',
        'email',
        'phone',
        'address',
    ];
    public function marks()
    {
        return $this->hasMany(Mark::class, 'teacher_id_number', 'teacher_id_number');
    }
}
