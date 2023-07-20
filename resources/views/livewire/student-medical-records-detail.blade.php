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
                    <h3 class="card-title w-full">
                        <input type="checkbox" value="{{ $medicalRecord->id }}" wire:model="selected" />
                        {{ $medicalRecord->created_at->format('d-M y') ?? '-' }}
                        <i class="fas fa-user-md ml-4"></i> Doctor :
                        {{ optional($medicalRecord->Doctor)->user->name ?? '-' }}

                    </h3>

                    @can('update', $medicalRecord)
                        <button type="button" class="btn btn-sm btn-outline-primary mx-1"
                            wire:click="editMedicalRecord({{ $medicalRecord->id }})">
                            <i class="fa fa-edit"></i> Edit
                        </button>

                        <a href="{{ route('medical-records.show', $medicalRecord) }}">
                            <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="icon ion-md-eye"></i> Show
                            </button>
                        </a>
                    @endcan

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
                                <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.subjective'):
                                {{ $medicalRecord->subjective ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.objective'):
                                {{ $medicalRecord->objective ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.assessment'):
                                {{ $medicalRecord->assessment ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.plan'):
                                {{ $medicalRecord->plan ?? '-' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-md"></i> Doctor :
                                {{ optional($medicalRecord->Doctor)->user->name ?? '-' }}

                            </a>
                        </li>
                    </ul>

                    <div class="md-4 row">
                        {{-- vital signes start  --}}
                        <div class="box box-primary col-4">
                            <div class="box-header with-border" data-toggle="collapse"
                                data-target="#vital_signe_medical_record">
                                <h4 class="box-title">Vital Signes</h4>
                            </div>

                            <div id="vital_signe_medical_record" class="collapse">
                                <div class="box-body">
                                    <strong> @lang('crud.student_vital_signs.inputs.date')</strong>
                                    <p class="text-muted">
                                        <i class="fa fa-calendar"></i>
                                        {{ $medicalRecord->vitalSign ? $medicalRecord->vitalSign->created_at->format('d-M y') : '-' }}

                                    </p>
                                    <hr>
                                    <strong>
                                        @lang('crud.student_vital_signs.inputs.temp')</strong>
                                    <p class="text-muted">
                                        <i class="fa fa-thermometer-empty"></i>
                                        {{ $medicalRecord->vitalSign->temp ?? '-' }}
                                    </p>
                                    <hr>
                                    <strong>@lang('crud.student_vital_signs.inputs.blood_pressure')</strong>
                                    <p>
                                        <span class="label label-danger">
                                            <i class="fa fa-heartbeat"></i>
                                            {{ $medicalRecord->vitalSign->blood_pressure ?? '-' }}
                                        </span>
                                    </p>
                                    <hr>
                                    <strong> @lang('crud.student_vital_signs.inputs.pulse_rate')</strong>
                                    <p>
                                        <i class="fa fa-heartbeat"></i>
                                        {{ $medicalRecord->vitalSign->pulse_rate ?? '-' }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        {{-- vital signes end  --}}
                        {{-- main dignosis start  --}}
                        <div class="box box-primary col-4">
                            <div class="box-header with-border" data-toggle="collapse"
                                data-target="#vital_signe_medical_record">
                                <h4 class="box-title">Main Dignosis</h4>
                            </div>

                            <div id="vital_signe_medical_record" class="collapse">
                                <div class="box-body">
                                    <strong> @lang('crud.student_vital_signs.inputs.date')</strong>
                                    <p class="text-muted">
                                        <i class="fa fa-calendar"></i>
                                        {{ $medicalRecord->vitalSign ? $medicalRecord->vitalSign->created_at->format('d-M y') : '-' }}

                                    </p>
                                    <hr>
                                    <strong>
                                        @lang('crud.student_vital_signs.inputs.temp')</strong>
                                    <p class="text-muted">
                                        <i class="fa fa-thermometer-empty"></i>
                                        {{ $medicalRecord->vitalSign->temp ?? '-' }}
                                    </p>
                                    <hr>
                                    <strong>@lang('crud.student_vital_signs.inputs.blood_pressure')</strong>
                                    <p>
                                        <span class="label label-danger">
                                            <i class="fa fa-heartbeat"></i>
                                            {{ $medicalRecord->vitalSign->blood_pressure ?? '-' }}
                                        </span>
                                    </p>
                                    <hr>
                                    <strong> @lang('crud.student_vital_signs.inputs.pulse_rate')</strong>
                                    <p>
                                        <i class="fa fa-heartbeat"></i>
                                        {{ $medicalRecord->vitalSign->pulse_rate ?? '-' }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        {{-- main dignosis end  --}}
                    </div>

                </div>

            </div>
        @endforeach

    </div>
</div>
