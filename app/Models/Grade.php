<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
	protected $table = 'grades';

	protected $fillable = [
		'min_marks',
		'max_marks',
		'grade',
		'remarks'
	];
}
