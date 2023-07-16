<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <h2>Encounters for {{ $student->first_name . ' ' . $student->middle_name }} </h2>

        <ul>
            @foreach ($student->encounter as $encounter)
                {{-- {{ dd($encounter) }} --}}
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title w-full">
                            <input type="checkbox" value="{{ $encounter->id }}" wire:model="selected" />
                            {{ $encounter->created_at->format('d-M y') ?? '-' }}
                            <i class="fas fa-user-md ml-4"></i> Studnt Name :
                            {{ optional($student)->first_name ?? '-' }}
                        </h3>

                        @can('update', $encounter)
                            <a href="/encounters/{{ $encounter->id }}/edit" class="btn btn-sm btn-outline-primary mx-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <a href="{{ route('encounters.show', $encounter) }}">
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
                    <div class="card-body pl-3 ml-10" style="display: none;">
                        <h2>Medical Record for {{ $student->first_name . ' ' . $student->middle_name }} </h2>

                        @foreach ($encounter->medicalRecords as $medicalRecord)
                            <div class="card collapsed-card p-3">
                                <div class="card-header">
                                    <h3 class="card-title w-full">
                                        <input type="checkbox" value="{{ $medicalRecord->id }}" wire:model="selected" />
                                        {{ $medicalRecord->created_at->format('d-M y') ?? '-' }}
                                        <i class="fas fa-user-md ml-4"></i> Doctor :
                                        {{ optional($medicalRecord->Doctor->user)->name ?? '-' }}
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
                                                {{ optional($medicalRecord->Doctor->user)->name ?? '-' }}
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
                                                        {{ $medicalRecord->vitalSign->created_at->format('d-M y') ?? '-' }}
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
                                                        {{ $medicalRecord->vitalSign->created_at->format('d-M y') ?? '-' }}
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
            @endforeach
        </ul>

    </div>

</div>
