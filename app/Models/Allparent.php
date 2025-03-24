<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Allparent extends Model
{
	protected $table = 'allparents';

	protected $fillable = [
		'father_name',
		'mother_name',
		'father_occupation',
		'mother_occupation',
		'parent_email',
		'phone_number',
		'present_address',
		'permanent_address'
	];

	public function allstudents()
	{
		return $this->hasMany(Allstudent::class, 'parent_id');
	}
}
