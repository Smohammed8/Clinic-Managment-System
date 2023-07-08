@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\MainDiagnosis::class)
                        <a href="{{ route('main-diagnoses.create') }}" class="btn btn-primary">
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
                        @lang('crud.main_diagnoses.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.main_diagnoses.inputs.clinic_user_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.main_diagnoses.inputs.student_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.main_diagnoses.inputs.encounter_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.main_diagnoses.inputs.diagnosis_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mainDiagnoses  as $key =>  $mainDiagnosis)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>
                                        {{ optional($mainDiagnosis->Doctor)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($mainDiagnosis->student)->first_name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($mainDiagnosis->encounter)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($mainDiagnosis->diagnosis)->name ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $mainDiagnosis)
                                                <a href="{{ route('main-diagnoses.edit', $mainDiagnosis) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $mainDiagnosis)
                                                <a href="{{ route('main-diagnoses.show', $mainDiagnosis) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $mainDiagnosis)
                                                <form action="{{ route('main-diagnoses.destroy', $mainDiagnosis) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {!! $mainDiagnoses->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
