<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\Encounter;
use Illuminate\View\View;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EncounterMedicalRecordsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Encounter $encounter;
    public MedicalRecord $medicalRecord;
    public $clinicUsersForSelect = [];
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
        // 'medicalRecord.clinic_user_id' => [
        //     'nullable',
        //     'exists:clinic_users,id',
        // ],
        // 'medicalRecord.student_id' => ['nullable', 'exists:students,id'],
    ];

    public function mount(Encounter $encounter): void
    {
        $this->encounter = $encounter;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->resetMedicalRecordData();
    }

    public function resetMedicalRecordData(): void
    {
        $this->medicalRecord = new MedicalRecord();

        $this->medicalRecord->clinic_user_id = null;
        $this->medicalRecord->student_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMedicalRecord(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.encounter_medical_records.new_title');
        $this->resetMedicalRecordData();

        $this->showModal();
    }

    public function editMedicalRecord(MedicalRecord $medicalRecord): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.encounter_medical_records.edit_title');
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

        if (!$this->medicalRecord->encounter_id) {
            $this->authorize('create', MedicalRecord::class);

            $this->medicalRecord->encounter_id = $this->encounter->id;
        } else {
            $this->authorize('update', $this->medicalRecord);
        }


        $this->medicalRecord->clinic_user_id = Auth::user()->id;
        $this->medicalRecord->student_id = $this->encounter->student->id;

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

        foreach ($this->encounter->medicalRecords as $medicalRecord) {
            array_push($this->selected, $medicalRecord->id);
        }
    }

    public function render(): View
    {
        return view('livewire.encounter-medical-records-detail', [
            'medicalRecords' => $this->encounter
                ->medicalRecords()
                ->paginate(20),
        ]);
    }
}
