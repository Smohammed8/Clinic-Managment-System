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

class StudentVitalSignsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Student $student;
    public VitalSign $vitalSign;
    public $encountersForSelect = [];
    public $clinicUsersForSelect = [];

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
        'vitalSign.clinic_user_id' => ['required', 'exists:clinic_users,id'],
    ];

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetVitalSignData();
    }

    public function resetVitalSignData(): void
    {
        $this->vitalSign = new VitalSign();

        $this->vitalSign->encounter_id = null;
        $this->vitalSign->clinic_user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newVitalSign(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.student_vital_signs.new_title');
        $this->resetVitalSignData();

        $this->showModal();
    }

    public function editVitalSign(VitalSign $vitalSign): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.student_vital_signs.edit_title');
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

        if (!$this->vitalSign->student_id) {
            $this->authorize('create', VitalSign::class);

            $this->vitalSign->student_id = $this->student->id;
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

        foreach ($this->student->vitalSigns as $vitalSign) {
            array_push($this->selected, $vitalSign->id);
        }
    }

    public function render(): View
    {
        return view('livewire.student-vital-signs-detail', [
            'vitalSigns' => $this->student->vitalSigns()->paginate(20),
        ]);
    }
}
