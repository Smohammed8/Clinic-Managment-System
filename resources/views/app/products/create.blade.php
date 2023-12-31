@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('products.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                {{-- @lang('crud.products.create_title') --}}
                Create Product for {{$store->name}} Store
            </h4>

            <x-form
                method="POST"
                action="{{ route('products.store',['id'=>$store->id]) }}"
                class="mt-4"
            >
                @include('app.products.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
