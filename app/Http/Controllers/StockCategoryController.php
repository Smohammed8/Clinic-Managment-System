<?php

namespace App\Http\Controllers;


use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StockCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StockCategoryStoreRequest;
use App\Http\Requests\StockCategoryUpdateRequest;

require_once app_path('Helper/constants.php');
class StockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StockCategory::class);

        $search = $request->get('search', '');

        $stockCategories = StockCategory::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'app.stock_categories.index',
            compact('stockCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StockCategory::class);

        return view('app.stock_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockCategoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StockCategory::class);

        $validated = $request->validated();

        $stockCategory = StockCategory::create($validated);

        return redirect()
            ->route('stock-categories.edit', $stockCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StockCategory $stockCategory): View
    {
        $this->authorize('view', $stockCategory);

        return view('app.stock_categories.show', compact('stockCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StockCategory $stockCategory): View
    {
        $this->authorize('update', $stockCategory);

        return view('app.stock_categories.edit', compact('stockCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StockCategoryUpdateRequest $request,
        StockCategory $stockCategory
    ): RedirectResponse {
        $this->authorize('update', $stockCategory);

        $validated = $request->validated();

        $stockCategory->update($validated);

        return redirect()
            ->route('stock-categories.edit', $stockCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StockCategory $stockCategory
    ): RedirectResponse {
        $this->authorize('delete', $stockCategory);

        $stockCategory->delete();

        return redirect()
            ->route('stock-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
