<div>
    <div class="mb-4">
        @can('create', App\Models\LabTestRequest::class)
        <button class="btn btn-primary" wire:click="newLabTestRequest">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\LabTestRequest::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal
        id="lab-test-request-group-lab-test-requests-modal"
        wire:model="showingModal"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="labTestRequest.sample_collected_at"
                            label="Sample Collected At"
                            wire:model="labTestRequest.sample_collected_at"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="labTestRequest.sample_analyzed_at"
                            label="Sample Analyzed At"
                            wire:model="labTestRequest.sample_analyzed_at"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="labTestRequest.status"
                            label="Status"
                            wire:model="labTestRequest.status"
                            maxlength="255"
                            placeholder="Status"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="labTestRequest.notification"
                            label="Notification"
                            wire:model="labTestRequest.notification"
                            maxlength="255"
                            placeholder="Notification"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="labTestRequest.note"
                            label="Note"
                            wire:model="labTestRequest.note"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="labTestRequest.result"
                            label="Result"
                            wire:model="labTestRequest.result"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="labTestRequest.comment"
                            label="Comment"
                            wire:model="labTestRequest.comment"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="labTestRequest.analyser_result"
                            label="Analyser Result"
                            wire:model="labTestRequest.analyser_result"
                            maxlength="255"
                            placeholder="Analyser Result"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="labTestRequest.approved_at"
                            label="Approved At"
                            wire:model="labTestRequest.approved_at"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="labTestRequest.price"
                            label="Price"
                            wire:model="labTestRequest.price"
                            max="255"
                            step="0.01"
                            placeholder="Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="labTestRequest.sample_id"
                            label="Sample Id"
                            wire:model="labTestRequest.sample_id"
                            maxlength="255"
                            placeholder="Sample Id"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="labTestRequest.ordered_on"
                            label="Ordered On"
                            wire:model="labTestRequest.ordered_on"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="labTestRequest.sample_collected_by_id"
                            label="Sample Ccollected By"
                            wire:model="labTestRequest.sample_collected_by_id"
                        >
                            <option value="null" disabled>Please select the Clinic User</option>
                            @foreach($clinicUsersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="labTestRequest.sample_analyzed_by_id"
                            label="Sample Analyzed By"
                            wire:model="labTestRequest.sample_analyzed_by_id"
                        >
                            <option value="null" disabled>Please select the Clinic User</option>
                            @foreach($clinicUsersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="labTestRequest.lab_catagory_id"
                            label="Lab Catagory"
                            wire:model="labTestRequest.lab_catagory_id"
                        >
                            <option value="null" disabled>Please select the Lab Catagory</option>
                            @foreach($labCatagoriesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="labTestRequest.approved_by_id"
                            label="Approved By"
                            wire:model="labTestRequest.approved_by_id"
                        >
                            <option value="null" disabled>Please select the Clinic User</option>
                            @foreach($clinicUsersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th> <input type="checkbox"  wire:model="allSelected" wire:click="toggleFullSelection" title="{{ trans('crud.common.select_all') }}"/></th>
                   
                    @if (Auth::user()->hasRole('Lab_technician'))
               
                    @can('view', $labTestRequest)

                    <th class="text-left"> Test Name </th>
                    <th class="text-left">  Order on   </th>
                    <th class="text-left"> Status </th>
                    <th class="text-left"> Result </th>
                    <th class="text-left"> Comment </th>
                    <th class="text-right">Price </th>
                    <th class="text-left"> Sample ID </th>
                    <th class="text-left"> Sample taken</th>
                    <th class="text-left"> Lab Category </th>
                    <th class="text-left"> Approved by  </th>
                    <th class="text-left"> Action</th>
                    @endcan 
                    {{-- @else

                
                    <th class="text-left"> Sample Collected at </th>
                    <th class="text-left"> Sample Analysized at </th>
                    <th class="text-left"> Status </th>
                    <th class="text-left"> Note</th>
                    <th class="text-left"> Result </th>
                    <th class="text-left"> Comment </th>
                    <th class="text-left"> Analyised result </th>
                    <th class="text-left"> Approved at </th>
                    <th class="text-right">Price </th>
                    <th class="text-left"> Sample ID </th>
                    <th class="text-left"> Order on </th>
                    <th class="text-left"> Sample collected by </th>
                    <th class="text-left"> Sample Analyzed </th>
                    <th class="text-left"> Lab Category </th>
                    <th class="text-left"> Approved by  </th> --}}
                    @endif


                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($labTestRequests as $labTestRequest)

                @if (Auth::user()->hasRole('Lab_technician'))
                    <tr class="hover:bg-gray-100">
                    <td class="text-left"> <input type="checkbox" value="{{ $labTestRequest->id }}" wire:model="selected"/></td>
                    <td class="text-left"> CBE </td>
          
                    <td class="text-left">{{ $labTestRequest->labTestRequestGroup?->created_at->format('j F,Y') }} </td>
                    <td class="text-left"> @if($labTestRequest->status == 0) <span style= "color:red;"> Pending </span> @else <i class="fa fa-check"> </i>  @endif </td>
                    <td class="text-left"> {{ $labTestRequest->result ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->comment ?? '-' }} </td>
                    <td class="text-right"> {{ $labTestRequest->price ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->sample_id ?? '-' }} </td>
                    <td class="text-left">{{ $labTestRequest->sample_collected_at ?->format('j F,Y') ?? '-' }} </td>
                    <td class="text-left"> {{ optional($labTestRequest->labCatagory)->lab_name ??'-' }}</td>
                    <td class="text-left"> {{ optional($labTestRequest->approvedBy)->user->name ?? '-' }} </td>
                        <td class="text-right">
                        <div role="group" aria-label="Row Actions" class="btn-group">
                                @can('update', $labTestRequestGroup)
                                <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                      <i class="fa fa-plus"></i> Take Sample
                                    </button>
                                  </button>
                              </a>
                              @endcan

                              @can('update', $labTestRequestGroup)
                              <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                  <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                    <i class="fa fa-upload"></i> Upload Result
                                  </button>
                                </button>
                            </a>
                            @endcan

                                @can('update', $labTestRequest)
                                <button type="button" class="btn btn-sm btn-outline-primary mx-1"  wire:click="editLabTestRequest({{ $labTestRequest->id }})" >
                                    <i class="fa fa-plus"></i> Add Result
                                </button>
                                @endcan
                        </div>
                    </td>
                </tr>
                @endif

                {{-- @else --}}

                {{-- <tr class="hover:bg-gray-100">
                    <td class="text-left"> <input type="checkbox" value="{{ $labTestRequest->id }}" wire:model="selected"/></td>
                    <td class="text-left">{{ $labTestRequest->sample_collected_at ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->sample_analyzed_at ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->status ?? '-' }}</td>
                    <td class="text-left"> {{ $labTestRequest->note ?? '-' }}  </td>
                    <td class="text-left"> {{ $labTestRequest->result ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->comment ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->analyser_result ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->approved_at ?? '-' }}</td>
                    <td class="text-right"> {{ $labTestRequest->price ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->sample_id ?? '-' }} </td>
                    <td class="text-left"> {{ $labTestRequest->ordered_on ?? '-' }} </td>
                    <td class="text-left"> {{ optional($labTestRequest->sampleCcollectedBy)->id ?? '-' }} </td>
                    <td class="text-left"> {{ optional($labTestRequest->sampleAnalyzedBy)->id ?? '-' }}</td>
                    <td class="text-left"> {{ optional($labTestRequest->labCatagory)->lab_name ??'-' }}</td>
                    <td class="text-left"> {{ optional($labTestRequest->approvedBy)->id ?? '-' }} </td>

        
               
                        <td class="text-right">
                        <div role="group" aria-label="Row Actions" class="btn-group">
                                @can('update', $labTestRequestGroup)
                                <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                      <i class="fa fa-plus"></i> Take Sample
                                    </button>
                                  </button>
                              </a>
                              @endcan
                                @can('update', $labTestRequest)
                                <button type="button" class="btn btn-sm btn-outline-primary mx-1"  wire:click="editLabTestRequest({{ $labTestRequest->id }})" >
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                @endcan
                        </div>
                    </td>
                </tr> --}}

                {{-- @endif --}}
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="17">{{ $labTestRequests->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
