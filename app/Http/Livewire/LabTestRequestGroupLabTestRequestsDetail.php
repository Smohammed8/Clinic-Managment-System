<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\ClinicUser;
use App\Models\LabCatagory;
use Livewire\WithPagination;
use App\Models\LabTestRequest;
use App\Models\LabTestRequestGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LabTestRequestGroupLabTestRequestsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public LabTestRequestGroup $labTestRequestGroup;
    public LabTestRequest $labTestRequest;
    public $clinicUsersForSelect = [];
    public $labCatagoriesForSelect = [];
    public $labTestRequestSampleCollectedAt;
    public $labTestRequestSampleAnalyzedAt;
    public $labTestRequestApprovedAt;
    public $labTestRequestOrderedOn;
    public $user;
    public $date;
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
        'labTestRequest.sample_collected_by_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
        'labTestRequest.sample_analyzed_by_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
        'labTestRequest.lab_catagory_id' => [
            'nullable',
            'exists:lab_catagories,id',
        ],
        'labTestRequest.approved_by_id' => [
            'nullable',
            'exists:clinic_users,id',
        ],
    ];

    public function mount(LabTestRequestGroup $labTestRequestGroup): void
    {

          //Get the current user
        $this->user = Auth::user();
        $this->date = Carbon::now();


   

        $this->labTestRequestGroup = $labTestRequestGroup;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->labCatagoriesForSelect = LabCatagory::pluck('lab_name', 'id');
        $this->resetLabTestRequestData();
    }

    public function resetLabTestRequestData(): void
    {
        $this->labTestRequest = new LabTestRequest();

        $this->labTestRequestSampleCollectedAt = null;
        $this->labTestRequestSampleAnalyzedAt = null;
        $this->labTestRequestApprovedAt = null;
        $this->labTestRequestOrderedOn = null;
        $this->labTestRequest->sample_collected_by_id= null;
        $this->labTestRequest->sample_analyzed_by_id= null;
        $this->labTestRequest->lab_catagory_id = null;
        $this->labTestRequest->approved_by_id= null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newLabTestRequest(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.lab_test_request_group_lab_test_requests.new_title'
        );
        $this->resetLabTestRequestData();

        $this->showModal();
    }

    public function editLabTestRequest(LabTestRequest $labTestRequest): void
    {
       
        $this->editing = true;

        $labTestRequest->sample_collected_by_id = Auth::user()->id;
        $labTestRequest->sample_analyzed_by_id =Auth::user()->id; 
        $labTestRequest->approved_by_id  = Auth::user()->id; 
        $labTestRequest->status  = 1;
        $labTestRequest->sample_collected_at  = Carbon::now();
        $labTestRequest->sample_analyzed_at = Carbon::now();
        $labTestRequest->approved_at = Carbon::now();
        $labTestRequest->updated_at = Carbon::now();

        $this->modalTitle = trans('crud.lab_test_request_group_lab_test_requests.edit_title');
        $this->labTestRequest = $labTestRequest;

        $this->labTestRequestSampleCollectedAt = optional($this->labTestRequest->sample_collected_at)->format('Y-m-d');
        $this->labTestRequestSampleAnalyzedAt = optional( $this->labTestRequest->sample_analyzed_at)->format('Y-m-d');
        $this->labTestRequestApprovedAt = optional($this->labTestRequest->approved_at)->format('Y-m-d');
        $this->labTestRequestOrderedOn = optional($this->labTestRequest->ordered_on)->format('Y-m-d');




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

        if (!$this->labTestRequest->lab_test_request_group_id) {
            $this->authorize('create', LabTestRequest::class);

            $this->labTestRequest->lab_test_request_group_id =
                $this->labTestRequestGroup->id;
        } else {
            $this->authorize('update', $this->labTestRequest);
        }

        $this->labTestRequest->sample_collected_at = Carbon::make($this->labTestRequestSampleCollectedAt);
        $this->labTestRequest->sample_analyzed_at = Carbon::make($this->labTestRequestSampleAnalyzedAt);
        $this->labTestRequest->approved_at = Carbon::make($this->labTestRequestApprovedAt);
        $this->labTestRequest->ordered_on = Carbon::make($this->labTestRequestOrderedOn);

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

        foreach (
            $this->labTestRequestGroup->labTestRequests
            as $labTestRequest
        ) {
            array_push($this->selected, $labTestRequest->id);
        }
    }

    public function render(): View
    {
        return view(
            'livewire.lab-test-request-group-lab-test-requests-detail',
            [
                'labTestRequests' => $this->labTestRequestGroup
                    ->labTestRequests()
                    ->paginate(20),
            ]
        );
    }
}
