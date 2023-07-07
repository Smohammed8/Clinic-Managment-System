<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Collage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CollageStoreRequest;
use App\Http\Requests\CollageUpdateRequest;

class CollageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Collage::class);

        $search = $request->get('search', '');

        $collages = Collage::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.collages.index', compact('collages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Collage::class);

        $campuses = Campus::pluck('name', 'id');

        return view('app.collages.create', compact('campuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollageStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Collage::class);

        $validated = $request->validated();

        $collage = Collage::create($validated);

        return redirect()
            ->route('collages.edit', $collage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Collage $collage): View
    {
        $this->authorize('view', $collage);

        return view('app.collages.show', compact('collage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Collage $collage): View
    {
        $this->authorize('update', $collage);

        $campuses = Campus::pluck('name', 'id');

        return view('app.collages.edit', compact('collage', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CollageUpdateRequest $request,
        Collage $collage
    ): RedirectResponse {
        $this->authorize('update', $collage);

        $validated = $request->validated();

        $collage->update($validated);

        return redirect()
            ->route('collages.edit', $collage)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Collage $collage
    ): RedirectResponse {
        $this->authorize('delete', $collage);

        $collage->delete();

        return redirect()
            ->route('collages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
