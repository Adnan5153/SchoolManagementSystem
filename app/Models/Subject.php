<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $table = 'subjects';

	protected $fillable = [
		'name',
		'class_id',
		'teacher_id'
	];

	public function class()
	{
		return $this->belongsTo(ClassModel::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}

	public function class_routines()
	{
		return $this->hasMany(ClassRoutine::class);
	}

	public function examschedules()
	{
		return $this->hasMany(Examschedule::class);
	}
}
