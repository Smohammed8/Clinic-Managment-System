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
                    @can('create', App\Models\Collage::class)
                        <a href="{{ route('collages.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.collages.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.collages.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.collages.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.collages.inputs.campus_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($collages  as $key =>  $collage)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $collage->name ?? '-' }}</td>
                                    <td>{{ $collage->description ?? '-' }}</td>
                                    <td>
                                        {{ optional($collage->campus)->name ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $collage)
                                                <a href="{{ route('collages.edit', $collage) }}">
                                                      <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $collage)
                                                <a href="{{ route('collages.show', $collage) }}">
                                                      <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $collage)
                                                <form action="{{ route('collages.destroy', $collage) }}" method="POST"
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
                                <td colspan="4">{!! $collages->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
