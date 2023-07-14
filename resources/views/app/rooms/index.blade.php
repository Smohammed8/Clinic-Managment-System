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
                    @can('create', App\Models\Room::class)
                        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.rooms.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.is_active')
                                </th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.clinic_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.rooms.inputs.encounter_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms as $key => $room)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $room->name ?? '-' }}</td>
                                    <td>{{ $room->description ?? '-' }}</td>
                                    <td>{{ $room->status ?? '-' }}</td>
                                    <td>{{ $room->is_active ?? '-' }}</td>
                                    <td>{{ optional($room->clinic)->name ?? '-' }}</td>
                                    <td>{{ optional($room->encounter)->id ?? '-' }}</td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $room)
                                                <a href="{{ route('rooms.edit', $room) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan @can('view', $room)
                                                <a href="{{ route('rooms.show', $room) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i> Show
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $room)
                                                <form action="{{ route('rooms.destroy', $room) }}" method="POST"
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
                                <tr>
                                    <td colspan="7">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">{!! $rooms->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
