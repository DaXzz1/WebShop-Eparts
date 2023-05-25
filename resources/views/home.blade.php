@extends('layouts.app')

@section('title', __('pages.home.title'))
@section('breadcrumbs', Breadcrumbs::render('home'))

@section('content')
    <div class="rounded-xl p-4 bg-white flex flex-col">
        <span class="text-2xl font-bold">@lang('pages.home.content.title')</span>
        <span class="text-lg">@lang('pages.home.content.description')</span>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-4 mt-5">
            @foreach($cars as $car)
                <a class="flex h-20 w-48 gap-3 p-2 items-center transition-colors duration-250 rounded hover:bg-base-300" href="{{ route('car.models', $car->slug) }}">
                   <img class="w-14 h-14 object-scale-down lazy-image" alt="{{ $car->slug }}" data-src="{{ asset('images/cars/icons/' . $car->image) }}" src="Error.src">

                    <span class="text-lg font-semibold">{{ $car->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
