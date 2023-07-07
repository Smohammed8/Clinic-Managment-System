<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\MainDiagnosis;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PrescriptionStoreRequest;
use App\Http\Requests\PrescriptionUpdateRequest;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Prescription::class);

        $search = $request->get('search', '');

        $prescriptions = Prescription::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.prescriptions.index',
            compact('prescriptions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Prescription::class);

        $mainDiagnoses = MainDiagnosis::pluck('id', 'id');

        return view('app.prescriptions.create', compact('mainDiagnoses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrescriptionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Prescription::class);

        $validated = $request->validated();

        $prescription = Prescription::create($validated);

        return redirect()
            ->route('prescriptions.edit', $prescription)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Prescription $prescription): View
    {
        $this->authorize('view', $prescription);

        return view('app.prescriptions.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Prescription $prescription): View
    {
        $this->authorize('update', $prescription);

        $mainDiagnoses = MainDiagnosis::pluck('id', 'id');

        return view(
            'app.prescriptions.edit',
            compact('prescription', 'mainDiagnoses')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PrescriptionUpdateRequest $request,
        Prescription $prescription
    ): RedirectResponse {
        $this->authorize('update', $prescription);

        $validated = $request->validated();

        $prescription->update($validated);

        return redirect()
            ->route('prescriptions.edit', $prescription)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Prescription $prescription
    ): RedirectResponse {
        $this->authorize('delete', $prescription);

        $prescription->delete();

        return redirect()
            ->route('prescriptions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
