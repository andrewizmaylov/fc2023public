<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Role;
use App\Models\Team;
use App\Services\ContentCreation\DefaultCreator;
use App\Services\ContentCreation\RoleCreator;
use App\Services\ContentCreation\UserCreator;
use App\Traits\HasCreationRoutine;
use Illuminate\Support\Str;

class CreateClubFromDumpService
{
	use HasCreationRoutine;

	protected array $new_data;
	private DefaultCreator $creator;
	private UserCreator $userCreator;
	private mixed $dump;

//	private \Illuminate\Database\Eloquent\Collection $roles;

	public function __construct()
	{
		$this->creator = new DefaultCreator();
		$this->userCreator = new userCreator();
		$this->dump = json_decode(file_get_contents(database_path('setup_data/teams.json')), true)['teams'];
		$this->club = Club::where('name', 'star')->first();

		$this->loadDataFromDump();
	}


	private function loadDataFromDump()
	{
		foreach ($this->dump as $record) {
			$team = $this->creationRoutine(array(
				'name' => trim($record['name']), 'slug' => Str::slug(trim($record['name']))
			), 'Team');

			Team::where('id', $team->id)->update([
				'published_at' => now(),
				'club_id' => $this->club->id
			]);

			foreach ($record['staff'] as $user) {
				$this->new_data[] = $this->prepareUserData($user, $team);
			}
		}
		$users = $this->userCreator->createInstance($this->new_data);

		return back();
	}

	/**
	 * @param  string  $user
	 * @param  Team  $team
	 * @return array
	 */
	private function prepareUserData(string $user, Team $team): array
	{
		$row = explode(',', $user);

		$fio = explode(' ', $row[0]);
		$first_name = $fio[0];
		$second_name = count($fio) === 3 ? $fio[1] : null;
		$last_name = count($fio) === 3 ? $fio[2] : $fio[1];

		$email = Str::slug($first_name).'.'.Str::slug($last_name).'@fczvezda.com';

		$birthday = $this->formatBirthday($row[1]);

		$role = count($row) === 3 ? $this->getRole($row[2]) : $this->getRole($row[3]);

		return [
			'email'              => $email,
			'profile_photo_path' => 'profile_photo_path/'.Str::slug($first_name).Str::slug($last_name).'.jpg',
			'first_name'         => $first_name,
			'last_name'          => $last_name,
			'second_name'        => $second_name,
			'birthday'           => $birthday,
			'role'               => $role,
			'team_id'            => $team->id,
		];
	}

	/**
	 * @param $date
	 * @return string
	 */
	public function formatBirthday($date): string
	{
		$dateString = explode(' ', trim($date));

		$month = match ($dateString[1]) {
			'ЯНВАРЯ' => '01',
			'ФЕВРАЛЯ' => '02',
			'МАРТА' => '03',
			'АПРЕЛЯ' => '04',
			'МАЯ' => '05',
			'ИЮНЯ' => '06',
			'ИЮЛЯ' => '07',
			'АВГУСТА' => '08',
			'СЕНТЯБРЯ' => '09',
			'ОКТЯБРЯ' => '10',
			'НОЯБРЯ' => '11',
			'ДЕКАБРЯ' => '12',
		};

		return "$dateString[2]-$month-$dateString[0]";
	}

	/**
	 * @param  string  $role
	 * @return int
	 */
	private function getRole(string $role): int
	{
		if (!Role::where('full_name', mb_strtolower(trim($role), 'UTF-8'))->first()) {
			$creator = new RoleCreator();
			$creator->createInstance([
				'id'        => Role::latest('id')->first()->id + 1 ?? 1,
				'full_name' => mb_strtolower(trim($role), 'UTF-8'),
				'name'      => strtoupper(Str::slug(trim($role), '')),
			]);

			$creator->updateSystemConfig();
		}

		$role = Role::where('full_name', '=', mb_strtolower(trim($role), 'UTF-8'))->first();

		return $role->id;
	}

}