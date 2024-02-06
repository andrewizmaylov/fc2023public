<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Services\GetModelService;
use Illuminate\Http\Request;

class ToggleClubController extends Controller
{
	public function __invoke(Request $request)
	{
		$model = GetModelService::getModel($request->model, $request->id);

		if ($model->club_id) {
			$model->update(['club_id' => null]);
		} else {
			$model->update(['club_id' => Club::first()->id]);
		}

		return back();
    }
}
