<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'allparents';

    // The attributes that are mass assignable
    protected $fillable = [
        'father_name',
        'mother_name',
        'father_occupation',
        'mother_occupation',
        'parent_email',
        'phone_number',
        'present_address',
        'permanent_address',
    ];

    /**
     * Define a one-to-many relationship with the AllStudent model.
     * One parent can have many students.
     */
    public function students()
    {
        return $this->hasMany(AllStudent::class, 'parent_id', 'id');
    }
}
