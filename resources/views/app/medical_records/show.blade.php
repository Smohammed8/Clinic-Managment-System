@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('medical-records.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.medical_records.show_title')
                </h4>

                <div class="mt-4">

                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.encounter_id')</h5>

                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.check_in_time')
                                        </th>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.student_id')
                                        </th>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.status')
                                        </th>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.closed_at')
                                        </th>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.priority')
                                        </th>
                                        <th class="text-left">
                                            @lang('crud.encounters.inputs.clinic_id')
                                        </th>
                                        <th class="text-center">
                                            @lang('crud.common.actions')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{ $medicalRecord->encounter->check_in_time ?? '-' }}</td>
                                        <td>{{ $medicalRecord->encounter->student->id_number ?? '-' }}</td>

                                        <td>{{ $medicalRecord->encounter->status ?? '-' }}</td>
                                        <td>{{ $medicalRecord->encounter->closed_at ?? '-' }}</td>
                                        <td>{{ $medicalRecord->encounter->priority ?? '-' }}</td>
                                        <td>
                                            {{ optional($medicalRecord->encounter->clinic)->name ?? '-' }}
                                        </td>
                                        <td class="text-center" style="width: 134px;">
                                            <div role="group" aria-label="Row Actions" class="btn-group">
                                                @can('update', $medicalRecord->encounter)
                                                    <a href="{{ route('encounters.edit', $medicalRecord->encounter) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                    @endcan @can('view', $medicalRecord->encounter)
                                                    <a href="{{ route('encounters.show', $medicalRecord->encounter) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="icon ion-md-eye"></i>
                                                        </button>
                                                    </a>
                                                    @endcan @can('delete', $medicalRecord->encounter)
                                                    <form action="{{ route('encounters.destroy', $medicalRecord->encounter) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                            <i class="icon ion-md-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                            </table>
                        </div>

                    </div>

                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.subjective')</h5>
                        <span>{{ $medicalRecord->subjective ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.objective')</h5>
                        <span>{{ $medicalRecord->objective ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.assessment')</h5>
                        <span>{{ $medicalRecord->assessment ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.plan')</h5>
                        <span>{{ $medicalRecord->plan ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.clinic_user_id')</h5>
                        <span>{{ optional($medicalRecord->Doctor->user)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.medical_records.inputs.student_id')</h5>
                        <span>{{ optional($medicalRecord->student)->first_name ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('medical-records.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\MedicalRecord::class)
                        <a href="{{ route('medical-records.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
