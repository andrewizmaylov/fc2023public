<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends SluggableModel
{
    use HasFactory;

	protected $fillable = [
		'id','name','slug','description','details','published_at','image'
	];

	protected $casts = [
		'details' => 'json',
		'published_at' => 'datetime',
	];

}
