<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = ['name', 'class_id'];

    /**
     * Define the relationship: A subject belongs to a class.
     */
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id'); // Linking to classes table
    }
}
