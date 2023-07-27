@extends('layouts.app')

@section('content')
    <div class="">

        <div class="card">

            <div class="container mt-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Display the list of medical sick leaves -->
            </div>
            <div class="card-body">

                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Medical Sick Leave Letter</h4>
                </div>
                <div class="container mt-4">
                    <form action="{{ route('medical-sick-leaves.index') }}" method="GET" class="form-inline">
                        <div class="form-group col-6">
                            <input type="text" name="search" class="form-control col-12" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-primary ">
                            <i class="icon ion-md-search"></i></button>
                        <button type="button" class="btn btn-secondary" onclick="clearSearch()">
                            <i class="bi bi-x-circle"></i> Clear
                        </button>
                    </form>
                </div>
                <script>
                    function clearSearch() {
                        document.querySelector('input[name="search"]').value = '';
                        // Optionally, you can trigger the form submission after clearing the search
                        // document.querySelector('form').submit();
                        document.querySelector('form').submit();
                    }
                </script>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    Student Name
                                </th>
                                <th class="text-left">
                                    Start Date
                                </th>
                                <th class="text-left">
                                    End Date
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicalSickLeaves as $key => $medicalSickLeave)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ optional($medicalSickLeave?->student)?->first_name ?? '-' }}</td>
                                    <td>
                                        {{ optional($medicalSickLeave)?->start_date ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($medicalSickLeave)?->end_date ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            {{-- @can('update', $medicalSickLeave) --}}
                                            <a href="{{ route('medical-sick-leaves.edit', $medicalSickLeave) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </a>
                                            {{-- @endcan @can('view', $medicalSickLeave) --}}
                                            <a href="{{ route('medical-sick-leaves.show', $medicalSickLeave->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="icon ion-md-eye"></i> Show
                                                </button>
                                            </a>
                                            {{-- @endcan @can('delete', $medicalSickLeave) --}}
                                            <form action="{{ route('medical-sick-leaves.destroy', $medicalSickLeave) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                    <i class="icon ion-md-trash"></i> Delete
                                                </button>
                                            </form>
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
