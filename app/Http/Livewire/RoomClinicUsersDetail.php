<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\ClinicUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoomClinicUsersDetail extends Component
{
    use AuthorizesRequests;

    public Room $room;
    public ClinicUser $clinicUser;
    public $clinicUsersForSelect = [];
    public $clinic_user_id = null;

    public $showingModal = false;
    public $modalTitle = 'New ClinicUser';

    protected $rules = [
        'clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
    ];

    public function mount(Room $room): void
    {
        $this->room = $room;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetClinicUserData();
    }

    public function resetClinicUserData(): void
    {
        $this->clinicUser = new ClinicUser();

        $this->clinic_user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newClinicUser(): void
    {
        $this->modalTitle = trans('crud.room_clinic_users.new_title');
        $this->resetClinicUserData();

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

        $this->authorize('create', ClinicUser::class);

        $this->room->clinicUsers()->attach($this->clinic_user_id, []);

        // clinic_user_id
        $this->hideModal();
    }

    public function detach($clinicUser): void
    {
        $this->authorize('delete-any', ClinicUser::class);

        $this->room->clinicUsers()->detach($clinicUser);

        $this->resetClinicUserData();
    }

    public function render(): View
    {
        return view('livewire.room-clinic-users-detail', [
            'roomClinicUsers' => $this->room
                ->clinicUsers()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
