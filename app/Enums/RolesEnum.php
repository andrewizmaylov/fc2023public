<?php

namespace App\Enums;

use App\Models\Role;

class RolesEnum
{
	public const ADMINISTRATOR = 1;
	public const IGROK = 2;
	public const TRENER = 3;
	public const SUDO = 7;
	public const GLAVNYITRENER = 8;
	public const VRATAR = 9;
	public const ZASHHITNIK = 10;
	public const POLUZASHHITNIK = 11;
	public const NAPADAIUSHHII = 12;
	public const RUKOVODITELDIUFK = 13;


	public static function values()
	{
		return [
			self::ADMINISTRATOR,
			self::IGROK,
			self::TRENER,
			self::SUDO,
			self::GLAVNYITRENER,
			self::VRATAR,
			self::ZASHHITNIK,
			self::POLUZASHHITNIK,
			self::NAPADAIUSHHII,
			self::RUKOVODITELDIUFK,

		];
	}

	/**
	 * @return string
	 */
	public static function russianTitle($id): string
	{
		return match ($id) {
			1 => "Администратор",
			2 => "игрок",
			3 => "тренер",
			7 => "Sudo",
			8 => "главный тренер",
			9 => "вратарь",
			10 => "защитник",
			11 => "полузащитник",
			12 => "нападающий",
			13 => "руководитель дюфк",
		};
	}

	public static function getRealRoles(): \Illuminate\Database\Eloquent\Collection
	{
		return Role::all();
	}

}