<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Store;
use App\Models\Clinic;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRequest;
use App\Http\Requests\ProductRequestStoreRequest;
use App\Http\Requests\ProductRequestUpdateRequest;
use App\Models\Pharmacy;
use App\Models\PharmacyUser;
use App\Models\StoresToPharmacy;
use App\Models\StoreUser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if (Auth::user()->hasRole(Constants::STORE_USER_ROLE)) {

            $storeUser = StoreUser::where('user_id', Auth::user()->id)->first();
            // dd($storeUser);
            $store = Store::where('id', $storeUser->store_id)->first();


            $search = $request->get('search', '');

            $productRequests = ProductRequest::where('store_id', $storeUser->store_id)->where('status',)->search($search)
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return view(
                'app.product_requests.index',
                compact('productRequests', 'search')
            );
        }
        else if (Auth::user()->hasRole(Constants::PHARMACY_USER)) {
            $pharmacyUser = PharmacyUser::where('user_id', Auth::user()->id)->first();
            $pharmacy = Pharmacy::where('id', $pharmacyUser->pharmacy_id)->first();
            // dd($pharmacy->id);

            $search = $request->get('search', '');
            $productRequests=ProductRequest::where('pharmacy_id',$pharmacy->id)->search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

            return view(
                'app.product_requests.index',
                compact('productRequests', 'search')
            );

        }


        $this->authorize('view-any', ProductRequest::class);

        $search = $request->get('search', '');

        $productRequests = ProductRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.product_requests.index',
            compact('productRequests', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->hasRole(Constants::PHARMACY_USER)) {
            $pharmacyUser = PharmacyUser::where('user_id', Auth::user()->id)->first();
            $pharmacy = Pharmacy::where('id', $pharmacyUser->pharmacy_id)->first();

            $clinics = Clinic::pluck('name', 'id');
            $products=Product::where('store_id',StoresToPharmacy::where('pharmacy_id',$pharmacy->id)->pluck('store_id'))->pluck('name', 'id');
            $storeToPharmacy = (StoresToPharmacy::where('pharmacy_id', $pharmacy->id))->get();
            $stores = array();
            foreach ($storeToPharmacy as  $value) {
                $s = Store::where('id', $value->store_id)->first();


                array_push($stores, $s);
            }

            return view(
                'app.product_requests.create',
                compact('clinics', 'products', 'stores')
            );
        }
        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized access.');
        // $this->authorize('create', ProductRequest::class);

        // $clinics = Clinic::pluck('name', 'id');
        // $products = Product::pluck('name', 'id');
        // $stores = Store::pluck('name', 'id');

        // return view(
        //     'app.product_requests.create',
        //     compact('clinics', 'products', 'stores')
        // );
    }

    /**
     * @param \App\Http\Requests\ProductRequestStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequestStoreRequest $request)
    {

        if (Auth::user()->hasRole(Constants::PHARMACY_USER)) {
            $pharmacyUser = PharmacyUser::where('user_id', Auth::user()->id)->first();
            $pharmacy = Pharmacy::where('id', $pharmacyUser->pharmacy_id)->first();


            $validated = $request->validated();
            // dd($validated);
            $validated['pharmacy_id'] = $pharmacy->id;

            $productRequest = ProductRequest::create($validated);

            return redirect()
                ->route('product-requests.edit', $productRequest)
                ->withSuccess(__('crud.common.created'));
        }
        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized access.');
        // $this->authorize('create', ProductRequest::class);

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductRequest $productRequest)
    {
        // $this->authorize('view', $productRequest);

        return view('app.product_requests.show', compact('productRequest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductRequest $productRequest)
    {

        if (Auth::user()->hasRole(Constants::PHARMACY_USER)) {



            $pharmacyUser = PharmacyUser::where('user_id', Auth::user()->id)->first();
            $pharmacy = Pharmacy::where('id', $pharmacyUser->pharmacy_id)->first();

            $clinics = Clinic::pluck('name', 'id');
            $products=Product::where('store_id',StoresToPharmacy::where('pharmacy_id',$pharmacy->id)->pluck('store_id'))->pluck('name', 'id');
            $storeToPharmacy = (StoresToPharmacy::where('pharmacy_id', $pharmacy->id))->get();
            $stores = array();
            foreach ($storeToPharmacy as  $value) {
                $s = Store::where('id', $value->store_id)->first();


                array_push($stores, $s);
            }

            $clinics = Clinic::pluck('name', 'id');
            $products = Product::pluck('name', 'id');

            return view(
                'app.product_requests.edit',
                compact('productRequest', 'clinics', 'products', 'stores')
            );
        }

        $this->authorize('update', $productRequest);
    }

    /**
     * @param \App\Http\Requests\ProductRequestUpdateRequest $request
     * @param \App\Models\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function update(
        ProductRequestUpdateRequest $request,
        ProductRequest $productRequest
    ) {



        if (Auth::user()->hasRole(Constants::PHARMACY_USER)) {
            $pharmacyUser = PharmacyUser::where('user_id', Auth::user()->id)->first();
            $pharmacy = Pharmacy::where('id', $pharmacyUser->pharmacy_id)->first();

            $validated = $request->validated();

            $productRequest->update($validated);

            return redirect()
                ->route('product-requests.edit', $productRequest)
                ->withSuccess(__('crud.common.saved'));
        }
        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized access.');
        // $this->authorize('update', $productRequest);

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductRequest $productRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductRequest $productRequest)
    {
        if (Auth::user()->hasRole(Constants::STORE_USER_ROLE)) {
            $storeUser = StoreUser::where('user_id', Auth::user()->id)->first();
            $store = Store::where('id', $storeUser->store_id)->first();


            $productRequest->delete();

            return redirect()
                ->route('product-requests.index')
                ->withSuccess(__('crud.common.removed'));
        }
        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized access.');
    }
}
