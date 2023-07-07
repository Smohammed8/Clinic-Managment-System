@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lab-catagories.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lab_catagories.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lab_catagories.inputs.lab_name')</h5>
                    <span>{{ $labCatagory->lab_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_catagories.inputs.lab_desc')</h5>
                    <span>{{ $labCatagory->lab_desc ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('lab-catagories.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LabCatagory::class)
                <a
                    href="{{ route('lab-catagories.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\LabTest::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Lab Tests</h4>

            <livewire:lab-catagory-lab-tests-detail
                :labCatagory="$labCatagory"
            />
        </div>
    </div>
    @endcan @can('view-any', App\Models\LabTestRequest::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Lab Test Requests</h4>

            <livewire:lab-catagory-lab-test-requests-detail
                :labCatagory="$labCatagory"
            />
        </div>
    </div>
    @endcan
</div>
@endsection
