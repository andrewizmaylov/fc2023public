<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\ContentCreation\UserCreator;
use App\Traits\HasCreationRoutine;
use Inertia\Inertia;

class AppointmentController extends Controller
{
	use HasCreationRoutine;

	private UserCreator $creator;

	public function __construct()
	{
		$this->middleware('admin')->only(['index', 'edit', 'destroy']);
		$this->creator = new UserCreator();
	}
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Appointment/AppointmentIndex', [
			'appointments' => Appointment::with(['user', 'user.contact', 'team'])->orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
	    $validated = $request->validated();
	    $response = $this->creationRoutine(array($validated), 'User');

	    AppointmentService::handle($response[0], $request->team_id);

	    return back()->with('message', 'Request was submited');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
	    return Inertia::render('Appointment/AppointmentShow', [
		    'appointment' => $appointment->load(['user', 'user.contact', 'team'])
	    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
