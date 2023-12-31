<div>
    <div class="mb-4">
        @can('create', App\Models\LabTestRequestGroup::class)
            <button class="btn btn-primary" wire:click="newLabTestRequestGroup">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\LabTestRequestGroup::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> Delete
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="clinic-user-lab-test-request-groups-modal" wire:model="showingModal">
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
                        <x-inputs.select name="labTestRequestGroup.encounter_id" label="Encounter"
                            wire:model="labTestRequestGroup.encounter_id">
                            <option value="null" disabled>Please select the Encounter</option>
                            @foreach ($encountersForSelect as $value => $label)
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
        <table class="table table-hover  table-sm table-condensed">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" wire:model="allSelected" wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}" />
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.status')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.priority')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.notification')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.call_status')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.requested_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_lab_test_request_groups.inputs.encounter_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($labTestRequestGroups as $labTestRequestGroup)
                    <tr class="hover:bg-gray-100">
                        <td class="text-left">
                            <input type="checkbox" value="{{ $labTestRequestGroup->id }}" wire:model="selected" />
                        </td>
                        <td class="text-left">
                            {{ $labTestRequestGroup->status ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $labTestRequestGroup->priority ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $labTestRequestGroup->notification ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $labTestRequestGroup->call_status ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $labTestRequestGroup->requested_at ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ optional($labTestRequestGroup->encounter)->id ?? '-' }}
                        </td>
                        <td class="text-right">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $labTestRequestGroup)
                                    <button type="button" class="btn btn-light"
                                        wire:click="editLabTestRequestGroup({{ $labTestRequestGroup->id }})">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">{{ $labTestRequestGroups->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
