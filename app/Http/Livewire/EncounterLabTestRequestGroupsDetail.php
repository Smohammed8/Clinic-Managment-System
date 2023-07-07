<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use App\Models\LabTestRequestGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EncounterLabTestRequestGroupsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Encounter $encounter;
    public LabTestRequestGroup $labTestRequestGroup;
    public $clinicUsersForSelect = [];
    public $labTestRequestGroupRequestedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New LabTestRequestGroup';

    protected $rules = [
        'labTestRequestGroup.status' => ['nullable', 'max:255'],
        'labTestRequestGroup.priority' => ['nullable', 'max:255'],
        'labTestRequestGroup.notification' => ['nullable', 'max:255'],
        'labTestRequestGroup.call_status' => ['nullable', 'max:255'],
        'labTestRequestGroupRequestedAt' => ['nullable', 'date'],
        'labTestRequestGroup.clinic_user_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
    ];

    public function mount(Encounter $encounter): void
    {
        $this->encounter = $encounter;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetLabTestRequestGroupData();
    }

    public function resetLabTestRequestGroupData(): void
    {
        $this->labTestRequestGroup = new LabTestRequestGroup();

        $this->labTestRequestGroupRequestedAt = null;
        $this->labTestRequestGroup->clinic_user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newLabTestRequestGroup(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.encounter_lab_test_request_groups.new_title'
        );
        $this->resetLabTestRequestGroupData();

        $this->showModal();
    }

    public function editLabTestRequestGroup(
        LabTestRequestGroup $labTestRequestGroup
    ): void {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.encounter_lab_test_request_groups.edit_title'
        );
        $this->labTestRequestGroup = $labTestRequestGroup;

        $this->labTestRequestGroupRequestedAt = optional(
            $this->labTestRequestGroup->requested_at
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

        if (!$this->labTestRequestGroup->encounter_id) {
            $this->authorize('create', LabTestRequestGroup::class);

            $this->labTestRequestGroup->encounter_id = $this->encounter->id;
        } else {
            $this->authorize('update', $this->labTestRequestGroup);
        }

        $this->labTestRequestGroup->requested_at = \Carbon\Carbon::make(
            $this->labTestRequestGroupRequestedAt
        );

        $this->labTestRequestGroup->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', LabTestRequestGroup::class);

        LabTestRequestGroup::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetLabTestRequestGroupData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->encounter->labTestRequestGroups
            as $labTestRequestGroup
        ) {
            array_push($this->selected, $labTestRequestGroup->id);
        }
    }

    public function render(): View
    {
        return view('livewire.encounter-lab-test-request-groups-detail', [
            'labTestRequestGroups' => $this->encounter
                ->labTestRequestGroups()
                ->paginate(20),
        ]);
    }
}
