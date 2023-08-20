<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Clinic;
use App\Models\LabTest;
use App\Models\Student;
use App\Models\Encounter;
use Illuminate\View\View;
use App\Models\LabCatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EncounterStoreRequest;
use App\Http\Requests\EncounterUpdateRequest;

class EncounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Encounter::class);

        $search = $request->get('search', '');
        $status = 0; // Change this to the desired status ID

        // Retrieve encounters with the desired status
        $desiredStatusEncounters = Encounter::search($search)
            ->where('status', $status)
            ->orderBy('created_at', 'asc') // Order by creation timestamp (first come, first served)
            ->paginate(10)
            ->withQueryString();

        // Retrieve encounters with other statuses (excluding the desired status)
        $otherStatusEncounters = Encounter::search($search)
            ->where('status', '<>', $status)
            ->orderBy('created_at', 'asc') // Order by creation timestamp in descending order
            ->paginate(10)
            ->withQueryString();

        // Combine the results
        $encounters = $desiredStatusEncounters->concat($otherStatusEncounters);

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
        // dd($request->student_id);
        $this->authorize('create', Encounter::class);
        $validated = $request->validated();
        // dd($validated); //registered_by
        $encounter = new Encounter($validated);
        $encounter->save();
        // return redirect()
        //     ->route('encounters.edit', $encounter)
        //     ->withSuccess(__('crud.common.created'));
        return redirect()
            ->back()
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

        //get rooms that belongs to the given encounter clinic
        $rooms = $encounter->clinic->rooms;
        // dd($rooms);


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



        // Redirect to the next encounter's show page with the updated ID in the URL
        //dd($nextEncounter);
        if ($nextEncounter) {
            $encounter = $nextEncounter;
            // dd($nextEncounter);
            $nextEncounterId = $nextEncounter->id;
            $nextEncounterUrl = route('encounters.show', ['encounter' => $nextEncounterId]);

            //return redirect($nextEncounterUrl)->with(compact('encounter'));
            return redirect($nextEncounterUrl);
        } else {
            // Redirect to a different route or display an appropriate message
            $doctors = User::whereHas('roles', function ($query) {
                $query->where('name', 'doctor');
            })->get();
            //dd($doctors);
            $this->authorize('view', $encounter);
            $labTests =  LabTest::all();
            $labCategories =  LabCatagory::all();

            //get rooms that belongs to the given encounter clinic
            $rooms = $encounter->clinic->rooms;
            // dd($rooms);
            $danger_message = 'No more encounters available.';



            return view('app.encounters.show', compact('encounter',  'doctors', 'labCategories', 'rooms', 'danger_message'));
        }
    }

    //doctor accept encounter 
    public function accept(Encounter $encounter)
    {
        // Get the authenticated user's ID
        $doctorId = Auth::id();

        // Update the encounter's status and doctor_id
        $encounter->status = 1;
        $encounter->doctor_id = $doctorId;
        // dd($encounter);

        $encounter->save();

        $encounterUrl = route('encounters.show', ['encounter' => $encounter]);

        //return redirect($nextEncounterUrl)->with(compact('encounter'));
        return redirect($encounterUrl);
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


        // Redirect to the next encounter's show page with the updated ID in the URL
        //dd($nextEncounter);
        if ($nextEncounter) {
            $encounter = $nextEncounter;
            $nextEncounterId = $nextEncounter->id;
            $nextEncounterUrl = route('encounters.show', ['encounter' => $nextEncounterId]);

            //return redirect($nextEncounterUrl)->with(compact('encounter'));
            return redirect($nextEncounterUrl);
        } else {
            //dd($encounter);
            // Redirect to a different route or display an appropriate message
            $doctors = User::whereHas('roles', function ($query) {
                $query->where('name', 'doctor');
            })->get();
            //dd($doctors);
            $this->authorize('view', $encounter);
            $labTests =  LabTest::all();
            $labCategories =  LabCatagory::all();

            //get rooms that belongs to the given encounter clinic
            $rooms = $encounter->clinic->rooms;
            // dd($rooms);
            $danger_message = 'No more encounters available.';



            return view('app.encounters.show', compact('encounter',  'doctors', 'labCategories', 'rooms', 'danger_message'));
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
        // Validate the request data
        $request->validate([
            'encounter_id' => 'required|exists:encounters,id',
            // 'room_id' => 'required|exists:rooms,id',
        ]);
        $doctor = $encounter->doctor;
        $doctor->room_id = $request->room_id;
        $doctor->save();
        // dd($doctor);
        //dd($encounter->doctor->user->name);
        return redirect()->back()->with('success', 'Room updated successfully.');
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
