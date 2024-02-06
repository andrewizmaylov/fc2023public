<?php

namespace App\Services\ContentCreation;

use App\Contracts\ContentCreationInterface;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleCreator extends ContentCreation
{
	public function createInstance(array $data): ContentCreationInterface
	{
		DB::transaction(function () use ($data) {
			$this->instances = Role::updateOrCreate(['id' => $data['id']], [...$data]);
		});

		return $this;
	}

	/**
	 * @return RedirectResponse
	 */
	public function updateSystemConfig(): \Illuminate\Http\RedirectResponse
	{
		$php_const_list = "";
		$js_const_list = "";
		$php_values_eng = "";
		$php_values_rus = "";
		$index = '$id';

		foreach (Role::all() as $role) {
			$key = strtoupper(STR::slug($role->full_name, ''));
			$php_const_list .= 'public const '.$key.' = '.$role['id'].';'.PHP_EOL;
			$js_const_list .= $key.': '.$role['id'].','.PHP_EOL;
			$php_values_eng .= 'self::'.$key.','.PHP_EOL;
			$php_values_rus .= $role['id'].' => "'.$role->full_name.'",'.PHP_EOL;
		}


		$rolesPhpEnum = base_path('app/Enums/RolesEnum.php');
		$rolesJsEnum = base_path('resources/js/Enums/RolesEnum.js');

		if (!file_exists($rolesPhpEnum)) {
			fopen($rolesPhpEnum, 'w');
		}

		if (!file_exists($rolesJsEnum)) {
			fopen($rolesJsEnum, 'w');
		}

		$phpContent = <<<PHP
		<?php

		namespace App\Enums;

		use App\Models\Role;

		class RolesEnum
		{
		    $php_const_list

		    public static function values()
		    {
		        return [
		            $php_values_eng
		        ];
		    }
		    
		    /**
			 * @return string
			 */
			public static function russianTitle($index): string
		    {
		        return match ($index) {
		            $php_values_rus
		        };
		    }

		    public static function getRealRoles(): \Illuminate\Database\Eloquent\Collection
		    {
		        return Role::all();
		    }

		}
		PHP;

		$jsContent = <<<PHP
		export const RolesEnum = Object.freeze({
			$js_const_list
		});
		PHP;

		// Write the content to the file
		file_put_contents($rolesPhpEnum, $phpContent);
		file_put_contents($rolesJsEnum, $jsContent);

		return back();
	}
}