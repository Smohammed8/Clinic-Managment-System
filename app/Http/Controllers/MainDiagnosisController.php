<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\Diagnosis;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use App\Models\MainDiagnosis;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MainDiagnosisStoreRequest;
use App\Http\Requests\MainDiagnosisUpdateRequest;

require_once app_path('Helper/constants.php');
class MainDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', MainDiagnosis::class);

        $search = $request->get('search', '');

        $mainDiagnoses = MainDiagnosis::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.main_diagnoses.index',
            compact('mainDiagnoses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', MainDiagnosis::class);

        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');
        $encounters = Encounter::pluck('id', 'id');
        $diagnoses = Diagnosis::pluck('name', 'id');

        return view(
            'app.main_diagnoses.create',
            compact('clinicUsers', 'students', 'encounters', 'diagnoses')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainDiagnosisStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', MainDiagnosis::class);

        $validated = $request->validated();

        $mainDiagnosis = MainDiagnosis::create($validated);

        return redirect()
            ->route('main-diagnoses.edit', $mainDiagnosis)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, MainDiagnosis $mainDiagnosis): View
    {
        $this->authorize('view', $mainDiagnosis);

        return view('app.main_diagnoses.show', compact('mainDiagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, MainDiagnosis $mainDiagnosis): View
    {
        $this->authorize('update', $mainDiagnosis);

        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');
        $encounters = Encounter::pluck('id', 'id');
        $diagnoses = Diagnosis::pluck('name', 'id');

        return view(
            'app.main_diagnoses.edit',
            compact(
                'mainDiagnosis',
                'clinicUsers',
                'students',
                'encounters',
                'diagnoses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MainDiagnosisUpdateRequest $request,
        MainDiagnosis $mainDiagnosis
    ): RedirectResponse {
        $this->authorize('update', $mainDiagnosis);

        $validated = $request->validated();

        $mainDiagnosis->update($validated);

        return redirect()
            ->route('main-diagnoses.edit', $mainDiagnosis)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        MainDiagnosis $mainDiagnosis
    ): RedirectResponse {
        $this->authorize('delete', $mainDiagnosis);

        $mainDiagnosis->delete();

        return redirect()
            ->route('main-diagnoses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
