<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserClinicUsersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public ClinicUser $clinicUser;
    public $encountersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ClinicUser';

    protected $rules = [
        'clinicUser.encounter_id' => ['required', 'exists:encounters,id'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->resetClinicUserData();
    }

    public function resetClinicUserData(): void
    {
        $this->clinicUser = new ClinicUser();

        $this->clinicUser->encounter_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newClinicUser(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_clinic_users.new_title');
        $this->resetClinicUserData();

        $this->showModal();
    }

    public function editClinicUser(ClinicUser $clinicUser): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_clinic_users.edit_title');
        $this->clinicUser = $clinicUser;

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

        if (!$this->clinicUser->user_id) {
            $this->authorize('create', ClinicUser::class);

            $this->clinicUser->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->clinicUser);
        }

        $this->clinicUser->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', ClinicUser::class);

        ClinicUser::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetClinicUserData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->clinicUsers as $clinicUser) {
            array_push($this->selected, $clinicUser->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-clinic-users-detail', [
            'clinicUsers' => $this->user->clinicUsers()->paginate(20),
        ]);
    }
}
