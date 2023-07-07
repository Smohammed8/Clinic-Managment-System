<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CampusStoreRequest;
use App\Http\Requests\CampusUpdateRequest;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Campus::class);

        $search = $request->get('search', '');

        $campuses = Campus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.campuses.index', compact('campuses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Campus::class);

        return view('app.campuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampusStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Campus::class);

        $validated = $request->validated();

        $campus = Campus::create($validated);

        return redirect()
            ->route('campuses.edit', $campus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Campus $campus): View
    {
        $this->authorize('view', $campus);

        return view('app.campuses.show', compact('campus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Campus $campus): View
    {
        $this->authorize('update', $campus);

        return view('app.campuses.edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CampusUpdateRequest $request,
        Campus $campus
    ): RedirectResponse {
        $this->authorize('update', $campus);

        $validated = $request->validated();

        $campus->update($validated);

        return redirect()
            ->route('campuses.edit', $campus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Campus $campus): RedirectResponse
    {
        $this->authorize('delete', $campus);

        $campus->delete();

        return redirect()
            ->route('campuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
