<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\StoresToPharmacy;
use App\Http\Requests\StoresToPharmacyStoreRequest;
use App\Http\Requests\StoresToPharmacyUpdateRequest;

class StoresToPharmacyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', StoresToPharmacy::class);

        $search = $request->get('search', '');

        $storesToPharmacies = StoresToPharmacy::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.stores_to_pharmacies.index',
            compact('storesToPharmacies', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', StoresToPharmacy::class);

        $pharmacies = Pharmacy::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');

        return view(
            'app.stores_to_pharmacies.create',
            compact('pharmacies', 'stores')
        );
    }

    /**
     * @param \App\Http\Requests\StoresToPharmacyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresToPharmacyStoreRequest $request)
    {
        $this->authorize('create', StoresToPharmacy::class);

        $validated = $request->validated();

        $storesToPharmacy = StoresToPharmacy::create($validated);

        return redirect()
            ->route('stores-to-pharmacies.edit', $storesToPharmacy)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StoresToPharmacy $storesToPharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StoresToPharmacy $storesToPharmacy)
    {
        $this->authorize('view', $storesToPharmacy);

        return view(
            'app.stores_to_pharmacies.show',
            compact('storesToPharmacy')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StoresToPharmacy $storesToPharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, StoresToPharmacy $storesToPharmacy)
    {
        $this->authorize('update', $storesToPharmacy);

        $pharmacies = Pharmacy::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');

        return view(
            'app.stores_to_pharmacies.edit',
            compact('storesToPharmacy', 'pharmacies', 'stores')
        );
    }

    /**
     * @param \App\Http\Requests\StoresToPharmacyUpdateRequest $request
     * @param \App\Models\StoresToPharmacy $storesToPharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(
        StoresToPharmacyUpdateRequest $request,
        StoresToPharmacy $storesToPharmacy
    ) {
        $this->authorize('update', $storesToPharmacy);

        $validated = $request->validated();

        $storesToPharmacy->update($validated);

        return redirect()
            ->route('stores-to-pharmacies.edit', $storesToPharmacy)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StoresToPharmacy $storesToPharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        StoresToPharmacy $storesToPharmacy
    ) {
        $this->authorize('delete', $storesToPharmacy);

        $storesToPharmacy->delete();

        return redirect()
            ->route('stores-to-pharmacies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
