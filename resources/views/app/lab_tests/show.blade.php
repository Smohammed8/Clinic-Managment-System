@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lab-tests.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lab_tests.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.test_name')</h5>
                    <span>{{ $labTest->test_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.test_desc')</h5>
                    <span>{{ $labTest->test_desc ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.lab_catagory_id')</h5>
                    <span
                        >{{ optional($labTest->labCatagory)->lab_name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.status')</h5>
                    <span>{{ $labTest->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.is_available')</h5>
                    <span>{{ $labTest->is_available?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_tests.inputs.price')</h5>
                    <span>{{ $labTest->price ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('lab-tests.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LabTest::class)
                <a href="{{ route('lab-tests.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
