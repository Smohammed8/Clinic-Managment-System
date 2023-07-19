<?php

namespace App\Http\Livewire;

use App\Models\Clinic;
use Livewire\Component;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicUserDoctorDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public ClinicUser $clinicUser;
    public Encounter $encounter;
    public $clinicsForSelect = [];
    public $clinicUsersForSelect = [];
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
        'encounter.clinic_id' => ['nullable', 'exists:clinic,id'],
        'encounter.registered_by' => ['required', 'exists:clinic_users,id'],
    ];

    public function mount(ClinicUser $clinicUser)
    {
        $this->clinicUser = $clinicUser;
        $this->clinicsForSelect = Clinic::pluck('name', 'id');
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetEncounterData();
    }

    public function resetEncounterData()
    {
        $this->encounter = new Encounter();

        $this->encounterCheckInTime = null;
        $this->encounterClosedAt = null;
        $this->encounter->clinic_id = null;
        $this->encounter->registered_by = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEncounter()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.clinic_user_doctor.new_title');
        $this->resetEncounterData();

        $this->showModal();
    }

    public function editEncounter(Encounter $encounter)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.clinic_user_doctor.edit_title');
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

        if (!$this->encounter->doctor_id) {
            $this->authorize('create', Encounter::class);

            $this->encounter->doctor_id = $this->clinicUser->id;
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

    public function destroySelected()
    {
        $this->authorize('delete-any', Encounter::class);

        Encounter::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEncounterData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->clinicUser->encounters as $encounter) {
            array_push($this->selected, $encounter->id);
        }
    }

    public function render()
    {
        return view('livewire.clinic-user-doctor-detail', [
            'encounters' => $this->clinicUser->encounters()->paginate(20),
        ]);
    }
}
