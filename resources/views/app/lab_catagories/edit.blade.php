@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lab-catagories.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lab_catagories.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('lab-catagories.update', $labCatagory) }}"
                class="mt-4"
            >
                @include('app.lab_catagories.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('lab-catagories.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('lab-catagories.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
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
