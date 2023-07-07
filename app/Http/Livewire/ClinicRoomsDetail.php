<?php

namespace App\Http\Livewire;

use App\Models\Room;
use App\Models\Clinic;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Encounter;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicRoomsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Clinic $clinic;
    public Room $room;
    public $encountersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Room';

    protected $rules = [
        'room.name' => ['nullable', 'max:255', 'string'],
        'room.description' => ['nullable', 'max:255', 'string'],
        'room.status' => ['nullable', 'max:255'],
        'room.is_active' => ['nullable', 'max:255'],
        'room.encounter_id' => ['nullable', 'exists:encounters,id'],
    ];

    public function mount(Clinic $clinic): void
    {
        $this->clinic = $clinic;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->resetRoomData();
    }

    public function resetRoomData(): void
    {
        $this->room = new Room();

        $this->room->encounter_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newRoom(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.clinic_rooms.new_title');
        $this->resetRoomData();

        $this->showModal();
    }

    public function editRoom(Room $room): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.clinic_rooms.edit_title');
        $this->room = $room;

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

        if (!$this->room->clinic_id) {
            $this->authorize('create', Room::class);

            $this->room->clinic_id = $this->clinic->id;
        } else {
            $this->authorize('update', $this->room);
        }

        $this->room->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Room::class);

        Room::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetRoomData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->clinic->rooms as $room) {
            array_push($this->selected, $room->id);
        }
    }

    public function render(): View
    {
        return view('livewire.clinic-rooms-detail', [
            'rooms' => $this->clinic->rooms()->paginate(20),
        ]);
    }
}
