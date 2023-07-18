<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Pharmacy;
use Livewire\WithPagination;
use App\Models\PharmacyUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PharmacyPharmacyUsersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Pharmacy $pharmacy;
    public PharmacyUser $pharmacyUser;
    public $usersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New PharmacyUser';

    protected $rules = [
        'pharmacyUser.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Pharmacy $pharmacy)
    {
        $this->pharmacy = $pharmacy;
        $this->usersForSelect = User::pluck('name', 'id');
        $this->resetPharmacyUserData();
    }

    public function resetPharmacyUserData()
    {
        $this->pharmacyUser = new PharmacyUser();

        $this->pharmacyUser->user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPharmacyUser()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.pharmacy_pharmacy_users.new_title');
        $this->resetPharmacyUserData();

        $this->showModal();
    }

    public function editPharmacyUser(PharmacyUser $pharmacyUser)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.pharmacy_pharmacy_users.edit_title');
        $this->pharmacyUser = $pharmacyUser;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->pharmacyUser->pharmacy_id) {
            $this->authorize('create', PharmacyUser::class);

            $this->pharmacyUser->pharmacy_id = $this->pharmacy->id;
        } else {
            $this->authorize('update', $this->pharmacyUser);
        }

        $this->pharmacyUser->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', PharmacyUser::class);

        PharmacyUser::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPharmacyUserData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->pharmacy->pharmacyUsers as $pharmacyUser) {
            array_push($this->selected, $pharmacyUser->id);
        }
    }

    public function render()
    {
        return view('livewire.pharmacy-pharmacy-users-detail', [
            'pharmacyUsers' => $this->pharmacy->pharmacyUsers()->paginate(20),
        ]);
    }
}
