<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gpa extends Model
{
	protected $table = 'gpas';

	protected $fillable = [
		'student_id',
		'gpa',
		'semester'
	];

	public function allstudent()
	{
		return $this->belongsTo(Allstudent::class, 'student_id');
	}
}
