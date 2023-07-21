<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use Illuminate\Http\Request;
use App\Models\MedicalSickLeave;

class MedicalSickLeaveController extends Controller
{
    public function index()
    {
        // dd("this is here");
        $medicalSickLeaves = MedicalSickLeave::all();
        //dd($medicalSickLeaves);
        return view('app.medical_sick_leaves.index', compact('medicalSickLeaves'));
    }



    public function create()
    {
        return view('app.medical_sick_leaves.create');
    }

    public function store(Request $request)
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

        MedicalSickLeave::create($request->all());
        return redirect()->route('medical-sick-leaves.index')->with('success', 'Medical sick leave created successfully.');
    }

    public function show(Request $request)
    {

        $lastNumber = basename($request->path());
        $lastNumber = (int)$lastNumber;
        // dd($lastNumber);
        $medicalSickLeaves = MedicalSickLeave::where('encounter_id', $lastNumber)->first();
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
