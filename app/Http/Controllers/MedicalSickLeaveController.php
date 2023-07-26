<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use Illuminate\Http\Request;
use App\Models\MedicalSickLeave;

class MedicalSickLeaveController extends Controller
{
    // public function index()
    // {
    //     $medicalSickLeaves = MedicalSickLeave::all();
    //     return view('app.medical_sick_leaves.show', compact('medicalSickLeaves'));
    // }

    public function index(Request $request)
    {
        $searchTerm = $request->query('search');

        $medicalSickLeaves = MedicalSickLeave::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->whereHas('student', function ($studentQuery) use ($searchTerm) {
                    $studentQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('student_id', 'like', '%' . $searchTerm . '%');
                });
            })
            ->get();

        return view('app.medical_sick_leaves.show', compact('medicalSickLeaves'));
    }


    public function create()
    {
        return view('app.medical_sick_leaves.create');
    }

    public function store(Request $request)
    {
        // dd($request->encounter_id);
        $request->validate([
            'reason' => 'required',
            'note' => 'nullable',
            'medical_certificate' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'student_id' => 'nullable|exists:students,id',
            'doctor_id' => 'exists:clinic_users,id',
            'encounter_id' => 'required|integer',


        ]);


        // Check if a MedicalSickLeave with the given encounter_id already exists
        $existingSickLeave = MedicalSickLeave::where('encounter_id', $request['encounter_id'])->first();

        if ($existingSickLeave) {
            // Return a message that the encounter already has a sick leave
            return redirect()->route('medical-sick-leaves.index')->with('error', 'This encounter already has a sick leave.');
        }

        // If no existing MedicalSickLeave with the encounter_id is found, create a new one
        MedicalSickLeave::create($request->all());
        return redirect()->route('medical-sick-leaves.index')->with('success', 'Medical sick leave created successfully.');
    }

    public function show(Request $request, MedicalSickLeave $medicalSickLeaves)
    {

        // dd($medicalSickLeaves);
        $lastNumber = basename($request->path());
        $lastNumber = (int)$lastNumber;
        // dd($lastNumber);
        $medicalSickLeaves = MedicalSickLeave::where('id', $lastNumber)->first();
        // dd($medicalSickLeaves);
        //dd($medicalSickLeaves);

        return view('app.medical_sick_leaves.index', compact('medicalSickLeaves'));
    }

    public function edit(MedicalSickLeave $medicalSickLeave)
    {
        return view('app.medical_sick_leaves.edit', compact('medicalSickLeave'));
    }

    public function update(Request $request, MedicalSickLeave $medicalSickLeave)
    {
        $request->validate([
            'reason' => 'required',
            'note' => 'nullable',
            'medical_certificate' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'student_id' => 'nullable|exists:students,id',
            'doctor_id' => 'exists:clinic_users,id',
        ]);

        $medicalSickLeave->update($request->all());
        return redirect()->route('medical-sick-leaves.index')->with('success', 'Medical sick leave updated successfully.');
    }

    public function destroy(MedicalSickLeave $medicalSickLeave)
    {
        $medicalSickLeave->delete();
        return redirect()->route('medical-sick-leaves.index')->with('success', 'Medical sick leave deleted successfully.');
    }
}
