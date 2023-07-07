<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\View\View;
use App\Models\LabCatagory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LabTestStoreRequest;
use App\Http\Requests\LabTestUpdateRequest;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', LabTest::class);

        $search = $request->get('search', '');

        $labTests = LabTest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.lab_tests.index', compact('labTests', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', LabTest::class);

        $labCatagories = LabCatagory::pluck('lab_name', 'id');

        return view('app.lab_tests.create', compact('labCatagories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabTestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', LabTest::class);

        $validated = $request->validated();

        $labTest = LabTest::create($validated);

        return redirect()
            ->route('lab-tests.edit', $labTest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LabTest $labTest): View
    {
        $this->authorize('view', $labTest);

        return view('app.lab_tests.show', compact('labTest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, LabTest $labTest): View
    {
        $this->authorize('update', $labTest);

        $labCatagories = LabCatagory::pluck('lab_name', 'id');

        return view('app.lab_tests.edit', compact('labTest', 'labCatagories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LabTestUpdateRequest $request,
        LabTest $labTest
    ): RedirectResponse {
        $this->authorize('update', $labTest);

        $validated = $request->validated();

        $labTest->update($validated);

        return redirect()
            ->route('lab-tests.edit', $labTest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        LabTest $labTest
    ): RedirectResponse {
        $this->authorize('delete', $labTest);

        $labTest->delete();

        return redirect()
            ->route('lab-tests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
