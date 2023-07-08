<div>
    <div class="mb-4">
        @can('create', App\Models\VitalSign::class)
        <button class="btn btn-primary" wire:click="newVitalSign">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\VitalSign::class)
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

    <x-modal id="clinic-user-vital-signs-modal" wire:model="showingModal">
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
                        <x-inputs.number
                            name="vitalSign.temp"
                            label="Temp"
                            wire:model="vitalSign.temp"
                            max="255"
                            step="0.01"
                            placeholder="Temp"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.blood_pressure"
                            label="Blood Pressure"
                            wire:model="vitalSign.blood_pressure"
                            max="255"
                            step="0.01"
                            placeholder="Blood Pressure"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.pulse_rate"
                            label="Pulse Rate"
                            wire:model="vitalSign.pulse_rate"
                            max="255"
                            step="0.01"
                            placeholder="Pulse Rate"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.rr"
                            label="Rr"
                            wire:model="vitalSign.rr"
                            max="255"
                            step="0.01"
                            placeholder="Rr"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.weight"
                            label="Weight"
                            wire:model="vitalSign.weight"
                            max="255"
                            step="0.01"
                            placeholder="Weight"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.height"
                            label="Height"
                            wire:model="vitalSign.height"
                            max="255"
                            step="0.01"
                            placeholder="Height"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="vitalSign.muac"
                            label="Muac"
                            wire:model="vitalSign.muac"
                            max="255"
                            step="0.01"
                            placeholder="Muac"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="vitalSign.encounter_id"
                            label="Encounter"
                            wire:model="vitalSign.encounter_id"
                        >
                            <option value="null" disabled>Please select the Encounter</option>
                            @foreach($encountersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="vitalSign.student_id"
                            label="Student"
                            wire:model="vitalSign.student_id"
                        >
                            <option value="null" disabled>Please select the Student</option>
                            @foreach($studentsForSelect as $value => $label)
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
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.temp')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.blood_pressure
                        ')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.pulse_rate')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.rr')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.weight')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.height')
                    </th>
                    <th class="text-right">
                        @lang('crud.clinic_user_vital_signs.inputs.muac')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_vital_signs.inputs.encounter_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_vital_signs.inputs.student_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($vitalSigns as $vitalSign)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $vitalSign->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-right">{{ $vitalSign->temp ?? '-' }}</td>
                    <td class="text-right">
                        {{ $vitalSign->blood_pressure?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $vitalSign->pulse_rate ?? '-' }}
                    </td>
                    <td class="text-right">{{ $vitalSign->rr ?? '-' }}</td>
                    <td class="text-right">{{ $vitalSign->weight ?? '-' }}</td>
                    <td class="text-right">{{ $vitalSign->height ?? '-' }}</td>
                    <td class="text-right">{{ $vitalSign->muac ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($vitalSign->encounter)->id ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($vitalSign->student)->first_name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $vitalSign)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editVitalSign({{ $vitalSign->id }})"
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
                    <td colspan="10">{{ $vitalSigns->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
