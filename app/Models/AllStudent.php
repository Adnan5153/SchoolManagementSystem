<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllStudent extends Model
{
    use HasFactory;

    protected $table = 'allstudents';

    // Set the custom primary key
    protected $primaryKey = 'student_id';

    // Disable auto-incrementing since the student_id is manually assigned
    public $incrementing = false;

    // Set the primary key type to 'integer'
    protected $keyType = 'integer';

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'class',
        'section',
        'gender',
        'date_of_birth',
        'admission_number',
        'religion',
        'email',
        'parent_id',
    ];

    /**
     * Define the relationship with the ParentModel.
     * Each student belongs to one parent.
     */
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id', 'id');
    }

    /**
     * Relationship to the student account.
     */
    public function studentAccount()
    {
        return $this->hasOne(Student::class, 'email', 'email');
    }
}
