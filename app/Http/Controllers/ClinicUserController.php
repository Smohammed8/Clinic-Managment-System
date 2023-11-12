<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Room;
use App\Models\Clinic;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClinicUserStoreRequest;
use App\Http\Requests\ClinicUserUpdateRequest;

require_once app_path('Helper/constants.php');
class ClinicUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ClinicUser::class);

        $search = $request->get('search', '');

        $clinicUsers = ClinicUser::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.clinic_users.index', compact('clinicUsers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ClinicUser::class);

        $users = User::pluck('name', 'id');
        $encounters = Encounter::pluck('id', 'id');

        $clinics = Clinic::get();
        $rooms = Room::get();

        return view(
            'app.clinic_users.create',
            compact('users', 'encounters', 'clinics', 'rooms')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicUserStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ClinicUser::class);

        $validated = $request->validated();

        $clinicUser = ClinicUser::create($validated);

        $clinicUser->clinics()->attach($request->clinics);
        $clinicUser->rooms()->attach($request->rooms);

        return redirect()
            ->route('clinic-users.edit', $clinicUser)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ClinicUser $clinicUser): View
    {
        $this->authorize('view', $clinicUser);

        return view('app.clinic_users.show', compact('clinicUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ClinicUser $clinicUser): View
    {
        $this->authorize('update', $clinicUser);

        $users = User::pluck('name', 'id');
        $encounters = Encounter::pluck('id', 'id');

        $clinics = Clinic::get();
        $rooms = Room::get();

        return view(
            'app.clinic_users.edit',
            compact('clinicUser', 'users', 'encounters', 'clinics', 'rooms')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ClinicUserUpdateRequest $request,
        ClinicUser $clinicUser
    ): RedirectResponse {
        $this->authorize('update', $clinicUser);

        $validated = $request->validated();
        $clinicUser->clinics()->sync($request->clinics);
        $clinicUser->rooms()->sync($request->rooms);

        $clinicUser->update($validated);

        return redirect()
            ->route('clinic-users.edit', $clinicUser)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ClinicUser $clinicUser
    ): RedirectResponse {
        $this->authorize('delete', $clinicUser);

        $clinicUser->delete();

        return redirect()
            ->route('clinic-users.index')
            ->withSuccess(__('crud.common.removed'));
    }


    public function updateClinicUserClinic(Request $request)
    {
        // Validate the form data
        dd($request->clinic_id);
        $request->validate([
            'clinic_id' => 'required', // Add any other validation rules if needed
        ]);

        // Your authorization logic goes here

        // Access the selected clinic_id from the request
        $selectedClinicId = $request->input('clinic_id');

        // Your updating logic goes here

        // Redirect or return a response as needed
    }
}
