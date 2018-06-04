<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
	protected $table = 'meal';
	protected $fillable = ['name'];
	public $timestamps  = false;

	public function recipes()
	{
		return $this->hasMany(Recipe::class);
	}
}
