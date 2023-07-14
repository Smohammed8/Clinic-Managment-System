<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use App\Models\LabTestRequestGroup;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LabTestRequestGroupStoreRequest;
use App\Http\Requests\LabTestRequestGroupUpdateRequest;

class LabTestRequestGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', LabTestRequestGroup::class);

        $search = $request->get('search', '');

        $labTestRequestGroups = LabTestRequestGroup::search($search)
            ->first()->paginate(10)->withQueryString();

            return view(
            'app.lab_test_request_groups.index',
            compact('labTestRequestGroups', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', LabTestRequestGroup::class);

        $clinicUsers = ClinicUser::pluck('id', 'id');
        $encounters = Encounter::pluck('id', 'id');

        return view(
            'app.lab_test_request_groups.create',
            compact('clinicUsers', 'encounters')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        LabTestRequestGroupStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', LabTestRequestGroup::class);

        $validated = $request->validated();

        $labTestRequestGroup = LabTestRequestGroup::create($validated);

        return redirect()
            ->route('lab-test-request-groups.edit', $labTestRequestGroup)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        LabTestRequestGroup $labTestRequestGroup
    ): View {
        $this->authorize('view', $labTestRequestGroup);

        return view(
            'app.lab_test_request_groups.show',
            compact('labTestRequestGroup')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        LabTestRequestGroup $labTestRequestGroup
    ): View {
        $this->authorize('update', $labTestRequestGroup);

        $clinicUsers = ClinicUser::pluck('id', 'id');
        $encounters = Encounter::pluck('id', 'id');

        return view(
            'app.lab_test_request_groups.edit',
            compact('labTestRequestGroup', 'clinicUsers', 'encounters')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LabTestRequestGroupUpdateRequest $request,
        LabTestRequestGroup $labTestRequestGroup
    ): RedirectResponse {
        $this->authorize('update', $labTestRequestGroup);

        $validated = $request->validated();

        $labTestRequestGroup->update($validated);

        return redirect()
            ->route('lab-test-request-groups.edit', $labTestRequestGroup)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        LabTestRequestGroup $labTestRequestGroup
    ): RedirectResponse {
        $this->authorize('delete', $labTestRequestGroup);

        $labTestRequestGroup->delete();

        return redirect()
            ->route('lab-test-request-groups.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
