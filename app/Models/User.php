<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RolesEnum;
use App\Traits\HasImageTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\Features;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use Notifiable;
	use TwoFactorAuthenticatable;
	use HasUuids;
	use HasImageTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'profile_photo_path',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'two_factor_recovery_codes',
		'two_factor_secret',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array<int, string>
	 */
	protected $appends = [
		'profile_photo_url',
	];

	/**
	 * @return HasOne
	 */
	public function contact(): \Illuminate\Database\Eloquent\Relations\HasOne
	{
		return $this->hasOne(Contact::class);
	}


	/**
	 * @return BelongsToMany
	 */
	public function teams(): BelongsToMany
	{
		return $this->belongsToMany(Team::class,'team_user');
	}

	/**
	 * Get the user's address.
	 */
	public function address(): MorphOne
	{
		return $this->morphOne(Address::class, 'addressable');
	}

	/**
	 * @param  string|array  $role
	 * @return void
	 */
	public function assignRole(string|array $role): void
	{
		$this->roles()->sync($role);
	}

	/**
	 * @return BelongsToMany
	 */
	public function roles(): BelongsToMany
	{
		return $this->belongsToMany(\App\Models\Role::class);
	}

	public function isAdmin(): bool
	{
		return $this->hasRole(RolesEnum::ADMINISTRATOR) || $this->hasRole(RolesEnum::SUDO);
	}

	/**
	 * @param  int  $role
	 * @return mixed
	 */
	public function hasRole(int $role): mixed
	{
		return $this->roles->contains($role);
	}

	/**
	 * @return void
	 */
	public function deleteProfilePhoto(): void
	{
		if (!Features::managesProfilePhotos()) {
			return;
		}

		if (is_null($this->profile_photo_path)) {
			return;
		}

		Storage::disk($this->fileDisk())->delete($this->profile_photo_path);

		$this->forceFill([
			'profile_photo_path' => null,
		])->save();
	}

	/**
	 * @return HasMany
	 */
	public function sponsorships(): HasMany
	{
		return $this->hasMany(Sponsorship::class);
	}

	public function appointments()
	{
		return $this->hasMany(Appointment::class);
	}
}
