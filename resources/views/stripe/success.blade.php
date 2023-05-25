@extends('layouts.app')

@section('title', __('stripe.success.title', ['name' => $customer->name]))

@section('content')
    <div class="flex flex-col gap-5">
        <div class="flex flex-col max-w-xl mx-auto items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-success-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <span class="text-2xl font-bold text-center">@lang('stripe.success.title', ['name' => $customer->name])</span>
            <span class="text-lg text-center text-gray-500 mt-3">@lang('stripe.success.description')</span>

            <div class="flex gap-3">
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">@lang('stripe.success.button')</a>
                @if(auth()->user())
                    <a href="{{ route('profile.orders') }}" class="btn btn-primary btn-outline mt-3">@lang('stripe.success.my_orders')</a>
                @endif
            </div>
        </div>

        <div class="flex flex-col p-5 rounded-xl bg-white mt-5 w-full md:w-2/3 md:mx-auto">
            <span class="text-2xl font-bold">@lang('globals.products.popular.title')</span>
            <span class="text-lg text-gray-500 mt-2">@lang('globals.products.popular.description')</span>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
                @foreach($popularProducts as $product)
                    <div class="card bg-base-200/80 shadow cursor-pointer card-compact" onclick="window.location.href = '{{ route('car.parts.show', [$product->category->model->car->slug, $product->category->model->slug, $product->category->slug, $product->id]) }}'">
                        <div class="card-body">
                            @if(\Carbon\Carbon::parse($product->createdAt)->diffInDays(now()) < 7)
                                <div class="absolute -top-2 left-0">
                                    <span class="badge badge-sm badge-primary font-semibold">@lang('globals.products.new')</span>
                                </div>
                            @endif

                            <div class="flex flex-col w-full">
                                <div class="flex flex-row w-full md:gap-3 md:flex-col flex-1">
                                    <div class="aspect-square flex justify-center items-center max-w-[150px] md:max-w-full">
                                        <img data-src="{{ asset('images/parts/' . $product->category->model->car->slug . '/' . $product->image) }}" alt="{{ $product->name }}"
                                             class="rounded-xl lazy-image">
                                    </div>

                                    <div class="flex justify-center flex-col ml-3 pl-3 border-l border-l-gray-300 md:border-l-0 md:ml-0 md:pl-0 md:justify-between">
                                        <span class="text-xl">{{ $product->category->model->car->name }} <span class="font-bold">{{ $product->category->model->name }}</span></span>
                                        <span class="font-bold text-lg">{{ money($product->price, 'EUR', true)->format() }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2 mt-4 flex-none">
                                    <a class="badge badge-secondary text-xs font-semibold bg-base-300 border-none transition-colors duration-250 hover:bg-primary-focus"  href="{{ route('car.parts.byCategory', [$product->category->model->car->slug, $product->category->model->slug, $product->category->slug ]) }}">{{ $product->category->{app()->getLocale() . "Name"} }}</a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-primary flex flex-nowrap items-center gap-1 w-full">
                                            @lang('cart.add')
                                        </button>
                                    </form>
                                </div>

                                <span class="text-xs text-gray-500 mt-2 text-center hidden md:block">@lang('globals.products.popular.clickNotify')</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
