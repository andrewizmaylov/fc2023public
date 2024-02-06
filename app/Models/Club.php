<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Club extends Model
{
    use HasFactory;
	use HasUuids;

	protected $fillable = [
		'id', 'name'
	];

	/**
	 * @return HasMany
	 */
	public function teams(): HasMany
	{
		return $this->hasMany(Team::class);
	}

	/**
	 * @return HasMany
	 */
	public function stadiums(): HasMany
	{
		return $this->hasMany(Stadium::class);
	}

	public function text(): MorphOne
	{
		return $this->morphOne(Text::class, 'textable');
	}
}
