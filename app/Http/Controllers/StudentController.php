<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Support\Facades\Auth;

require_once app_path('Helper/constants.php');
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Student::class);

        $students = Student::latest()->paginate(15) ->withQueryString();
    
        if ($request->filled('program')) {
        $students->where('program_id', 'like', '%' . $request->input('program') . '%');
        }
        if ($request->filled('dept')) {
        $students->where('department_id', 'like', '%' . $request->input('dept') . '%');
        }
        if ($request->filled('campus')) {
            $students->where('campus_id', 'like', '%' . $request->input('campus') . '%');
        }
    


        return view('app.students.srs-students', compact('students'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Student::class);

        $encounters = Encounter::pluck('id', 'id');

        return view('app.students.create', compact('encounters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Student::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $student = Student::create($validated);

        return redirect()
            ->route('students.edit', $student)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Student $student): View
    {
      //  $clinicUser = Auth::user()->clinicUsers->clinics->first();
        //dd($clinicUser);
        $this->authorize('view', $student);

        return view('app.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Student $student): View
    {
        $this->authorize('update', $student);

        $encounters = Encounter::pluck('id', 'id');

        return view('app.students.edit', compact('student', 'encounters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StudentUpdateRequest $request,
        Student $student
    ): RedirectResponse {
        $this->authorize('update', $student);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::delete($student->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $student->update($validated);

        return redirect()
            ->route('students.edit', $student)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Student $student
    ): RedirectResponse {
        $this->authorize('delete', $student);

        if ($student->photo) {
            Storage::delete($student->photo);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
