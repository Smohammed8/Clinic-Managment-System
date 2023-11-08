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
                    @can('create', App\Models\LabTest::class)
                        <a href="{{ route('lab-tests.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.lab_tests.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover  table-sm table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.lab_tests.inputs.test_name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_tests.inputs.test_desc')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_tests.inputs.lab_catagory_id')
                                </th>
                                {{-- <th class="text-left">
                                    @lang('crud.lab_tests.inputs.status')
                                </th> --}}
                                <th class="text-left">
                              Status
                                </th>
                                <th class="text-right">
                                    @lang('crud.lab_tests.inputs.price')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($labTests  as $key =>  $labTest)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $labTest->test_name ?? '-' }}</td>
                                    <td>{{ $labTest->test_desc ?? '-' }}</td>
                                    <td>
                                        {{ optional($labTest->labCatagory)->lab_name ?? '-' }}
                                    </td>
                                    {{-- <td>{{ $labTest->status ?? '-' }}</td> --}}
                                    <td>
                                        
                                    
                                        @if ($labTest->is_available == true)
                                        <span class="badge badge-success"> Avaliable</span>
                                        @else
                                            <span class="badge badge-danger">Not avaliable</span>
                                        @endif

                                    
                                    </td>
                                    <td>{{ $labTest->price ?? '-' }}</td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $labTest)
                                                <a href="{{ route('lab-tests.edit', $labTest) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan @can('view', $labTest)
                                                <a href="{{ route('lab-tests.show', $labTest) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i> Show
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $labTest)
                                                <form action="{{ route('lab-tests.destroy', $labTest) }}" method="POST"
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
                                <td colspan="7">{!! $labTests->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
