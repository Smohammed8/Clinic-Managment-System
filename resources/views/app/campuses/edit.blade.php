@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('campuses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.campuses.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('campuses.update', $campus) }}"
                class="mt-4"
            >
                @include('app.campuses.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('campuses.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('campuses.create') }}"
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

    @can('view-any', App\Models\Clinic::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Clinics</h4>

            <livewire:campus-clinics-detail :campus="$campus" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Collage::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Collages</h4>

            <livewire:campus-collages-detail :campus="$campus" />
        </div>
    </div>
    @endcan
</div>
@endsection
