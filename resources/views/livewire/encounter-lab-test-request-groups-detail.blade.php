<div>
    <div class="mb-4">
        @can('create', App\Models\LabTestRequestGroup::class)
            <button class="btn btn-sm d-inline-block btn-outline-primary float-right mr-1" wire:click="newLabTestRequestGroup">
                <i class="icon ion-md-add"></i>
                Send  @lang('crud.common.new') invistigation
            </button>
            @endcan @can('delete-any', App\Models\LabTestRequestGroup::class)
            <button class=" btn btn-sm d-inline-block btn-outline-danger float-right mr-1" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> 
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="encounter-lab-test-request-groups-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="labTestRequestGroup.status" label="Status"
                            wire:model="labTestRequestGroup.status" maxlength="255" placeholder="Status">
                        </x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="labTestRequestGroup.priority" label="Priority"
                            wire:model="labTestRequestGroup.priority" maxlength="255" placeholder="Priority">
                        </x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="labTestRequestGroup.notification" label="Notification"
                            wire:model="labTestRequestGroup.notification" maxlength="255" placeholder="Notification">
                        </x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="labTestRequestGroup.call_status" label="Call Status"
                            wire:model="labTestRequestGroup.call_status" maxlength="255" placeholder="Call Status">
                        </x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime name="labTestRequestGroup.requested_at" label="Requested At"
                            wire:model="labTestRequestGroup.requested_at" max="255"></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select name="labTestRequestGroup.clinic_user_id" label="Requestedby"
                            wire:model="labTestRequestGroup.clinic_user_id">
                            <option value="null" disabled>Please select the Clinic User</option>
                            @foreach ($clinicUsersForSelect as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if ($editing)
            @endif

            <div class="modal-footer">
                <button type="button" class="btn btn-light float-left" wire:click="$toggle('showingModal')">
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
                        
                            <th>
                                <input type="checkbox" wire:model="allSelected" wire:click="toggleFullSelection"
                                    title="{{ trans('crud.common.select_all') }}" />
                            </th>
                            <th class="text-left">
                              Patient
                            </th>
                            <th class="text-left">
                                @lang('crud.lab_test_request_groups.inputs.status')
                            </th>
                            <th class="text-left">
                                @lang('crud.lab_test_request_groups.inputs.priority')
                            </th>
                            <th class="text-left">
                              Total Requests
                            </th>
                            <th class="text-left">
                                @lang('crud.lab_test_request_groups.inputs.call_status')
                            </th>
                            <th class="text-left">
                                Date
                            </th>
                            <th class="text-left">
                                Doctor 
                            </th>

                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($labTestRequestGroups  as $key =>  $labTestRequestGroup)
                            <tr>

                           

                                    <td class="text-left">
                                        <input type="checkbox" value="{{ $labTestRequestGroup->id }}" wire:model="selected" />
                                    </td>

                                <td>{{ optional($labTestRequestGroup->encounter)->student->fullName ?? '-' }}</td>
                                <td>{{$labTestRequestGroup->status ? 'Pending' : 'Closed'}} </td>

                                


                                <td>
                                
                                    {{$labTestRequestGroup->priority ? 'FCFS' : 'High'}} 
                                
                                </td>
                                <td>{{ $labTestRequestGroup->labTestRequests->count() }}</td>
                                <td>{{$labTestRequestGroup->call_status  ? 'Waiting' : 'Called'}} 
                                    
                                
                                </td>
                                <td>{{ $labTestRequestGroup->requested_at ?? '-' }}</td>
                                <td>{{ $labTestRequestGroup->clinic_user_id->user->name ?? '-' }}</td>
                              
                                <td class="text-center">
                                    <div role="group" aria-label="Row Actions" class="btn-group">
                                  

                                           @can('view', $labTestRequestGroup)
                                            <a href="{{ route('lab-test-request-groups.show', $labTestRequestGroup) }}">
                                                  <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="fa fa-download"></i> View Result
                                                </button>
                                            </a>
                                            @endcan
                                            @can('update', $labTestRequestGroup)
                                            <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                                  <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </a>
                                            @endcan

                                       
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                {!! $labTestRequestGroups->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
  


</div>
