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

class StudentMedicalRecordsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Student $student;
    public MedicalRecord $medicalRecord;
    public $encountersForSelect = [];
    public $clinicUsersForSelect = [];

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
        'medicalRecord.clinic_user_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
    ];

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetMedicalRecordData();
    }

    public function resetMedicalRecordData(): void
    {
        $this->medicalRecord = new MedicalRecord();

        $this->medicalRecord->encounter_id = null;
        $this->medicalRecord->clinic_user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMedicalRecord(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.student_medical_records.new_title');
        $this->resetMedicalRecordData();

        $this->showModal();
    }

    public function editMedicalRecord(MedicalRecord $medicalRecord): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.student_medical_records.edit_title');
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

        if (!$this->medicalRecord->student_id) {
            $this->authorize('create', MedicalRecord::class);

            $this->medicalRecord->student_id = $this->student->id;
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

        foreach ($this->student->medicalRecords as $medicalRecord) {
            array_push($this->selected, $medicalRecord->id);
        }
    }

    public function render(): View
    {
        return view('livewire.student-medical-records-detail', [
            'medicalRecords' => $this->student->medicalRecords()->paginate(20),
        ]);
    }
}
