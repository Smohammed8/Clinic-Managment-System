<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\ClinicUser;
use App\Models\LabCatagory;
use Livewire\WithPagination;
use App\Models\LabTestRequest;
use App\Models\LabTestRequestGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LabCatagoryLabTestRequestsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public LabCatagory $labCatagory;
    public LabTestRequest $labTestRequest;
    public $labTestRequestGroupsForSelect = [];
    public $clinicUsersForSelect = [];
    public $labTestRequestSampleCollectedAt;
    public $labTestRequestSampleAnalyzedAt;
    public $labTestRequestApprovedAt;
    public $labTestRequestOrderedOn;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New LabTestRequest';

    protected $rules = [
        'labTestRequestSampleCollectedAt' => ['nullable', 'date'],
        'labTestRequestSampleAnalyzedAt' => ['nullable', 'date'],
        'labTestRequest.status' => ['nullable', 'max:255'],
        'labTestRequest.notification' => ['nullable', 'max:255'],
        'labTestRequest.note' => ['nullable', 'max:255', 'string'],
        'labTestRequest.result' => ['nullable', 'max:255', 'string'],
        'labTestRequest.comment' => ['nullable', 'max:255', 'string'],
        'labTestRequest.analyser_result' => ['nullable', 'max:255', 'string'],
        'labTestRequestApprovedAt' => ['nullable', 'date'],
        'labTestRequest.price' => ['nullable', 'numeric'],
        'labTestRequest.sample_id' => ['nullable', 'max:255', 'string'],
        'labTestRequestOrderedOn' => ['nullable', 'date'],
        'labTestRequest.lab_test_request_group_id' => [
            'nullable',
            'exists:lab_test_request_groups,id',
        ],
        'labTestRequest.sample_collected_by_id ' => [
            'nullable',
            'exists:clinic_users,id',
        ],
        'labTestRequest.sample_analyzed_by_id ' => [
            'nullable',
            'exists:clinic_users,id',
        ],
        'labTestRequest.approved_by_id ' => [
            'nullable',
            'exists:clinic_users,id',
        ],
    ];

    public function mount(LabCatagory $labCatagory): void
    {
        $this->labCatagory = $labCatagory;
        $this->labTestRequestGroupsForSelect = LabTestRequestGroup::pluck(
            'id',
            'id'
        );
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetLabTestRequestData();
    }

    public function resetLabTestRequestData(): void
    {
        $this->labTestRequest = new LabTestRequest();

        $this->labTestRequestSampleCollectedAt = null;
        $this->labTestRequestSampleAnalyzedAt = null;
        $this->labTestRequestApprovedAt = null;
        $this->labTestRequestOrderedOn = null;
        $this->labTestRequest->lab_test_request_group_id = null;
        $this->labTestRequest->sample_collected_by_id = null;
        $this->labTestRequest->sample_analyzed_by_id = null;
        $this->labTestRequest->approved_by_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newLabTestRequest(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.lab_catagory_lab_test_requests.new_title'
        );
        $this->resetLabTestRequestData();

        $this->showModal();
    }

    public function editLabTestRequest(LabTestRequest $labTestRequest): void
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.lab_catagory_lab_test_requests.edit_title'
        );
        $this->labTestRequest = $labTestRequest;

        $this->labTestRequestSampleCollectedAt = optional(
            $this->labTestRequest->sample_collected_at
        )->format('Y-m-d');
        $this->labTestRequestSampleAnalyzedAt = optional(
            $this->labTestRequest->sample_analyzed_at
        )->format('Y-m-d');
        $this->labTestRequestApprovedAt = optional(
            $this->labTestRequest->approved_at
        )->format('Y-m-d');
        $this->labTestRequestOrderedOn = optional(
            $this->labTestRequest->ordered_on
        )->format('Y-m-d');

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

        if (!$this->labTestRequest->lab_catagory_id) {
            $this->authorize('create', LabTestRequest::class);

            $this->labTestRequest->lab_catagory_id = $this->labCatagory->id;
        } else {
            $this->authorize('update', $this->labTestRequest);
        }

        $this->labTestRequest->sample_collected_at = \Carbon\Carbon::make(
            $this->labTestRequestSampleCollectedAt
        );
        $this->labTestRequest->sample_analyzed_at = \Carbon\Carbon::make(
            $this->labTestRequestSampleAnalyzedAt
        );
        $this->labTestRequest->approved_at = \Carbon\Carbon::make(
            $this->labTestRequestApprovedAt
        );
        $this->labTestRequest->ordered_on = \Carbon\Carbon::make(
            $this->labTestRequestOrderedOn
        );

        $this->labTestRequest->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', LabTestRequest::class);

        LabTestRequest::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetLabTestRequestData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->labCatagory->labTestRequests as $labTestRequest) {
            array_push($this->selected, $labTestRequest->id);
        }
    }

    public function render(): View
    {
        return view('livewire.lab-catagory-lab-test-requests-detail', [
            'labTestRequests' => $this->labCatagory
                ->labTestRequests()
                ->paginate(20),
        ]);
    }
}
