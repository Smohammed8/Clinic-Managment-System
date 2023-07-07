<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DiagnosisStoreRequest;
use App\Http\Requests\DiagnosisUpdateRequest;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Diagnosis::class);

        $search = $request->get('search', '');

        $diagnoses = Diagnosis::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.diagnoses.index', compact('diagnoses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Diagnosis::class);

        return view('app.diagnoses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiagnosisStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Diagnosis::class);

        $validated = $request->validated();

        $diagnosis = Diagnosis::create($validated);

        return redirect()
            ->route('diagnoses.edit', $diagnosis)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Diagnosis $diagnosis): View
    {
        $this->authorize('view', $diagnosis);

        return view('app.diagnoses.show', compact('diagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Diagnosis $diagnosis): View
    {
        $this->authorize('update', $diagnosis);

        return view('app.diagnoses.edit', compact('diagnosis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DiagnosisUpdateRequest $request,
        Diagnosis $diagnosis
    ): RedirectResponse {
        $this->authorize('update', $diagnosis);

        $validated = $request->validated();

        $diagnosis->update($validated);

        return redirect()
            ->route('diagnoses.edit', $diagnosis)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Diagnosis $diagnosis
    ): RedirectResponse {
        $this->authorize('delete', $diagnosis);

        $diagnosis->delete();

        return redirect()
            ->route('diagnoses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
