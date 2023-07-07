<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\VitalSign;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EncounterVitalSignsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Encounter $encounter;
    public VitalSign $vitalSign;
    public $clinicUsersForSelect = [];
    public $studentsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New VitalSign';

    protected $rules = [
        'vitalSign.temp' => ['nullable', 'numeric'],
        'vitalSign.blood_pressure ' => ['nullable', 'numeric'],
        'vitalSign.pulse_rate' => ['nullable', 'numeric'],
        'vitalSign.rr' => ['nullable', 'numeric'],
        'vitalSign.weight' => ['nullable', 'numeric'],
        'vitalSign.height' => ['nullable', 'numeric'],
        'vitalSign.muac' => ['nullable', 'numeric'],
        'vitalSign.clinic_user_id' => ['required', 'exists:clinic_users,id'],
        'vitalSign.student_id' => ['required', 'exists:student,id'],
    ];

    public function mount(Encounter $encounter): void
    {
        $this->encounter = $encounter;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->resetVitalSignData();
    }

    public function resetVitalSignData(): void
    {
        $this->vitalSign = new VitalSign();

        $this->vitalSign->clinic_user_id = null;
        $this->vitalSign->student_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newVitalSign(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.encounter_vital_signs.new_title');
        $this->resetVitalSignData();

        $this->showModal();
    }

    public function editVitalSign(VitalSign $vitalSign): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.encounter_vital_signs.edit_title');
        $this->vitalSign = $vitalSign;

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

        if (!$this->vitalSign->encounter_id) {
            $this->authorize('create', VitalSign::class);

            $this->vitalSign->encounter_id = $this->encounter->id;
        } else {
            $this->authorize('update', $this->vitalSign);
        }

        $this->vitalSign->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', VitalSign::class);

        VitalSign::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetVitalSignData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->encounter->vitalSigns as $vitalSign) {
            array_push($this->selected, $vitalSign->id);
        }
    }

    public function render(): View
    {
        return view('livewire.encounter-vital-signs-detail', [
            'vitalSigns' => $this->encounter->vitalSigns()->paginate(20),
        ]);
    }
}
