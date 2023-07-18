<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Pharmacy;
use App\Models\ItemRequest;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PharmacyItemRequestsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Pharmacy $pharmacy;
    public ItemRequest $itemRequest;
    public $productsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ItemRequest';

    protected $rules = [
        'itemRequest.product_id' => ['required', 'exists:products,id'],
        'itemRequest.amount' => ['required', 'numeric'],
    ];

    public function mount(Pharmacy $pharmacy)
    {
        $this->pharmacy = $pharmacy;
        $this->productsForSelect = Product::pluck('name', 'id');
        $this->resetItemRequestData();
    }

    public function resetItemRequestData()
    {
        $this->itemRequest = new ItemRequest();

        $this->itemRequest->product_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newItemRequest()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.pharmacy_item_requests.new_title');
        $this->resetItemRequestData();

        $this->showModal();
    }

    public function editItemRequest(ItemRequest $itemRequest)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.pharmacy_item_requests.edit_title');
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

        if (!$this->itemRequest->pharmacy_id) {
            $this->authorize('create', ItemRequest::class);

            $this->itemRequest->pharmacy_id = $this->pharmacy->id;
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

        foreach ($this->pharmacy->itemRequests as $itemRequest) {
            array_push($this->selected, $itemRequest->id);
        }
    }

    public function render()
    {
        return view('livewire.pharmacy-item-requests-detail', [
            'itemRequests' => $this->pharmacy->itemRequests()->paginate(20),
        ]);
    }
}
