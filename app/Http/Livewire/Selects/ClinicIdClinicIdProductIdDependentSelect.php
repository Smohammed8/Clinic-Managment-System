<?php

namespace App\Http\Livewire\Selects;

use App\Models\Clinic;
use Livewire\Component;
use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicIdClinicIdProductIdDependentSelect extends Component
{
    use AuthorizesRequests;

    public $allClinics;

    public $allProducts;

    public $selectedClinicId;
    public $selectedProductId;

    protected $rules = [
        'selectedClinicId' => ['required', 'exists:clinic,id'],
        'selectedClinicId' => ['required', 'exists:clinic,id'],
        'selectedProductId' => ['required', 'exists:products,id'],
    ];

    public function mount($productRequest)
    {
        $this->clearData();
        $this->fillAllClinics();

        if (is_null($productRequest)) {
            return;
        }

        $productRequest = ProductRequest::findOrFail($productRequest);

        $this->selectedClinicId = $productRequest->clinic_id;

        $this->fillAllClinics();
        $this->selectedClinicId = $productRequest->clinic_id;

        $this->fillAllProducts();
        $this->selectedProductId = $productRequest->product_id;
    }

    public function updatedSelectedClinicId()
    {
        $this->selectedProductId = null;
        $this->fillAllProducts();
    }

    // public function fillAllClinics()
    // {
    //     $this->allClinics = Clinic::all()->pluck('name', 'id');
    // }

    public function fillAllClinics()
    {
        if (!$this->selectedClinicId) {
            return;
        }

        $this->allClinics = Clinic::where('clinic_id', $this->selectedClinicId)
            ->get()
            ->pluck('name', 'id');
    }

    public function fillAllProducts()
    {
        if (!$this->selectedClinicId) {
            return;
        }

        $this->allProducts = Product::where(
            'clinic_id',
            $this->selectedClinicId
        )
            ->get()
            ->pluck('name', 'id');
    }

    public function clearData()
    {
        $this->allClinics = null;
        $this->allClinics = null;
        $this->allProducts = null;

        $this->selectedClinicId = null;
        $this->selectedClinicId = null;
        $this->selectedProductId = null;
    }

    public function render()
    {
        return view(
            'livewire.selects.clinic-id-clinic-id-product-id-dependent-select'
        );
    }
}
