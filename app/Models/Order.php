<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
	use HasUuids;

	protected $fillable = [
		'user_id', 'merch_id', 'status', 'meta'
	];

	protected $casts = [
		'meta' => 'array'
	];

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return BelongsTo
	 */
	public function merch(): BelongsTo
	{
		return $this->belongsTo(Merch::class);
	}
}
