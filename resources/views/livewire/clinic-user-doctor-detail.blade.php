<div>
    <div class="mb-4">
        @can('create', App\Models\Encounter::class)
        <button class="btn btn-primary" wire:click="newEncounter">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Encounter::class)
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

    <x-modal id="clinic-user-doctor-modal" wire:model="showingModal">
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
                            name="encounter.check_in_time"
                            label="Check In Time"
                            wire:model="encounter.check_in_time"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="encounter.status"
                            label="Status"
                            wire:model="encounter.status"
                            maxlength="255"
                            placeholder="Status"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="encounter.closed_at"
                            label="Closed At"
                            wire:model="encounter.closed_at"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="encounter.priority"
                            label="Priority"
                            wire:model="encounter.priority"
                            maxlength="255"
                            placeholder="Priority"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="encounter.clinic_id"
                            label="Clinic"
                            wire:model="encounter.clinic_id"
                        >
                            <option value="null" disabled>Please select the Clinic</option>
                            @foreach($clinicsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="encounter.registered_by"
                            label="Registered By"
                            wire:model="encounter.registered_by"
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
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.check_in_time')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.status')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.closed_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.priority')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.clinic_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_doctor.inputs.registered_by')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($encounters as $encounter)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $encounter->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">
                        {{ $encounter->check_in_time ?? '-' }}
                    </td>
                    <td class="text-left">{{ $encounter->status ?? '-' }}</td>
                    <td class="text-left">
                        {{ $encounter->closed_at ?? '-' }}
                    </td>
                    <td class="text-left">{{ $encounter->priority ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($encounter->clinic)->name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($encounter->registered_by)->id ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $encounter)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editEncounter({{ $encounter->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">{{ $encounters->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
