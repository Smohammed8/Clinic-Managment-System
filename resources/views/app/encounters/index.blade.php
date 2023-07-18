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
                                    <i class="icon io-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Encounter::class)
                        <a href="{{ route('encounters.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.encounters.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.check_in_time') --}}
                                    MRN
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.student_id') --}}
                                    ID
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.status') --}}
                                    Patient Name
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.closed_at') --}}
                                    Age
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.priority') --}}
                                    Gender
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.clinic_id') --}}
                                    Date of visit
                                </th>

                                <th class="text-left">
                                    Status
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($encounters  as $key =>  $encounter)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $encounter->student->id_number ?? '-' }}</td>
                                    <td>{{ $encounter->student->id_number ?? '-' }}</td>
                                    <td>{{ $encounter->student->fullName ?? '-' }}</td>
                                    <td>{{ $encounter->priority ?? '-' }}</td>
                                    <td>{{ optional($encounter->student)->sex ?? '-' }}</td>
                                    <td>{{ $encounter->check_in_time ?? '-' }}</td>
                                    <td>  {{-- {{ $encounter->status ?? '-' }} --}}   Ongoing  </td>
                                        
                                     
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">

                                            @can('view', $encounter)
                                                <a href="{{ route('encounters.show', $encounter) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon fa fa-user"></i> Profile
                                                    </button>
                                                </a>
                                            @endcan

                                            {{-- @can('update', $encounter) --}}
                                            <a href="{{ route('encounters.edit', $encounter) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="fa fa-print"></i> Sick Leave
                                                </button>
                                            </a>
                                            {{-- @endcan  --}}

                                            @can('update', $encounter)
                                                <a href="{{ route('encounters.edit', $encounter) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete', $encounter)
                                                <form data-route="{{ route('encounters.destroy', $encounter) }}" method="POST"
                                                    id="deletebtnid">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">{!! $encounters->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{-- <script>
            swal(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
        </script> --}}
    </div>
@endsection
