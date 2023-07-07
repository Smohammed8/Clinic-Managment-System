@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\VitalSign::class)
                <a
                    href="{{ route('vital-signs.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.vital_signs.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.temp')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.blood_pressure ')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.pulse_rate')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.rr')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.weight')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.height')
                            </th>
                            <th class="text-right">
                                @lang('crud.vital_signs.inputs.muac')
                            </th>
                            <th class="text-left">
                                @lang('crud.vital_signs.inputs.encounter_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.vital_signs.inputs.clinic_user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.vital_signs.inputs.student_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vitalSigns as $vitalSign)
                        <tr>
                            <td>{{ $vitalSign->temp ?? '-' }}</td>
                            <td>{{ $vitalSign->blood_pressure ?? '-' }}</td>
                            <td>{{ $vitalSign->pulse_rate ?? '-' }}</td>
                            <td>{{ $vitalSign->rr ?? '-' }}</td>
                            <td>{{ $vitalSign->weight ?? '-' }}</td>
                            <td>{{ $vitalSign->height ?? '-' }}</td>
                            <td>{{ $vitalSign->muac ?? '-' }}</td>
                            <td>
                                {{ optional($vitalSign->encounter)->id ?? '-' }}
                            </td>
                            <td>
                                {{ optional($vitalSign->Doctor)->id ?? '-' }}
                            </td>
                            <td>
                                {{ optional($vitalSign->student)->first_name ??
                                '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $vitalSign)
                                    <a
                                        href="{{ route('vital-signs.edit', $vitalSign) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $vitalSign)
                                    <a
                                        href="{{ route('vital-signs.show', $vitalSign) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $vitalSign)
                                    <form
                                        action="{{ route('vital-signs.destroy', $vitalSign) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11">{!! $vitalSigns->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
