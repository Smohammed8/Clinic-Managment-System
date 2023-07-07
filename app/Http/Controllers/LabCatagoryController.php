<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\LabCatagory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LabCatagoryStoreRequest;
use App\Http\Requests\LabCatagoryUpdateRequest;

class LabCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', LabCatagory::class);

        $search = $request->get('search', '');

        $labCatagories = LabCatagory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.lab_catagories.index',
            compact('labCatagories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', LabCatagory::class);

        return view('app.lab_catagories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabCatagoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', LabCatagory::class);

        $validated = $request->validated();

        $labCatagory = LabCatagory::create($validated);

        return redirect()
            ->route('lab-catagories.edit', $labCatagory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LabCatagory $labCatagory): View
    {
        $this->authorize('view', $labCatagory);

        return view('app.lab_catagories.show', compact('labCatagory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, LabCatagory $labCatagory): View
    {
        $this->authorize('update', $labCatagory);

        return view('app.lab_catagories.edit', compact('labCatagory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LabCatagoryUpdateRequest $request,
        LabCatagory $labCatagory
    ): RedirectResponse {
        $this->authorize('update', $labCatagory);

        $validated = $request->validated();

        $labCatagory->update($validated);

        return redirect()
            ->route('lab-catagories.edit', $labCatagory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        LabCatagory $labCatagory
    ): RedirectResponse {
        $this->authorize('delete', $labCatagory);

        $labCatagory->delete();

        return redirect()
            ->route('lab-catagories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
