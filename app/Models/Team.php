<?php

namespace App\Models;

use App\Enums\RolesEnum;
use App\Traits\HasImageTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

class Team extends SluggableModel
{
    use HasFactory;
	use HasImageTrait;

	protected $fillable = [
		'id','name','slug','description','details','published_at','logo','banner','club_id'
	];

	protected $appends = [
		'logo_url',
	];

	/**
	 * @param  Builder  $query
	 * @return Builder
	 */
	public static function scopePublished(Builder $query): Builder
	{
		return $query->whereNotNull('published_at');
	}

	/**
	 * @param  User  $user
	 * @return void
	 */
	public function joinTeam(User $user): void
	{
		$this->players()->attach($user);
	}

	/**
	 * @param  Collection  $users
	 * @return void
	 */
	public function joinByList(Collection $users): void
	{
		$this->players()
			->attach(
				$users->pluck('id')->toArray()
			);
	}

	/**
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'team_user');
	}


	/**
	 * @return BelongsToMany
	 */
	public function players(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(User::class)
			->whereHas('roles', function ($query) {
				$query->whereIn('role_id', [
					RolesEnum::IGROK,
					RolesEnum::VRATAR,
					RolesEnum::ZASHHITNIK,
					RolesEnum::POLUZASHHITNIK,
					RolesEnum::NAPADAIUSHHII,
				]);
			});
	}
	/**
	 * @return BelongsToMany
	 */
	public function couchs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(User::class)
			->whereHas('roles', function ($query) {
				$query->where('role_id', RolesEnum::TRENER);
			});
	}

	/**
	 * @return BelongsTo
	 */
	public function club(): BelongsTo
	{
		return $this->belongsTo(Club::class);
	}

	/**
	 * Get the text model for the team.
	 */
	public function text(): MorphOne
	{
		return $this->morphOne(Text::class, 'textable');
	}

	/**
	 * @return HasMany
	 */
	public function games(): HasMany
	{
		return $this->hasMany(Game::class)->orderBy('date');
	}
}
