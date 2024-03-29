<?php

namespace App\Services\ContentCreation;

use App\Contracts\ContentCreationInterface;
use App\Enums\RolesEnum;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserCreator extends ContentCreation
{
	public function createInstance(array $data): ContentCreationInterface
	{
		try {
			DB::transaction(function () use ($data) {
				$user_data = [];
				$user_contact_data = [];
				$user_role_data = [];
				$user_team_data = [];

				$defaultPassword = Hash::make('password');

				foreach ($data as $row) {
					$user = User::where('email', $row['email'])->first();
					$userId = $user->id ?? Str::uuid()->toString();

					$user_data[] = [
						'id'                 => $userId,
						'email'              => $row['email'],
						'password'           => $defaultPassword,
						'profile_photo_path' => $row['profile_photo_path'] ?? null,
					];
				}

				User::upsert($user_data, ['email'], ['password', 'profile_photo_path']);

				foreach ($data as $row) {
					$user = User::where('email', $row['email'])->first();
					$userId = $user->id ?? Str::uuid()->toString();


					$user_contact_data[] = [
						'user_id'     => $userId,
						'first_name'  => $row['first_name'] ?? null,
						'last_name'   => $row['last_name'] ?? null,
						'second_name' => $row['second_name'] ?? null,
						'tg'          => $row['tg'] ?? null,
						'birthday'    => $this->getBirthday($row['birthday']) ?? null,
					];

					$role = isset($row['role']) ? (int) $row['role'] : RolesEnum::IGROK;
					$user_role_data[$userId] = $role;

					if ($row['team_id']) {
						$user_team_data[$userId] = $row['team_id'];
					}
				}

				User::upsert($user_data, ['email'], ['password', 'profile_photo_path']);

				Contact::upsert($user_contact_data, ['user_id'],
					['first_name', 'last_name', 'second_name', 'tg', 'birthday']);

				foreach ($user_role_data as $userId => $roleId) {
					User::find($userId)->roles()->syncWithoutDetaching([(int) $roleId]);
				}

				foreach ($user_team_data as $userId => $teamId) {
					User::find($userId)->teams()->syncWithoutDetaching([(string) $teamId]);
				}

				$this->instances = User::whereIn('id', array_keys($user_role_data))
					->with(['roles', 'contact'])
					->get();
			});
		} catch (\Exception $e) {
			echo __('app.user_not_created');
		}

		return $this;
	}


	/**
	 * @param $date
	 * @return \DateTime|Carbon
	 */
	public function getBirthday($date): \DateTime|Carbon
	{
		if (is_string($date)) {
			// $date type is string (from form input)
			return Carbon::parse($date);
		}

		// $date type is int (from exel import)
		return Date::excelToDateTimeObject($date);
	}
}