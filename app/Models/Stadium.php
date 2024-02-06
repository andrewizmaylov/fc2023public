<?php

namespace App\Models;

use App\Traits\HasImageTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Stadium extends SluggableModel
{
    use HasFactory;
	use HasImageTrait;

	protected $table = 'stadia';

	protected $fillable = [
		'id','name','slug','description','details','published_at','banner','club_id'
	];

	protected $casts = [
		'details' => 'array',
	];

	protected $appends = [
		'banner_url'
	];


	/**
	 * Get the stadiums address.
	 */
	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'addressable');
	}

	/**
	 * Get the text model for the news.
	 */
	public function text(): MorphOne
	{
		return $this->morphOne(Text::class, 'textable');
	}
}
