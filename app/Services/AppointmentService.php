<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppointmentCreated;

class AppointmentService
{
	public static function handle(User $user, string $team_id)
	{
		$row = Appointment::create([
			'user_id' => $user->id,
			'team_id' => $team_id,
		]);

		User::where('email', env('ADMIN_EMAIL'))->first()->notify(new AppointmentCreated($user, $row));
	}
}