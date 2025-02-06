<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // Explicitly defining the table name

    protected $fillable = [
        'class_name',
        'section',
        'capacity',
    ];
}
