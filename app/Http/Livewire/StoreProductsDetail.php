<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StoreProductsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Store $store;
    public Product $product;
    public $categoriesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Product';

    protected $rules = [
        'product.name' => ['nullable', 'max:255', 'string'],
        'product.category_id' => ['nullable', 'exists:categories,id'],
    ];

    public function mount(Store $store)
    {
        $this->store = $store;
        $this->categoriesForSelect = Category::pluck('name', 'id');
        $this->resetProductData();
    }

    public function resetProductData()
    {
        $this->product = new Product();

        $this->product->category_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newProduct()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.store_products.new_title');
        $this->resetProductData();

        $this->showModal();
    }

    public function editProduct(Product $product)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.store_products.edit_title');
        $this->product = $product;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->product->store_id) {
            $this->authorize('create', Product::class);

            $this->product->store_id = $this->store->id;
        } else {
            $this->authorize('update', $this->product);
        }

        $this->product->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Product::class);

        Product::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetProductData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->store->products as $product) {
            array_push($this->selected, $product->id);
        }
    }

    public function render()
    {
        return view('livewire.store-products-detail', [
            'products' => $this->store->products()->paginate(20),
        ]);
    }
}
