<?php

namespace App\Http\Controllers;


use App\Models\StockUnit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StockUnitStoreRequest;
use App\Http\Requests\StockUnitUpdateRequest;

require_once app_path('Helper/constants.php');
class StockUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StockUnit::class);

        $search = $request->get('search', '');

        $stockUnits = StockUnit::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.stock_units.index', compact('stockUnits', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StockUnit::class);

        return view('app.stock_units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockUnitStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StockUnit::class);

        $validated = $request->validated();

        $stockUnit = StockUnit::create($validated);

        return redirect()
            ->route('stock-units.edit', $stockUnit)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StockUnit $stockUnit): View
    {
        $this->authorize('view', $stockUnit);

        return view('app.stock_units.show', compact('stockUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StockUnit $stockUnit): View
    {
        $this->authorize('update', $stockUnit);

        return view('app.stock_units.edit', compact('stockUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StockUnitUpdateRequest $request,
        StockUnit $stockUnit
    ): RedirectResponse {
        $this->authorize('update', $stockUnit);

        $validated = $request->validated();

        $stockUnit->update($validated);

        return redirect()
            ->route('stock-units.edit', $stockUnit)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StockUnit $stockUnit
    ): RedirectResponse {
        $this->authorize('delete', $stockUnit);

        $stockUnit->delete();

        return redirect()
            ->route('stock-units.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
