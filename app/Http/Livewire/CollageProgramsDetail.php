<?php

namespace App\Http\Livewire;

use App\Models\Campus;
use Livewire\Component;
use App\Models\Collage;
use App\Models\Program;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollageProgramsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Collage $collage;
    public Program $program;
    public $campusesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Program';

    protected $rules = [
        'program.name' => ['nullable', 'max:255', 'string'],
        'program.campus_id' => ['nullable', 'exists:campus,id'],
    ];

    public function mount(Collage $collage): void
    {
        $this->collage = $collage;
        $this->campusesForSelect = Campus::pluck('name', 'id');
        $this->resetProgramData();
    }

    public function resetProgramData(): void
    {
        $this->program = new Program();

        $this->program->campus_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newProgram(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.collage_programs.new_title');
        $this->resetProgramData();

        $this->showModal();
    }

    public function editProgram(Program $program): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.collage_programs.edit_title');
        $this->program = $program;

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

        if (!$this->program->collage_id) {
            $this->authorize('create', Program::class);

            $this->program->collage_id = $this->collage->id;
        } else {
            $this->authorize('update', $this->program);
        }

        $this->program->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Program::class);

        Program::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetProgramData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->collage->programs as $program) {
            array_push($this->selected, $program->id);
        }
    }

    public function render(): View
    {
        return view('livewire.collage-programs-detail', [
            'programs' => $this->collage->programs()->paginate(20),
        ]);
    }
}
