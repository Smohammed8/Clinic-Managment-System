@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- app/resources/views/app/students/index.blade.php -->

                    <!-- app/resources/views/app/students/index.blade.php -->

                    <!-- app/resources/views/app/students/index.blade.php -->

                    @if ($searchError)
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ $searchError }}
                        </div>
                    @endif

                    <!-- Rest of your view content -->

                    <!-- Rest of your view content -->

                    <!-- Rest of your view content -->

                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" required />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Student::class)
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.students.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.students.inputs.first_name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.students.inputs.middle_name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.students.inputs.last_name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.students.inputs.sex')
                                </th>

                                <th class="text-left">
                                    @lang('crud.students.inputs.id_number')
                                </th>
                                <th class="text-left">
                                    @lang('crud.students.inputs.encounter_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($search)
                                @forelse($students as $key => $student)
                                    <tr>

                                        <td> {{ $key + 1 }}
                                        <td>{{ $student->first_name ?? '-' }}</td>
                                        <td>{{ $student->middle_name ?? '-' }}</td>
                                        <td>{{ $student->last_name ?? '-' }}</td>
                                        <td>{{ $student->sex ?? '-' }}</td>

                                        <td>{{ $student->id_number ?? '-' }}</td>
                                        <td>
                                            {{ optional($student->encounter->first())->id ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <div role="group" aria-label="Row Actions" class="btn-group">
                                                @can('update', $student)
                                                    <a href="{{ route('students.edit', $student) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                    </a>
                                                    @endcan @can('view', $student)
                                                    <a href="{{ route('students.show', $student) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="icon ion-md-eye"></i> Show
                                                        </button>
                                                    </a>
                                                    @endcan @can('delete', $student)
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                            <i class="icon ion-md-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endif
                                <tr>
                                    <td colspan="8">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            @if ($search)
                                <tr>
                                    <td colspan="8">{!! $students->render() !!}</td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
