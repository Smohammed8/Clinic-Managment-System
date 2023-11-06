<div>
    <div class="mb-4">
        @can('create', App\Models\Clinic::class)
            <button class="btn btn-primary" wire:click="newClinic">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\Clinic::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> Delete
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="campus-clinics-modal" wire:model="showingModal">
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
                        <x-inputs.text name="clinic.name" label="Name" wire:model="clinic.name" maxlength="255"
                            placeholder="Name"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="clinic.code_clinic" label="Code Clinic" wire:model="clinic.code_clinic"
                            maxlength="255" placeholder="Code Clinic"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea name="clinic.description" label="Description" wire:model="clinic.description"
                            maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number name="clinic.lat" label="Lat" wire:model="clinic.lat" max="255"
                            step="0.01" placeholder="Lat"></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number name="clinic.long" label="Long" wire:model="clinic.long" max="255"
                            step="0.01" placeholder="Long"></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select name="clinic.collage_id" label="Collage" wire:model="clinic.collage_id">
                            <option value="null" disabled>Please select the Collage</option>
                            @foreach ($collagesForSelect as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="clinic.status" label="Status" wire:model="clinic.status" maxlength="255"
                            placeholder="Status"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text name="clinic.is_active" label="Is Active" wire:model="clinic.is_active"
                            maxlength="255" placeholder="Is Active"></x-inputs.text>
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
                        @lang('crud.campus_clinics.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.campus_clinics.inputs.code_clinic')
                    </th>
                    <th class="text-left">
                        @lang('crud.campus_clinics.inputs.description')
                    </th>
                    <th class="text-right">
                        @lang('crud.campus_clinics.inputs.lat')
                    </th>
                    <th class="text-right">
                        @lang('crud.campus_clinics.inputs.long')
                    </th>
                    <th class="text-left">
                        @lang('crud.campus_clinics.inputs.collage_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.campus_clinics.inputs.status')
                    </th>
                    <th class="text-left">
                        @lang('crud.campus_clinics.inputs.is_active')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($clinics as $clinic)
                    <tr class="hover:bg-gray-100">
                        <td class="text-left">
                            <input type="checkbox" value="{{ $clinic->id }}" wire:model="selected" />
                        </td>
                        <td class="text-left">{{ $clinic->name ?? '-' }}</td>
                        <td class="text-left">{{ $clinic->code_clinic ?? '-' }}</td>
                        <td class="text-left">{{ $clinic->description ?? '-' }}</td>
                        <td class="text-right">{{ $clinic->lat ?? '-' }}</td>
                        <td class="text-right">{{ $clinic->long ?? '-' }}</td>
                        <td class="text-left">
                            {{ optional($clinic->collage)->name ?? '-' }}
                        </td>
                        <td class="text-left">{{ $clinic->status ?? '-' }}</td>
                        <td class="text-left">{{ $clinic->is_active ?? '-' }}</td>
                        <td class="text-right">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $clinic)
                                    <button type="button" class="btn btn-light"
                                        wire:click="editClinic({{ $clinic->id }})">
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
                    <td colspan="9">{{ $clinics->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
