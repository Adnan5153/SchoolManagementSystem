<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
	use Notifiable;
	protected $table = 'students';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'class_id',
		'section',
		'remember_token'
	];

	public function class()
	{
		return $this->belongsTo(ClassModel::class);
	}
}
