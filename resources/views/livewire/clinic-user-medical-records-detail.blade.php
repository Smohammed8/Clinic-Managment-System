<div>
    <div class="mb-4">
        @can('create', App\Models\MedicalRecord::class)
        <button class="btn btn-primary" wire:click="newMedicalRecord">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\MedicalRecord::class)
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

    <x-modal id="clinic-user-medical-records-modal" wire:model="showingModal">
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
                        <x-inputs.textarea
                            name="medicalRecord.subjective"
                            label="Subjective"
                            wire:model="medicalRecord.subjective"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="medicalRecord.objective"
                            label="Objective"
                            wire:model="medicalRecord.objective"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="medicalRecord.assessment"
                            label="Assessment"
                            wire:model="medicalRecord.assessment"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="medicalRecord.plan"
                            label="Plan"
                            wire:model="medicalRecord.plan"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="medicalRecord.encounter_id"
                            label="Encounter"
                            wire:model="medicalRecord.encounter_id"
                        >
                            <option value="null" disabled>Please select the Encounter</option>
                            @foreach($encountersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="medicalRecord.student_id"
                            label="Student"
                            wire:model="medicalRecord.student_id"
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
        <table class="table table-hover table-condensed">
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
                        @lang('crud.clinic_user_medical_records.inputs.subjective')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_medical_records.inputs.objective')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_medical_records.inputs.assessment')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_medical_records.inputs.plan')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_medical_records.inputs.encounter_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.clinic_user_medical_records.inputs.student_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($medicalRecords as $medicalRecord)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $medicalRecord->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">
                        {{ $medicalRecord->subjective ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $medicalRecord->objective ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $medicalRecord->assessment ?? '-' }}
                    </td>
                    <td class="text-left">{{ $medicalRecord->plan ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($medicalRecord->encounter)->id ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($medicalRecord->student)->first_name ?? '-'
                        }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $medicalRecord)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editMedicalRecord({{ $medicalRecord->id }})"
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
                    <td colspan="7">{{ $medicalRecords->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
