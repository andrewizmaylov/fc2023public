<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Services\ContentCreation\RoleCreator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
	private RoleCreator $creator;

	public function __construct()
	{
		$this->creator = new RoleCreator();
	}

	/**
	 * @return Response
	 */
	public function index(): \Inertia\Response
	{
		return Inertia::render('API/Roles/RolesIndex', [
			'roles' => Role::all(),
		]);
	}

	/**
	 * @param  StoreRoleRequest  $request
	 * @return RedirectResponse
	 */
	public function upsertRole(StoreRoleRequest $request): \Illuminate\Http\RedirectResponse
	{
		$validated = $request->validated();

		$roleData = [
			'id' => $request->id,
			'full_name' => strtolower($validated['full_name']),
			'name' => strtoupper(Str::slug($validated['full_name'], '')),
		];

		$this->creator->createInstance($roleData);

		$this->creator->updateSystemConfig();

		return back()->with('message', 'Role updated');
    }
}
