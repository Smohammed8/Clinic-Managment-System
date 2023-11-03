<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\VitalSign;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VitalSignStoreRequest;
use App\Http\Requests\VitalSignUpdateRequest;

require_once app_path('Helper/constants.php');
class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', VitalSign::class);

        $search = $request->get('search', '');

        $vitalSigns = VitalSign::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.vital_signs.index', compact('vitalSigns', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', VitalSign::class);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.vital_signs.create',
            compact('encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VitalSignStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', VitalSign::class);

        $validated = $request->validated();

        $vitalSign = VitalSign::create($validated);

        return redirect()
            ->route('vital-signs.edit', $vitalSign)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, VitalSign $vitalSign): View
    {
        $this->authorize('view', $vitalSign);

        return view('app.vital_signs.show', compact('vitalSign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, VitalSign $vitalSign): View
    {
        $this->authorize('update', $vitalSign);

        $encounters = Encounter::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $students = Student::pluck('first_name', 'id');

        return view(
            'app.vital_signs.edit',
            compact('vitalSign', 'encounters', 'clinicUsers', 'students')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        VitalSignUpdateRequest $request,
        VitalSign $vitalSign
    ): RedirectResponse {
        $this->authorize('update', $vitalSign);

        $validated = $request->validated();

        $vitalSign->update($validated);

        return redirect()
            ->route('vital-signs.edit', $vitalSign)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        VitalSign $vitalSign
    ): RedirectResponse {
        $this->authorize('delete', $vitalSign);

        $vitalSign->delete();

        return redirect()
            ->route('vital-signs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
