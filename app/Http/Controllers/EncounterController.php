<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\LabTest;
use App\Models\LabCatagory;
use App\Models\Encounter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EncounterStoreRequest;
use App\Http\Requests\EncounterUpdateRequest;
use App\Models\Room;
use App\Models\User;
use App\Models\Student;

class EncounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Encounter::class);

        $search = $request->get('search', '');

        $encounters = Encounter::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.encounters.index', compact('encounters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Encounter::class);

        $clinics = Clinic::pluck('name', 'id');

        $student = Student::pluck('first_name', 'id');

        return view('app.encounters.create', compact('clinics', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EncounterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Encounter::class);

        $validated = $request->validated();

        $encounter = Encounter::create($validated);

        return redirect()
            ->route('encounters.edit', $encounter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Encounter $encounter): View
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        //dd($doctors);
        $this->authorize('view', $encounter);
        $labTests =  LabTest::all();
        $labCategories =  LabCatagory::all();

        $rooms = Room::all();


        return view('app.encounters.show', compact('encounter',  'doctors', 'labCategories', 'rooms'));
    }

    // call the next encounter 
    public function callNext(Request $request, Encounter $encounter)
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        $this->authorize('view', $encounter);
        //dd($encounter->status);

        // Get the current encounter's status from the form input
        $currentStatus = $encounter;
        // Update the current encounter's status to 1
        $encounter->status = 1;
        $encounter->save();

        // Find the next encounter with the same status and ID greater than the current encounter
        $nextEncounter = Encounter::where('status', 0)
            ->where('id', '>', $encounter->id)
            ->first();
        $encounter = $nextEncounter;

        // Redirect to the next encounter's show page with the updated ID in the URL
        //dd($nextEncounter);
        if ($nextEncounter) {
            $nextEncounterId = $nextEncounter->id;
            $nextEncounterUrl = route('encounters.show', ['encounter' => $nextEncounterId]);

            //return redirect($nextEncounterUrl)->with(compact('encounter'));
            return redirect($nextEncounterUrl);
        } else {
            // Redirect to a different route or display an appropriate message
            $currentStatus = $encounter;
            return view('app.encounters.show', compact('encounter',  'doctors'));
        }
    }

    //close encounter
    public function closeEencounter(Request $request, Encounter $encounter)
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        $this->authorize('view', $encounter);
        //dd($encounter->status);

        // Get the current encounter's status from the form input
        $currentStatus = $encounter;
        // Update the current encounter's status to 1
        $encounter->status = 1;
        $encounter->save();

        // Find the next encounter with the same status and ID greater than the current encounter
        $nextEncounter = Encounter::where('status', 0)
            ->where('id', '>', $encounter->id)
            ->first();
        $encounter = $nextEncounter;

        // Redirect to the next encounter's show page with the updated ID in the URL
        //dd($nextEncounter);
        if ($nextEncounter) {
            $nextEncounterId = $nextEncounter->id;
            $nextEncounterUrl = route('encounters.show', ['encounter' => $nextEncounterId]);

            //return redirect($nextEncounterUrl)->with(compact('encounter'));
            return redirect($nextEncounterUrl);
        } else {
            // Redirect to a different route or display an appropriate message
            $currentStatus = $encounter;
            return view('app.encounters.show', compact('encounter',  'doctors'));
        }
    }


    public function refer(Request $request, Encounter $encounter)
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        dd($doctors);

        return view('encounters.refer', compact('encounter', 'doctors'));
    }

    public function room(Request $request, Encounter $encounter)
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        dd($doctors);

        return view('encounters.room', compact('encounter', 'doctors'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Encounter $encounter): View
    {
        $this->authorize('update', $encounter);

        $clinics = Clinic::pluck('name', 'id');

        return view('app.encounters.edit', compact('encounter', 'clinics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EncounterUpdateRequest $request,
        Encounter $encounter
    ): RedirectResponse {
        $this->authorize('update', $encounter);

        $validated = $request->validated();

        $encounter->update($validated);

        return redirect()
            ->route('encounters.edit', $encounter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Encounter $encounter
    ) {
        $this->authorize('delete', $encounter);

        $encounter->delete();

        // return redirect()
        //     ->route('encounters.index')
        //     ->withSuccess(__('crud.common.removed'));
    }
}
