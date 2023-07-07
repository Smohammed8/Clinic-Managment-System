<?php

namespace App\Http\Livewire;

use App\Models\Campus;
use Livewire\Component;
use App\Models\Collage;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampusCollagesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Campus $campus;
    public Collage $collage;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Collage';

    protected $rules = [
        'collage.name' => ['nullable', 'max:255', 'string'],
        'collage.description' => ['nullable', 'max:255', 'string'],
    ];

    public function mount(Campus $campus): void
    {
        $this->campus = $campus;
        $this->resetCollageData();
    }

    public function resetCollageData(): void
    {
        $this->collage = new Collage();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCollage(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.campus_collages.new_title');
        $this->resetCollageData();

        $this->showModal();
    }

    public function editCollage(Collage $collage): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.campus_collages.edit_title');
        $this->collage = $collage;

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

        if (!$this->collage->campus_id) {
            $this->authorize('create', Collage::class);

            $this->collage->campus_id = $this->campus->id;
        } else {
            $this->authorize('update', $this->collage);
        }

        $this->collage->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Collage::class);

        Collage::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCollageData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->campus->collages as $collage) {
            array_push($this->selected, $collage->id);
        }
    }

    public function render(): View
    {
        return view('livewire.campus-collages-detail', [
            'collages' => $this->campus->collages()->paginate(20),
        ]);
    }
}
