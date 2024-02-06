<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Merch;
use App\Models\Position;
use App\Models\Stadium;
use App\Models\Team;
use Inertia\Inertia;

class ClubController extends Controller
{
	public function teams()
	{
		return Inertia::render('Club/ClubIndex', [
			'club'        => Club::with(['text', 'teams'])->first(),
			'defined_tab' => 'club.teams'
		]);
	}

	public function history()
	{
		return Inertia::render('Club/ClubIndex', [
			'club'        => Club::with('text')->first(),
			'defined_tab' => 'club.history'
		]);
	}

	public function partners()
	{
		return Inertia::render('Club/ClubIndex', [
			'defined_tab' => 'club.partners'
		]);
	}

	public function bookAppointment()
	{
		return Inertia::render('Club/ClubIndex', [
			'club'        => Club::with(['text', 'teams'])->first(),
			'defined_tab' => 'club.book_appointment'
		]);
	}


	public function fans()
	{
		return Inertia::render('Fans/FansIndex', [
			'defined_tab' => 'club.fans_info',
		]);
	}

	public function faq()
	{
		return Inertia::render('Fans/FansIndex', [
			'defined_tab' => 'club.faq',
		]);
	}
	public function merchIndex()
	{
		$merch = Merch::isAdmin()->get();
//		dd($merch);
		return Inertia::render('Fans/FansIndex', [
			'merch' => $merch,
			'defined_tab' => 'club.merch_index',
		]);
	}

	public function partnersPresentation()
	{
		return Inertia::render('Position/PositionIndex', [
			'defined_tab' => 'club.partners_presentation'
		]);
	}
	public function partnersCatalog()
	{
		return Inertia::render('Position/PositionIndex', [
			'positions' => Position::all(),
			'defined_tab' => 'club.partners_catalog'
		]);
	}

	public function stadiums()
	{
		return Inertia::render('Stadium/StadiumIndex', [
			'stadiums'    => Stadium::all(),
			'defined_tab' => 'club.stadiums'
		]);
	}

	public function stadiumsOther()
	{
		return Inertia::render('Stadium/StadiumIndex', [
			'stadiums'    => Stadium::all(),
			'defined_tab' => 'club.stadiums_other'
		]);
	}

	public function stadiumsPartners()
	{
		return Inertia::render('Stadium/StadiumIndex', [
			'stadiums'    => Stadium::all(),
			'defined_tab' => 'club.stadiums_partners'
		]);
	}

	public function teamMembers($team)
	{
		return Inertia::render('Team/TeamShow', [
			'team'        => Team::with('text')->where('id', $team)->firstOrFail(),
			'defined_tab' => 'team.members'
		]);
	}

	public function teamNews($team)
	{
		return Inertia::render('Team/TeamShow', [
			'team'        => Team::with('text')->where('id', $team)->firstOrFail(),
			'defined_tab' => 'team.news'
		]);
	}

	public function teamGames($team)
	{
		return Inertia::render('Team/TeamShow', [
			'team'        => Team::with('text')->where('id', $team)->firstOrFail(),
			'defined_tab' => 'team.games'
		]);
	}

	public function teamPartners($team)
	{
		return Inertia::render('Team/TeamShow', [
			'team'        => Team::with('text')->where('id', $team)->firstOrFail(),
			'defined_tab' => 'team.partners'
		]);
	}

	public function teamBookAppointment($team)
	{
		return Inertia::render('Team/TeamShow', [
			'team'        => Team::with('text')->where('id', $team)->firstOrFail(),
			'defined_tab' => 'team.book_appointment'
		]);
	}
}
