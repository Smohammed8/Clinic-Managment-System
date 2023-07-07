@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('rooms.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.rooms.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('rooms.update', $room) }}"
                class="mt-4"
            >
                @include('app.rooms.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('rooms.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a href="{{ route('rooms.create') }}" class="btn btn-light">
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

    @can('view-any', App\Models\clinic_user_room::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Clinic Users</h4>

            <livewire:room-clinic-users-detail :room="$room" />
        </div>
    </div>
    @endcan
</div>
@endsection
