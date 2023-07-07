<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\Prescription;
use App\Models\MainDiagnosis;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainDiagnosisPrescriptionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public MainDiagnosis $mainDiagnosis;
    public Prescription $prescription;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Prescription';

    protected $rules = [
        'prescription.drug_name' => ['nullable', 'max:255', 'string'],
        'prescription.dose' => ['nullable', 'max:255', 'string'],
        'prescription.frequency' => ['nullable', 'max:255', 'string'],
        'prescription.duration' => ['nullable', 'max:255', 'string'],
        'prescription.other_info' => ['nullable', 'max:255', 'string'],
    ];

    public function mount(MainDiagnosis $mainDiagnosis): void
    {
        $this->mainDiagnosis = $mainDiagnosis;
        $this->resetPrescriptionData();
    }

    public function resetPrescriptionData(): void
    {
        $this->prescription = new Prescription();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPrescription(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.main_diagnosis_prescriptions.new_title'
        );
        $this->resetPrescriptionData();

        $this->showModal();
    }

    public function editPrescription(Prescription $prescription): void
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.main_diagnosis_prescriptions.edit_title'
        );
        $this->prescription = $prescription;

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

        if (!$this->prescription->main_diagnosis_id) {
            $this->authorize('create', Prescription::class);

            $this->prescription->main_diagnosis_id = $this->mainDiagnosis->id;
        } else {
            $this->authorize('update', $this->prescription);
        }

        $this->prescription->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Prescription::class);

        Prescription::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPrescriptionData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mainDiagnosis->prescriptions as $prescription) {
            array_push($this->selected, $prescription->id);
        }
    }

    public function render(): View
    {
        return view('livewire.main-diagnosis-prescriptions-detail', [
            'prescriptions' => $this->mainDiagnosis
                ->prescriptions()
                ->paginate(20),
        ]);
    }
}
