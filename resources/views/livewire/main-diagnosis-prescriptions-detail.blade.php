<div>
    <div class="mb-4">
        @can('create', App\Models\Prescription::class)
            <button class="btn btn-primary" wire:click="newPrescription">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\Prescription::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> 
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="main-diagnosis-prescriptions-modal" wire:model="showingModal">
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
                        <x-inputs.textarea name="prescription.drug_name" label="Drug Name"
                            wire:model="prescription.drug_name" maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="prescription.dose" label="Dose" wire:model="prescription.dose"
                            maxlength="255" placeholder="Dose"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="prescription.frequency" label="Frequency"
                            wire:model="prescription.frequency" maxlength="255" placeholder="Frequency"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="prescription.duration" label="Duration" wire:model="prescription.duration"
                            maxlength="255" placeholder="Duration"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea name="prescription.other_info" label="Other Info"
                            wire:model="prescription.other_info" maxlength="255"></x-inputs.textarea>
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
                        @lang('crud.main_diagnosis_prescriptions.inputs.drug_name')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_diagnosis_prescriptions.inputs.dose')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_diagnosis_prescriptions.inputs.frequency')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_diagnosis_prescriptions.inputs.duration')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_diagnosis_prescriptions.inputs.other_info')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($prescriptions as $prescription)
                    <tr class="hover:bg-gray-100">
                        <td class="text-left">
                            <input type="checkbox" value="{{ $prescription->id }}" wire:model="selected" />
                        </td>
                        <td class="text-left">
                            {{ $prescription->drug_name ?? '-' }}
                        </td>
                        <td class="text-left">{{ $prescription->dose ?? '-' }}</td>
                        <td class="text-left">
                            {{ $prescription->frequency ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $prescription->duration ?? '-' }}
                        </td>
                        <td class="text-left">
                            {{ $prescription->other_info ?? '-' }}
                        </td>
                        <td class="text-right">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $prescription)
                                    <button type="button" class="btn btn-light"
                                        wire:click="editPrescription({{ $prescription->id }})">
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
                    <td colspan="6">{{ $prescriptions->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
