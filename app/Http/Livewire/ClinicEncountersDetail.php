<?php

namespace App\Http\Livewire;

use App\Models\Clinic;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Encounter;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicEncountersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Clinic $clinic;
    public Encounter $encounter;
    public $encounterCheckInTime;
    public $encounterClosedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Encounter';

    protected $rules = [
        'encounterCheckInTime' => ['nullable', 'date'],
        'encounter.status' => ['nullable', 'max:255'],
        'encounterClosedAt' => ['nullable', 'date'],
        'encounter.priority' => ['nullable', 'max:255'],
    ];

    public function mount(Clinic $clinic): void
    {
        $this->clinic = $clinic;
        $this->resetEncounterData();
    }

    public function resetEncounterData(): void
    {
        $this->encounter = new Encounter();

        $this->encounterCheckInTime = null;
        $this->encounterClosedAt = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEncounter(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.clinic_encounters.new_title');
        $this->resetEncounterData();

        $this->showModal();
    }

    public function editEncounter(Encounter $encounter): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.clinic_encounters.edit_title');
        $this->encounter = $encounter;

        $this->encounterCheckInTime = optional(
            $this->encounter->check_in_time
        )->format('Y-m-d');
        $this->encounterClosedAt = optional(
            $this->encounter->closed_at
        )->format('Y-m-d');

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

        if (!$this->encounter->clinic_id) {
            $this->authorize('create', Encounter::class);

            $this->encounter->clinic_id = $this->clinic->id;
        } else {
            $this->authorize('update', $this->encounter);
        }

        $this->encounter->check_in_time = \Carbon\Carbon::make(
            $this->encounterCheckInTime
        );
        $this->encounter->closed_at = \Carbon\Carbon::make(
            $this->encounterClosedAt
        );

        $this->encounter->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Encounter::class);

        Encounter::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEncounterData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->clinic->encounters as $encounter) {
            array_push($this->selected, $encounter->id);
        }
    }

    public function render(): View
    {
        return view('livewire.clinic-encounters-detail', [
            'encounters' => $this->clinic->encounters()->paginate(20),
        ]);
    }
}
