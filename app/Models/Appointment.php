<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
	use HasUuids;

	protected $fillable = [
		'user_id', 'team_id', 'status', 'meta'
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
	public function team(): BelongsTo
	{
		return $this->belongsTo(Team::class);
	}
}
