<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MedicalRecordStoreRequest;
use App\Http\Requests\MedicalRecordUpdateRequest;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', MedicalRecord::class);

        $search = $request->get('search', '');

        $medicalRecords = MedicalRecord::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.medical_records.index',
            compact('medicalRecords', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', MedicalRecord::class);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.medical_records.create',
            compact('encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalRecordStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', MedicalRecord::class);

        $validated = $request->validated();

        $medicalRecord = MedicalRecord::create($validated);

        return redirect()
            ->route('medical-records.edit', $medicalRecord)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, MedicalRecord $medicalRecord): View
    {
        $this->authorize('view', $medicalRecord);

        return view('app.medical_records.show', compact('medicalRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, MedicalRecord $medicalRecord): View
    {
        $this->authorize('update', $medicalRecord);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.medical_records.edit',
            compact('medicalRecord', 'encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MedicalRecordUpdateRequest $request,
        MedicalRecord $medicalRecord
    ): RedirectResponse {
        $this->authorize('update', $medicalRecord);

        $validated = $request->validated();

        $medicalRecord->update($validated);

        return redirect()
            ->route('medical-records.edit', $medicalRecord)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        MedicalRecord $medicalRecord
    ): RedirectResponse {
        $this->authorize('delete', $medicalRecord);

        $medicalRecord->delete();

        return redirect()
            ->route('medical-records.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
