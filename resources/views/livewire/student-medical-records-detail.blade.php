<div>
    <div class="mb-4">
        @can('create', App\Models\MedicalRecord::class)
            <button class="btn btn-primary" wire:click="newMedicalRecord">
                <i class="icon ion-md-add"></i>
                @lang('crud.common.new')
            </button>
            @endcan @can('delete-any', App\Models\MedicalRecord::class)
            <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected">
                <i class="icon ion-md-trash"></i> Delete
                @lang('crud.common.delete_selected')
            </button>
        @endcan
    </div>

    <x-modal id="student-medical-records-modal" wire:model="showingModal">
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
                        <x-inputs.textarea name="medicalRecord.subjective" label="Subjective"
                            wire:model="medicalRecord.subjective" maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea name="medicalRecord.objective" label="Objective"
                            wire:model="medicalRecord.objective" maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea name="medicalRecord.assessment" label="Assessment"
                            wire:model="medicalRecord.assessment" maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea name="medicalRecord.plan" label="Plan" wire:model="medicalRecord.plan"
                            maxlength="255"></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select name="medicalRecord.encounter_id" label="Encounter"
                            wire:model="medicalRecord.encounter_id">
                            <option value="null" disabled>Please select the Encounter</option>
                            @foreach ($encountersForSelect as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select name="medicalRecord.clinic_user_id" label="Doctor"
                            wire:model="medicalRecord.clinic_user_id">
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

        @foreach ($medicalRecords as $medicalRecord)
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Medical Record</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: none;">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> Subjective: {{ $medicalRecord->subjective ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> Objective: {{ $medicalRecord->objective ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> Assessment: {{ $medicalRecord->assessment ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> Plan: {{ $medicalRecord->plan ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-md"></i> Doctor ID:
                                {{ optional($medicalRecord->Doctor)->id ?? '-' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
