<div>
    <div class="mb-4">
        @can('create', App\Models\Program::class)
            <button class="btn btn-primary" wire:click="newProgram">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\Program::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> Delete
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="collage-programs-modal" wire:model="showingModal">
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
                        <x-inputs.text name="program.name" label="Name" wire:model="program.name" maxlength="255"
                            placeholder="Name"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select name="program.campus_id" label="Campus" wire:model="program.campus_id">
                            <option value="null" disabled>Please select the Campus</option>
                            @foreach ($campusesForSelect as $value => $label)
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
                        @lang('crud.collage_programs.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.collage_programs.inputs.campus_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($programs as $program)
                    <tr class="hover:bg-gray-100">
                        <td class="text-left">
                            <input type="checkbox" value="{{ $program->id }}" wire:model="selected" />
                        </td>
                        <td class="text-left">{{ $program->name ?? '-' }}</td>
                        <td class="text-left">
                            {{ optional($program->campus)->name ?? '-' }}
                        </td>
                        <td class="text-right">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $program)
                                    <button type="button" class="btn btn-light"
                                        wire:click="editProgram({{ $program->id }})">
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
                    <td colspan="3">{{ $programs->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
