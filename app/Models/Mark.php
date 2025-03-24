<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mark extends Model
{
	protected $table = 'marks';
	
	protected $fillable = [
		'student_id',
		'teacher_id',
		'subject',
		'marks',
		'remarks'
	];

	public function allstudent()
	{
		return $this->belongsTo(Allstudent::class, 'student_id');
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
