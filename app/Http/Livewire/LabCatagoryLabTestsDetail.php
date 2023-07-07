<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LabTest;
use Illuminate\View\View;
use App\Models\LabCatagory;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LabCatagoryLabTestsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public LabCatagory $labCatagory;
    public LabTest $labTest;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New LabTest';

    protected $rules = [
        'labTest.test_name' => ['nullable', 'max:255', 'string'],
        'labTest.test_desc' => ['nullable', 'max:255', 'string'],
        'labTest.status' => ['nullable', 'max:255'],
        'labTest.is_available ' => ['nullable', 'boolean'],
        'labTest.price' => ['nullable', 'numeric'],
    ];

    public function mount(LabCatagory $labCatagory): void
    {
        $this->labCatagory = $labCatagory;
        $this->resetLabTestData();
    }

    public function resetLabTestData(): void
    {
        $this->labTest = new LabTest();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newLabTest(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.lab_catagory_lab_tests.new_title');
        $this->resetLabTestData();

        $this->showModal();
    }

    public function editLabTest(LabTest $labTest): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.lab_catagory_lab_tests.edit_title');
        $this->labTest = $labTest;

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

        if (!$this->labTest->lab_catagory_id) {
            $this->authorize('create', LabTest::class);

            $this->labTest->lab_catagory_id = $this->labCatagory->id;
        } else {
            $this->authorize('update', $this->labTest);
        }

        $this->labTest->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', LabTest::class);

        LabTest::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetLabTestData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->labCatagory->labTests as $labTest) {
            array_push($this->selected, $labTest->id);
        }
    }

    public function render(): View
    {
        return view('livewire.lab-catagory-lab-tests-detail', [
            'labTests' => $this->labCatagory->labTests()->paginate(20),
        ]);
    }
}
