@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('diagnoses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.diagnoses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.diagnoses.inputs.name')</h5>
                    <span>{{ $diagnosis->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.diagnoses.inputs.desc')</h5>
                    <span>{{ $diagnosis->desc ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('diagnoses.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Diagnosis::class)
                <a href="{{ route('diagnoses.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\MainDiagnosis::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>

            <livewire:diagnosis-main-diagnoses-detail :diagnosis="$diagnosis" />
        </div>
    </div>
    @endcan
</div>
@endsection
