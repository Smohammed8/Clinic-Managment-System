<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use App\Models\Pharmacy;
use Livewire\WithPagination;
use App\Models\ItemsInPharmacy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PharmacyItemsInPharmaciesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Pharmacy $pharmacy;
    public ItemsInPharmacy $itemsInPharmacy;
    public $itemsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ItemsInPharmacy';

    protected $rules = [
        'itemsInPharmacy.item_id' => ['nullable', 'exists:items,id'],
        'itemsInPharmacy.count' => ['nullable', 'numeric'],
    ];

    public function mount(Pharmacy $pharmacy)
    {
        $this->pharmacy = $pharmacy;
        $this->itemsForSelect = Item::pluck('batch_number', 'id');
        $this->resetItemsInPharmacyData();
    }

    public function resetItemsInPharmacyData()
    {
        $this->itemsInPharmacy = new ItemsInPharmacy();

        $this->itemsInPharmacy->item_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newItemsInPharmacy()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.pharmacy_items_in_pharmacies.new_title'
        );
        $this->resetItemsInPharmacyData();

        $this->showModal();
    }

    public function editItemsInPharmacy(ItemsInPharmacy $itemsInPharmacy)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.pharmacy_items_in_pharmacies.edit_title'
        );
        $this->itemsInPharmacy = $itemsInPharmacy;

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

        if (!$this->itemsInPharmacy->pharmacy_id) {
            $this->authorize('create', ItemsInPharmacy::class);

            $this->itemsInPharmacy->pharmacy_id = $this->pharmacy->id;
        } else {
            $this->authorize('update', $this->itemsInPharmacy);
        }

        $this->itemsInPharmacy->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ItemsInPharmacy::class);

        ItemsInPharmacy::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetItemsInPharmacyData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->pharmacy->itemsInPharmacies as $itemsInPharmacy) {
            array_push($this->selected, $itemsInPharmacy->id);
        }
    }

    public function render()
    {
        return view('livewire.pharmacy-items-in-pharmacies-detail', [
            'itemsInPharmacies' => $this->pharmacy
                ->itemsInPharmacies()
                ->paginate(20),
        ]);
    }
}
