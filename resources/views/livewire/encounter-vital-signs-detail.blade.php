<div>
    <div class="mb-4">
        @can('create', App\Models\VitalSign::class)
            <button class="btn btn-primary" wire:click="newVitalSign">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\VitalSign::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i>
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="encounter-vital-signs-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.temp" label="Temperature (°C)"
                                    wire:model="vitalSign.temp" step="0.01"
                                    placeholder="Enter temperature"></x-inputs.number>
                            </x-inputs.group>

                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.blood_pressure" label="Blood Pressure"
                                    wire:model="vitalSign.blood_pressure" step="0.01"
                                    placeholder="Enter blood pressure"></x-inputs.number>
                            </x-inputs.group>

                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.pulse_rate" label="Pulse Rate"
                                    wire:model="vitalSign.pulse_rate" step="0.01"
                                    placeholder="Enter pulse rate"></x-inputs.number>
                            </x-inputs.group>

                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.rr" label="Respiratory Rate" wire:model="vitalSign.rr"
                                    step="0.01" placeholder="Enter respiratory rate"></x-inputs.number>
                            </x-inputs.group>
                        </div>

                        <div class="col-md-6">
                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.weight" label="Weight (kg)"
                                    wire:model="vitalSign.weight" step="0.01"
                                    placeholder="Enter weight"></x-inputs.number>
                            </x-inputs.group>

                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.height" label="Height (cm)"
                                    wire:model="vitalSign.height" step="0.01"
                                    placeholder="Enter height"></x-inputs.number>
                            </x-inputs.group>

                            <x-inputs.group>
                                <x-inputs.number name="vitalSign.muac" label="MUAC" wire:model="vitalSign.muac"
                                    step="0.01" placeholder="Enter MUAC"></x-inputs.number>
                            </x-inputs.group>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">
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
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.temp')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.blood_pressure')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.pulse_rate')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.rr')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.weight')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.height')
                    </th>
                    <th class="text-right">
                        @lang('crud.encounter_vital_signs.inputs.muac')
                    </th>
                    <th class="text-left">
                        @lang('crud.encounter_vital_signs.inputs.clinic_user_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.encounter_vital_signs.inputs.student_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($vitalSigns as $vitalSign)
                    <tr class="hover:bg-gray-100">
                        <td class="text-left">
                            <input type="checkbox" value="{{ $vitalSign->id }}" wire:model="selected" />
                        </td>
                        <td class="text-right">{{ $vitalSign->temp ?? '-' }}</td>
                        <td class="text-right">
                            {{ $vitalSign->blood_pressure ?? '-' }}
                        </td>
                        <td class="text-right">
                            {{ $vitalSign->pulse_rate ?? '-' }}
                        </td>
                        <td class="text-right">{{ $vitalSign->rr ?? '-' }}</td>
                        <td class="text-right">{{ $vitalSign->weight ?? '-' }}</td>
                        <td class="text-right">{{ $vitalSign->height ?? '-' }}</td>
                        <td class="text-right">{{ $vitalSign->muac ?? '-' }}</td>
                        <td class="text-left">
                            {{ optional($vitalSign->Doctor)->id ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ optional($vitalSign->student)->first_name ?? '-' }}
                        </td>
                        <td class="text-right">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $vitalSign)
                                    <button type="button" class="btn btn-light"
                                        wire:click="editVitalSign({{ $vitalSign->id }})">
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
                    <td colspan="10">{{ $vitalSigns->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
