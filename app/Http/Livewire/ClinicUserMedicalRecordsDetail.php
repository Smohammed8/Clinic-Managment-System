<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use App\Models\MedicalRecord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicUserMedicalRecordsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public ClinicUser $clinicUser;
    public MedicalRecord $medicalRecord;
    public $encountersForSelect = [];
    public $studentsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New MedicalRecord';

    protected $rules = [
        'medicalRecord.subjective' => ['nullable', 'max:255', 'string'],
        'medicalRecord.objective' => ['nullable', 'max:255', 'string'],
        'medicalRecord.assessment' => ['nullable', 'max:255', 'string'],
        'medicalRecord.plan' => ['nullable', 'max:255', 'string'],
        'medicalRecord.encounter_id' => ['nullable', 'exists:encounters,id'],
        'medicalRecord.student_id' => ['nullable', 'exists:student,id'],
    ];

    public function mount(ClinicUser $clinicUser): void
    {
        $this->clinicUser = $clinicUser;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->resetMedicalRecordData();
    }

    public function resetMedicalRecordData(): void
    {
        $this->medicalRecord = new MedicalRecord();

        $this->medicalRecord->encounter_id = null;
        $this->medicalRecord->student_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMedicalRecord(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.clinic_user_medical_records.new_title');
        $this->resetMedicalRecordData();

        $this->showModal();
    }

    public function editMedicalRecord(MedicalRecord $medicalRecord): void
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.clinic_user_medical_records.edit_title'
        );
        $this->medicalRecord = $medicalRecord;

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

        if (!$this->medicalRecord->clinic_user_id) {
            $this->authorize('create', MedicalRecord::class);

            $this->medicalRecord->clinic_user_id = $this->clinicUser->id;
        } else {
            $this->authorize('update', $this->medicalRecord);
        }

        $this->medicalRecord->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', MedicalRecord::class);

        MedicalRecord::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetMedicalRecordData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->clinicUser->medicalRecords as $medicalRecord) {
            array_push($this->selected, $medicalRecord->id);
        }
    }

    public function render(): View
    {
        return view('livewire.clinic-user-medical-records-detail', [
            'medicalRecords' => $this->clinicUser
                ->medicalRecords()
                ->paginate(20),
        ]);
    }
}
