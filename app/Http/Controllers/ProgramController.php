<?php

namespace App\Http\Controllers;


use App\Models\Campus;
use App\Models\Program;
use App\Models\Collage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProgramStoreRequest;
use App\Http\Requests\ProgramUpdateRequest;

require_once app_path('Helper/constants.php');
class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Program::class);

        $search = $request->get('search', '');

        $programs = Program::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.programs.index', compact('programs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Program::class);

        $collages = Collage::pluck('name', 'id');
        $campuses = Campus::pluck('name', 'id');

        return view('app.programs.create', compact('collages', 'campuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Program::class);

        $validated = $request->validated();

        $program = Program::create($validated);

        return redirect()
            ->route('programs.edit', $program)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Program $program): View
    {
        $this->authorize('view', $program);

        return view('app.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Program $program): View
    {
        $this->authorize('update', $program);

        $collages = Collage::pluck('name', 'id');
        $campuses = Campus::pluck('name', 'id');

        return view(
            'app.programs.edit',
            compact('program', 'collages', 'campuses')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProgramUpdateRequest $request,
        Program $program
    ): RedirectResponse {
        $this->authorize('update', $program);

        $validated = $request->validated();

        $program->update($validated);

        return redirect()
            ->route('programs.edit', $program)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Program $program
    ): RedirectResponse {
        $this->authorize('delete', $program);

        $program->delete();

        return redirect()
            ->route('programs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
