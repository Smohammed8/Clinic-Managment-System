<div>
    <div class="mb-4">
        @can('create', App\Models\Room::class)
            <button class="btn btn-primary" wire:click="newRoom">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.attach')
            </button>
        @endcan
    </div>

    <x-modal id="clinic-user-rooms-modal" wire:model="showingModal">
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
                        <x-inputs.select name="room_id" label="Room" wire:model="room_id">
                            <option value="null" disabled>Please select the Room</option>
                            @foreach ($roomsForSelect as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

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
                    <th class="text-left">
                        @lang('crud.clinic_user_rooms.inputs.room_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            {{-- @dd($room_name); --}}
            <tbody class="text-gray-600">
                <tr class="hover:bg-gray-100">
                    <td class="text-left">{{ $room_name ?? '-' }}</td>
                    <td class="text-right" style="width: 70px;">
                        <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                            @can('delete-any', App\Models\Room::class)
                                <button class="btn btn-sm btn-outline-danger mx-1"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    wire:click="detach('{{ $room_id }}')">
                                    <i class="icon ion-md-trash"></i> Delete
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                {{-- <tr>
                    <td colspan="2">{{ $clinicUserRooms->render() }}</td>
                </tr> --}}
            </tfoot>
        </table>
    </div>
</div>
