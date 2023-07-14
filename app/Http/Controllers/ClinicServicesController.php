<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ClinicServices;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClinicServicesStoreRequest;
use App\Http\Requests\ClinicServicesUpdateRequest;

class ClinicServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ClinicServices::class);

        $search = $request->get('search', '');

        $allClinicServices = ClinicServices::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.all_clinic_services.index',
            compact('allClinicServices', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ClinicServices::class);

        return view('app.all_clinic_services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicServicesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ClinicServices::class);

        $validated = $request->validated();

        $clinicServices = ClinicServices::create($validated);

        return redirect()
            ->route('all-clinic-services.edit', $clinicServices)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ClinicServices $clinicServices): View
    {
        $this->authorize('view', $clinicServices);

        return view('app.all_clinic_services.show', compact('clinicServices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ClinicServices $clinicServices): View
    {
        $this->authorize('update', $clinicServices);

        $clinics = Clinic::get();

        return view(
            'app.all_clinic_services.edit',
            compact('clinicServices', 'clinics')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ClinicServicesUpdateRequest $request,
        ClinicServices $clinicServices
    ): RedirectResponse {
        $this->authorize('update', $clinicServices);

        $validated = $request->validated();
        $clinicServices->clinics()->sync($request->clinics);

        $clinicServices->update($validated);

        return redirect()
            ->route('all-clinic-services.edit', $clinicServices)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ClinicServices $clinicServices
    ): RedirectResponse {
        $this->authorize('delete', $clinicServices);

        $clinicServices->delete();

        return redirect()
            ->route('all-clinic-services.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
