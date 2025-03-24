<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
	protected $table = 'class_routines';
	protected $fillable = [
		'class_id',
		'subject_id',
		'teacher_id',
		'day_of_week',
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

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
