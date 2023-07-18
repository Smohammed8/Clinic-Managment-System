<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Store;
use Livewire\Component;
use App\Models\StoreUser;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StoreStoreUsersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Store $store;
    public StoreUser $storeUser;
    public $usersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New StoreUser';

    protected $rules = [
        'storeUser.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Store $store)
    {
        $this->store = $store;
        $this->usersForSelect = User::pluck('name', 'id');
        $this->resetStoreUserData();
    }

    public function resetStoreUserData()
    {
        $this->storeUser = new StoreUser();

        $this->storeUser->user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStoreUser()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.store_store_users.new_title');
        $this->resetStoreUserData();

        $this->showModal();
    }

    public function editStoreUser(StoreUser $storeUser)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.store_store_users.edit_title');
        $this->storeUser = $storeUser;

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

        if (!$this->storeUser->store_id) {
            $this->authorize('create', StoreUser::class);

            $this->storeUser->store_id = $this->store->id;
        } else {
            $this->authorize('update', $this->storeUser);
        }

        $this->storeUser->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', StoreUser::class);

        StoreUser::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetStoreUserData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->store->storeUsers as $storeUser) {
            array_push($this->selected, $storeUser->id);
        }
    }

    public function render()
    {
        return view('livewire.store-store-users-detail', [
            'storeUsers' => $this->store->storeUsers()->paginate(20),
        ]);
    }
}
