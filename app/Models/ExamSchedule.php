<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examschedule extends Model
{
	protected $table = 'examschedules';

	protected $fillable = [
		'class_id',
		'subject_id',
		'exam_date',
		'start_time',
		'end_time',
		'room_number'
	];

	public function class()
	{
		return $this->belongsTo(ClassModel::class);
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
