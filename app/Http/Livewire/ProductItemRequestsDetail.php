<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Pharmacy;
use App\Models\ItemRequest;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductItemRequestsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Product $product;
    public ItemRequest $itemRequest;
    public $pharmaciesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ItemRequest';

    protected $rules = [
        'itemRequest.pharmacy_id' => ['required', 'exists:pharmacies,id'],
        'itemRequest.amount' => ['required', 'numeric'],
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->pharmaciesForSelect = Pharmacy::pluck('name', 'id');
        $this->resetItemRequestData();
    }

    public function resetItemRequestData()
    {
        $this->itemRequest = new ItemRequest();

        $this->itemRequest->pharmacy_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newItemRequest()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.product_item_requests.new_title');
        $this->resetItemRequestData();

        $this->showModal();
    }

    public function editItemRequest(ItemRequest $itemRequest)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.product_item_requests.edit_title');
        $this->itemRequest = $itemRequest;

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

        if (!$this->itemRequest->product_id) {
            $this->authorize('create', ItemRequest::class);

            $this->itemRequest->product_id = $this->product->id;
        } else {
            $this->authorize('update', $this->itemRequest);
        }

        $this->itemRequest->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ItemRequest::class);

        ItemRequest::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetItemRequestData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->product->itemRequests as $itemRequest) {
            array_push($this->selected, $itemRequest->id);
        }
    }

    public function render()
    {
        return view('livewire.product-item-requests-detail', [
            'itemRequests' => $this->product->itemRequests()->paginate(20),
        ]);
    }
}
