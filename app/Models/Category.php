<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function getName(): string
    {
        return $this->toArray()['name_' . locale()];
    }
}
