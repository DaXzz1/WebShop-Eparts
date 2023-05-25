@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('title', __('pages.cart.title'))
@section('breadcrumbs', Breadcrumbs::render('cart.index'))

@section('content')
    @if(count($cart) > 0)
        <div class="p-4 rounded-xl shadow-xl bg-white flex flex-col">
            <span class="text-2xl font-bold">@lang('pages.cart.content.title')</span>
            <span class="text-lg text-gray-500">@lang('pages.cart.content.description')</span>

            <div class="overflow-x-auto w-full mt-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="!static">@lang('cart.table.name')</th>
                        <th>@lang('cart.table.price')</th>
                        <th>@lang('cart.table.count')</th>
                        <th>@lang('cart.table.total')</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td class="w-1/2">
                                <div class="flex items-center space-x-3">
                                    <div class="avatar">
                                        <div class="w-16 h-16">
                                            <img
                                                class="lazy-image"
                                                data-src="{{ asset('images/parts/' . $item->category->model->car->slug . '/' . $item->image) }}"
                                                alt="{{ $item->name }}"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $item->name }}</div>
                                        <div class="text-sm opacity-50">#{{ $item->code }}</div>
                                        <span
                                            class="badge badge-ghost badge-sm">{{ $item->category->{app()->getLocale() . 'Name'} }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-[200px]">
                                <div class="font-bold">{{ money($item->price, 'EUR', true)->format() }}</div>
                            </td>
                            <th class="min-w-[200px]">
                                <div class="flex gap-2 relative">
                                    <form action="{{ route('cart.increment', $item->id) }}" method="POST"
                                          class="my-auto">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-outline btn-primary btn-sm rounded-full">
                                            +
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.count.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="count" placeholder="Type here"
                                               class="input input-bordered input-primary input-sm w-full max-w-xs"
                                               max="{{ $item->quantity }}" min="1"
                                               value="{{ $item->count }}"/>
                                        <span
                                            class="badge badge-primary badge-sm bg-transparent border-none opacity-75 absolute top-full left-1/2 translate-y-1 -translate-x-1/2 select-none">@lang('cart.inputs.enter_key')</span>
                                    </form>

                                    <form action="{{ route('cart.decrement', $item->id) }}" method="POST"
                                          class="my-auto">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-outline btn-primary btn-sm rounded-full">
                                            -
                                        </button>
                                    </form>
                                </div>
                            </th>
                            <td class="w-[200px]">
                                <div
                                    class="font-bold">{{ money($item->price * $item->count, 'EUR', true)->format() }}</div>
                            </td>
                            <td class="w-[150px]">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline btn-error flex flex-nowrap gap-1 w-full items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        @lang('globals.delete')
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="!static">@lang('cart.table.name')</th>
                        <th>@lang('cart.table.price')</th>
                        <th>@lang('cart.table.count')</th>
                        <th>@lang('cart.table.total')</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex justify-end items-center mt-4">
                <label for="cartClearConfirmation"
                       class="btn btn-error btn-outline w-full md:w-auto">@lang('cart.clear')</label>
            </div>
        </div>

        <div class="mt-5 ml-auto flex justify-end">
            <div class="card w-full bg-base-100 shadow-xl md:w-96">
                <div class="card-body">
                    <h2 class="card-title">@lang('cart.totals.title')</h2>
                    <div class="flex justify-between">
                        <span>@lang('cart.totals.subtotal.title'):</span>
                        <div class="relative flex">
                            <span class="font-bold">{{ money($totalPrice, 'EUR', true)->format() }}</span>
                            <span
                                class="badge badge-ghost badge-sm bg-transparent border-none opacity-75 absolute top-full right-0 whitespace-nowrap p-0 select-none">@lang('cart.totals.subtotal.taxes')</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-4">
                        <span>@lang('cart.totals.shipping.title'):</span>
                        <span class="font-bold text-sm">@lang('cart.totals.shipping.upon')</span>
                    </div>

                    <div class="flex justify-between pt-2 border-t border-r-primary">
                        <span>@lang('cart.totals.total'):</span>
                        <span class="font-bold">{{ money($totalPrice, 'EUR', true)->format() }}</span>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('stripe.checkout') }}"
                           class="btn btn-primary w-full">@lang('cart.totals.checkout')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col gap-5">
            <div class="flex flex-col max-w-xl mx-auto items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-32 h-32 text-error">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>

                <span class="text-4xl font-bold">@lang('cart.empty.title')</span>
                <span class="text-xl text-center text-gray-500 mt-5">@lang('cart.empty.description')</span>

                <a href="{{ route('home') }}" class="btn btn-primary mt-5">@lang('cart.empty.atHome')</a>
            </div>

            <div class="flex flex-col p-5 rounded-xl bg-white mt-5 w-full lg:w-2/3 mx-auto">
                <span class="text-2xl font-bold">@lang('cart.empty.popular.title')</span>
                <span class="text-lg text-gray-500">@lang('cart.empty.popular.description')</span>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
                    @if(count($popularProducts) > 0)
                        @foreach($popularProducts as $product)
                            <div class="card bg-base-200/80 shadow cursor-pointer card-compact"
                                 onclick="window.location.href = '{{ route('car.parts.show', [$product->category->model->car->slug, $product->category->model->slug, $product->category->slug, $product->id]) }}'">
                                <div class="card-body">
                                    @if(Carbon::parse($product->createdAt)->diffInDays(now()) < 7)
                                        <div class="absolute -top-2 left-0">
                                        <span
                                            class="badge badge-sm badge-primary font-semibold">@lang('globals.products.new')</span>
                                        </div>
                                    @endif

                                    <div class="flex flex-col w-full">
                                        <div class="flex flex-row w-full md:gap-3 md:flex-col flex-1">
                                            <div
                                                class="aspect-square flex justify-center items-center max-w-[150px] md:max-w-full">
                                                <img
                                                    data-src="{{ asset('images/parts/' . $product->category->model->car->slug . '/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="rounded-xl lazy-image">
                                            </div>

                                            <div
                                                class="flex justify-center flex-col ml-3 pl-3 border-l border-l-gray-300 md:border-l-0 md:ml-0 md:pl-0 md:justify-between">
                                            <span class="text-xl">{{ $product->category->model->car->name }} <span
                                                    class="font-bold">{{ $product->category->model->name }}</span></span>
                                                <span
                                                    class="font-bold text-lg">{{ money($product->price, 'EUR', true)->format() }}</span>
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-2 mt-4 flex-none">
                                            <a class="badge badge-secondary text-xs font-semibold bg-base-300 border-none transition-colors duration-250 hover:bg-primary-focus"
                                               href="{{ route('car.parts.byCategory', [$product->category->model->car->slug, $product->category->model->slug, $product->category->slug ]) }}">{{ $product->category->{app()->getLocale() . "Name"} }}</a>

                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-sm btn-primary flex flex-nowrap items-center gap-1 w-full">
                                                    @lang('cart.add')
                                                </button>
                                            </form>
                                        </div>

                                        <span
                                            class="text-xs text-gray-500 mt-2 text-center hidden md:block">@lang('globals.products.popular.clickNotify')</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-5 my-5 flex flex-col gap-3 w-full">
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-4 rounded-full bg-secondary/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary-focus">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </div>

                                <div class="flex flex-col justify-center items-center mt-1">
                                    <span class="text-2xl font-bold">@lang('cart.empty.popular.content.title')</span>
                                    <span class="text-lg text-gray-500 font-medium">@lang('cart.empty.popular.content.description')</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@section('modals')
    <input type="checkbox" id="cartClearConfirmation" class="modal-toggle"/>
    <div class="modal modal-bottom sm:modal-middle fixed z-[100]">
        <div class="modal-box">
            <div class="overflow-y-auto max-h-[500px]">
                <div class="h-full mx-2">
                    <div class="flex flex-col items-center gap-3 my-2">
                        <div class="p-4 rounded-full bg-error/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" class="w-6 h-6 text-error">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>

                        <div class="flex flex-col justify-center items-center mt-1">
                            <span class="text-2xl font-bold">@lang('pages.cart.content.modal.clear.title')</span>
                            <span
                                class="text-lg text-gray-500 font-medium text-center">@lang('pages.cart.content.modal.clear.description')</span>
                        </div>

                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf

                            <div class="modal-action mt-0">
                                <button type="submit" class="btn btn-error">
                                    @lang('pages.cart.content.modal.clear.actions.confirm')
                                </button>
                                <label for="cartClearConfirmation" class="btn btn-primary">
                                    @lang('pages.cart.content.modal.clear.actions.cancel')
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
