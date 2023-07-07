<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Appointment::class);

        $search = $request->get('search', '');

        $appointments = Appointment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.appointments.index',
            compact('appointments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Appointment::class);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.appointments.create',
            compact('encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Appointment::class);

        $validated = $request->validated();

        $appointment = Appointment::create($validated);

        return redirect()
            ->route('appointments.edit', $appointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Appointment $appointment): View
    {
        $this->authorize('view', $appointment);

        return view('app.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Appointment $appointment): View
    {
        $this->authorize('update', $appointment);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.appointments.edit',
            compact('appointment', 'encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AppointmentUpdateRequest $request,
        Appointment $appointment
    ): RedirectResponse {
        $this->authorize('update', $appointment);

        $validated = $request->validated();

        $appointment->update($validated);

        return redirect()
            ->route('appointments.edit', $appointment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
