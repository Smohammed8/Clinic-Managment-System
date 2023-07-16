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
                    <div class="card-body p-0" style="display: none;">
                        @foreach ($encounter->medicalRecords as $medicalrecord)
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.subjective'):
                                        {{ $medicalrecord->subjective ?? '-' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.objective'):
                                        {{ $medicalrecord->objective ?? '-' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.assessment'):
                                        {{ $medicalrecord->assessment ?? '-' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-file-alt"></i> @lang('crud.student_medical_records.inputs.plan'):
                                        {{ $medicalrecord->plan ?? '-' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-user-md"></i> Doctor :
                                        {{ optional($medicalrecord->student)->first_name ?? '-' }}
                                    </a>
                                </li>
                            </ul>
                        @endforeach

                    </div>

                </div>
            @endforeach
        </ul>

    </div>

</div>
