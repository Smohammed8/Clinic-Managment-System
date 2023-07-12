<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\VitalSign;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicUserVitalSignsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public ClinicUser $clinicUser;
    public VitalSign $vitalSign;
    public $encountersForSelect = [];
    public $studentsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New VitalSign';

    protected $rules = [
        'vitalSign.temp' => ['nullable', 'numeric'],
        'vitalSign.blood_pressure' => ['nullable', 'numeric'],
        'vitalSign.pulse_rate' => ['nullable', 'numeric'],
        'vitalSign.rr' => ['nullable', 'numeric'],
        'vitalSign.weight' => ['nullable', 'numeric'],
        'vitalSign.height' => ['nullable', 'numeric'],
        'vitalSign.muac' => ['nullable', 'numeric'],
        'vitalSign.encounter_id' => ['required', 'exists:encounters,id'],
        'vitalSign.student_id' => ['required', 'exists:students,id'],
    ];

    public function mount(ClinicUser $clinicUser): void
    {
        $this->clinicUser = $clinicUser;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->resetVitalSignData();
    }

    public function resetVitalSignData(): void
    {
        $this->vitalSign = new VitalSign();

        $this->vitalSign->encounter_id = null;
        $this->vitalSign->student_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newVitalSign(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.clinic_user_vital_signs.new_title');
        $this->resetVitalSignData();

        $this->showModal();
    }

    public function editVitalSign(VitalSign $vitalSign): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.clinic_user_vital_signs.edit_title');
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

        if (!$this->vitalSign->clinic_user_id) {
            $this->authorize('create', VitalSign::class);

            $this->vitalSign->clinic_user_id = $this->clinicUser->id;
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

        foreach ($this->clinicUser->vitalSigns as $vitalSign) {
            array_push($this->selected, $vitalSign->id);
        }
    }

    public function render(): View
    {
        return view('livewire.clinic-user-vital-signs-detail', [
            'vitalSigns' => $this->clinicUser->vitalSigns()->paginate(20),
        ]);
    }
}
