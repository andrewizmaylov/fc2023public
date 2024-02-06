<?php

namespace App\Http\Controllers;

use App\Services\GetModelService;
use Illuminate\Http\Request;

class TogglePublishedController extends Controller
{
	public function __invoke(Request $request)
	{
		$model = GetModelService::getModel($request->model, $request->item['id']);

		$model->update(['published_at' => $model->published_at ? null : now()->format('Y-m-d H:i:s')]);
    }
}
