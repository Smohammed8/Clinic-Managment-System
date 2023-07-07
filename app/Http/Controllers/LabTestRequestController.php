<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ClinicUser;
use App\Models\LabCatagory;
use Illuminate\Http\Request;
use App\Models\LabTestRequest;
use App\Models\LabTestRequestGroup;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LabTestRequestStoreRequest;
use App\Http\Requests\LabTestRequestUpdateRequest;

class LabTestRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', LabTestRequest::class);

        $search = $request->get('search', '');

        $labTestRequests = LabTestRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.lab_test_requests.index',
            compact('labTestRequests', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', LabTestRequest::class);

        $labTestRequestGroups = LabTestRequestGroup::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $labCatagories = LabCatagory::pluck('lab_name', 'id');

        return view(
            'app.lab_test_requests.create',
            compact(
                'labTestRequestGroups',
                'clinicUsers',
                'clinicUsers',
                'labCatagories',
                'clinicUsers'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabTestRequestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', LabTestRequest::class);

        $validated = $request->validated();

        $labTestRequest = LabTestRequest::create($validated);

        return redirect()
            ->route('lab-test-requests.edit', $labTestRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LabTestRequest $labTestRequest): View
    {
        $this->authorize('view', $labTestRequest);

        return view('app.lab_test_requests.show', compact('labTestRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, LabTestRequest $labTestRequest): View
    {
        $this->authorize('update', $labTestRequest);

        $labTestRequestGroups = LabTestRequestGroup::pluck('id', 'id');
        $clinicUsers = ClinicUser::pluck('id', 'id');
        $labCatagories = LabCatagory::pluck('lab_name', 'id');

        return view(
            'app.lab_test_requests.edit',
            compact(
                'labTestRequest',
                'labTestRequestGroups',
                'clinicUsers',
                'clinicUsers',
                'labCatagories',
                'clinicUsers'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LabTestRequestUpdateRequest $request,
        LabTestRequest $labTestRequest
    ): RedirectResponse {
        $this->authorize('update', $labTestRequest);

        $validated = $request->validated();

        $labTestRequest->update($validated);

        return redirect()
            ->route('lab-test-requests.edit', $labTestRequest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        LabTestRequest $labTestRequest
    ): RedirectResponse {
        $this->authorize('delete', $labTestRequest);

        $labTestRequest->delete();

        return redirect()
            ->route('lab-test-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
