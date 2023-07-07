<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Supplier;
use Illuminate\View\View;
use App\Models\StockUnit;
use Livewire\WithPagination;
use App\Models\StockCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SupplierStocksDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Supplier $supplier;
    public Stock $stock;
    public $stockCategoriesForSelect = [];
    public $stockUnitsForSelect = [];
    public $stockExpireDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Stock';

    protected $rules = [
        'stock.name' => ['required', 'max:255', 'string'],
        'stock.quantitiy_recived' => ['nullable', 'max:255', 'string'],
        'stock.quantity_despensed' => ['nullable', 'max:255', 'string'],
        'stock.bach_no' => ['nullable', 'max:255', 'string'],
        'stockExpireDate' => ['nullable', 'date'],
        'stock.pack' => ['nullable', 'max:255', 'string'],
        'stock.quantity_per_pack' => ['nullable', 'max:255', 'string'],
        'stock.basic_unit_quantity' => ['nullable', 'max:255', 'string'],
        'stock.pack_price' => ['nullable', 'max:255', 'string'],
        'stock.stock_category_id' => ['nullable', 'exists:stock_categories,id'],
        'stock.stock_unit_id' => ['nullable', 'exists:stock_units,id'],
    ];

    public function mount(Supplier $supplier): void
    {
        $this->supplier = $supplier;
        $this->stockCategoriesForSelect = StockCategory::pluck('id', 'id');
        $this->stockUnitsForSelect = StockUnit::pluck('unit_name', 'id');
        $this->resetStockData();
    }

    public function resetStockData(): void
    {
        $this->stock = new Stock();

        $this->stockExpireDate = null;
        $this->stock->stock_category_id = null;
        $this->stock->stock_unit_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStock(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.supplier_stocks.new_title');
        $this->resetStockData();

        $this->showModal();
    }

    public function editStock(Stock $stock): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.supplier_stocks.edit_title');
        $this->stock = $stock;

        $this->stockExpireDate = optional($this->stock->expire_date)->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->stock->supplier_id) {
            $this->authorize('create', Stock::class);

            $this->stock->supplier_id = $this->supplier->id;
        } else {
            $this->authorize('update', $this->stock);
        }

        $this->stock->expire_date = \Carbon\Carbon::make(
            $this->stockExpireDate
        );

        $this->stock->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Stock::class);

        Stock::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetStockData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->supplier->stocks as $stock) {
            array_push($this->selected, $stock->id);
        }
    }

    public function render(): View
    {
        return view('livewire.supplier-stocks-detail', [
            'stocks' => $this->supplier->stocks()->paginate(20),
        ]);
    }
}
