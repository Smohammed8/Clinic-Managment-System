<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\Diagnosis;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use App\Models\MainDiagnosis;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DiagnosisMainDiagnosesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Diagnosis $diagnosis;
    public MainDiagnosis $mainDiagnosis;
    public $clinicUsersForSelect = [];
    public $studentsForSelect = [];
    public $encountersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New MainDiagnosis';

    protected $rules = [
        'mainDiagnosis.clinic_user_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
        'mainDiagnosis.student_id' => ['nullable', 'exists:students,id'],
        'mainDiagnosis.encounter_id' => ['nullable', 'exists:encounters,id'],
    ];

    public function mount(Diagnosis $diagnosis): void
    {
        $this->diagnosis = $diagnosis;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->resetMainDiagnosisData();
    }

    public function resetMainDiagnosisData(): void
    {
        $this->mainDiagnosis = new MainDiagnosis();

        $this->mainDiagnosis->clinic_user_id = null;
        $this->mainDiagnosis->student_id = null;
        $this->mainDiagnosis->encounter_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMainDiagnosis(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.diagnosis_main_diagnoses.new_title');
        $this->resetMainDiagnosisData();

        $this->showModal();
    }

    public function editMainDiagnosis(MainDiagnosis $mainDiagnosis): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.diagnosis_main_diagnoses.edit_title');
        $this->mainDiagnosis = $mainDiagnosis;

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

        if (!$this->mainDiagnosis->diagnosis_id) {
            $this->authorize('create', MainDiagnosis::class);

            $this->mainDiagnosis->diagnosis_id = $this->diagnosis->id;
        } else {
            $this->authorize('update', $this->mainDiagnosis);
        }

        $this->mainDiagnosis->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', MainDiagnosis::class);

        MainDiagnosis::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetMainDiagnosisData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->diagnosis->mainDiagnoses as $mainDiagnosis) {
            array_push($this->selected, $mainDiagnosis->id);
        }
    }

    public function render(): View
    {
        return view('livewire.diagnosis-main-diagnoses-detail', [
            'mainDiagnoses' => $this->diagnosis->mainDiagnoses()->paginate(20),
        ]);
    }
}
