<?php

namespace App\Http\Livewire;

use App\Models\Clinic;
use App\Models\Campus;
use Livewire\Component;
use App\Models\Collage;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollageClinicsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Collage $collage;
    public Clinic $clinic;
    public $campusesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Clinic';

    protected $rules = [
        'clinic.name' => ['nullable', 'max:255', 'string'],
        'clinic.code_clinic' => ['nullable', 'max:255', 'string'],
        'clinic.description' => ['nullable', 'max:255', 'string'],
        'clinic.lat' => ['nullable', 'numeric'],
        'clinic.long' => ['nullable', 'numeric'],
        'clinic.campus_id' => ['nullable', 'exists:campus,id'],
        'clinic.status' => ['nullable', 'max:255'],
        'clinic.is_active' => ['nullable', 'max:255'],
    ];

    public function mount(Collage $collage): void
    {
        $this->collage = $collage;
        $this->campusesForSelect = Campus::pluck('name', 'id');
        $this->resetClinicData();
    }

    public function resetClinicData(): void
    {
        $this->clinic = new Clinic();

        $this->clinic->campus_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newClinic(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.collage_clinics.new_title');
        $this->resetClinicData();

        $this->showModal();
    }

    public function editClinic(Clinic $clinic): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.collage_clinics.edit_title');
        $this->clinic = $clinic;

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

        if (!$this->clinic->collage_id) {
            $this->authorize('create', Clinic::class);

            $this->clinic->collage_id = $this->collage->id;
        } else {
            $this->authorize('update', $this->clinic);
        }

        $this->clinic->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Clinic::class);

        Clinic::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetClinicData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->collage->clinics as $clinic) {
            array_push($this->selected, $clinic->id);
        }
    }

    public function render(): View
    {
        return view('livewire.collage-clinics-detail', [
            'clinics' => $this->collage->clinics()->paginate(20),
        ]);
    }
}
