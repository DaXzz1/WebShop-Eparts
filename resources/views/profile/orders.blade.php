@extends('layouts.app')

@section('title', __('pages.my_orders.title'))
@section('breadcrumbs', Breadcrumbs::render('profile.orders'))

@section('content')
    <div class="p-4 rounded-xl bg-white flex flex-col">
        @if($orders->count() > 0)
            <span class="text-2xl font-bold">@lang('pages.my_orders.content.title')</span>
            <span class="text-lg text-gray-500 mt-2">@lang('pages.my_orders.content.description')</span>

            <div class="mt-5 relative z-[1]">
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th class="!static">ID</th>
                        <th>@lang('pages.my_orders.content.table.bought_at')</th>
                        <th class="hidden md:table-cell">@lang('pages.my_orders.content.table.status')</th>
                        <th>@lang('pages.my_orders.content.table.amount')</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <span class="font-bold">{{ $order->id }}</span>
                            </td>
                            <td class="w-full">
                            <span>{{ Carbon\Carbon::parse($order->boughtAt)->format('d.m.Y H:i') }}
                            <span
                                class="font-semibold hidden sm:table-cell">({{ Carbon\Carbon::parse($order->boughtAt)->isoFormat('dddd') }})</span></span>
                            </td>
                            <td class="hidden md:table-cell">
                                @if($order->status === "paid")
                                    <span
                                        class="badge badge-success font-semibold">@lang('pages.my_orders.content.table.statuses.paid')</span>
                                @else
                                    <span
                                        class="badge badge-error font-semibold">@lang('pages.my_orders.content.table.statuses.unpaid')</span>
                            @endif
                            <td>
                                <span class="font-bold">{{ money($order->amount, 'EUR') }}</span>
                            </td>
                            <td class="md:min-w-[180px]">
                                <div class="dropdown dropdown-bottom dropdown-end">
                                    <label tabindex="0" class="btn btn-sm btn-primary m-1 flex gap-2 flex-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                        </svg>

                                        <span
                                            class="hidden md:flex">@lang('pages.my_orders.content.table.actions.title')</span>
                                    </label>
                                    <ul tabindex="0"
                                        class="dropdown-content menu menu-compact p-2 shadow-xl bg-base-100 rounded-box w-52">
                                        <li>
                                            <label for="orderDetails?id={{ $order->id }}"
                                                   class="flex gap-2 font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>

                                                @lang('pages.my_orders.content.table.actions.view')
                                            </label>
                                        </li>
                                        <li>
                                            <label for="deleteOrder?id={{ $order->id }}"
                                                   class="flex gap-2 font-medium text-error active:bg-error active:text-[#333333]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>

                                                @lang('pages.my_orders.content.table.actions.delete')
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        @section('modals')
                            @parent

                            <input type="checkbox" id="orderDetails?id={{ $order->id }}" class="modal-toggle"/>
                            <div class="modal modal-bottom sm:modal-middle fixed z-[100]">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">@lang('pages.my_orders.content.modal.title', ['order_number' => $order->id])</h3>

                                    <div class="overflow-y-auto max-h-[500px] mt-4">
                                        <div class="flex flex-col h-full mx-2">
                                            @foreach($order->parts as $product)
                                                <div class="flex gap-3 transition-colors duration-250 hover:bg-base-300/70 p-2 cursor-pointer" onclick="window.location.href = '{{ route('car.parts.show', [$product->part->category->model->car->slug, $product->part->category->model->slug, $product->part->category->slug, $product->part->id, $product->part->modification ?? null]) }}'">
                                                    <div class="flex gap-3 items-center w-full rounded">
                                                        <div
                                                            class="aspect-square max-w-[65px] flex items-center justify-center">
                                                            <img
                                                                class="lazy-image"
                                                                data-src="{{ asset('images/parts/' . $product->part->category->model->car->slug . '/' . $product->part->image) }}"
                                                                alt="{{ $product->part->{app()->getLocale() . 'Name'} }}">
                                                        </div>

                                                        <div class="flex flex-col w-2/3 truncate">
                                                        <span
                                                            class="font-semibold truncate">{{ $product->part->{app()->getLocale() . 'Name'} }}</span>
                                                            <span
                                                                class="text-gray-500 text-sm">#{{ $product->part->code }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                    <span class="font-semibold flex gap-1">{{ money($product->part->price, 'EUR', true) }}
                                                        <span class="text-gray-500 text-sm">(x{{ $product->quantity }})</span>
                                                    </span>

                                                        <span
                                                            class="text-gray-500 text-sm text-right">{{ money($product->part->price * $product->quantity, 'EUR', true) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="modal-action">
                                        <label for="orderDetails?id={{ $order->id }}" class="btn btn-primary">
                                            @lang('pages.my_orders.content.modal.close')
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <input type="checkbox" id="deleteOrder?id={{ $order->id }}" class="modal-toggle"/>
                            <div class="modal modal-bottom sm:modal-middle fixed z-[100]">
                                <div class="modal-box">
                                    <div class="overflow-y-auto max-h-[500px]">
                                        <div class="h-full mx-2">
                                            <div class="flex flex-col items-center gap-3 my-2">
                                                <div class="p-4 rounded-full bg-error/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="2"
                                                         stroke="currentColor" class="w-6 h-6 text-error">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </div>

                                                <div class="flex flex-col justify-center items-center mt-1">
                                            <span
                                                class="text-2xl font-bold">@lang('pages.my_orders.content.modal.delete.title', ['order_number' => $order->id])</span>
                                                    <span
                                                        class="text-lg text-gray-500 font-medium">@lang('pages.my_orders.content.modal.delete.description', ['order_number' => $order->id])</span>
                                                </div>

                                                <form action="{{ route('profile.order.delete', $order->id) }}"
                                                      method="POST">
                                                    @csrf

                                                    <div class="modal-action mt-0">
                                                        <button type="submit" class="btn btn-error">
                                                            @lang('pages.my_orders.content.modal.delete.actions.confirm')
                                                        </button>
                                                        <label for="deleteOrder?id={{ $order->id }}"
                                                               class="btn btn-primary">
                                                            @lang('pages.my_orders.content.modal.delete.actions.cancel')
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endsection
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th class="!static">ID</th>
                        <th>@lang('pages.my_orders.content.table.bought_at')</th>
                        <th class="hidden md:table-cell">@lang('pages.my_orders.content.table.status')</th>
                        <th>@lang('pages.my_orders.content.table.amount')</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="mt-5">
                    {{ $orders->links() }}
                </div>
            @endif

            <div class="flex mt-3 justify-end items-center mt-4">
                <label for="deleteAllOrdersModal" class="btn btn-error">
                    @lang('pages.my_orders.content.delete_all')
                </label>
            </div>
        @else
            <div class="flex flex-col items-center gap-3 my-5">
                <div class="p-4 rounded-full bg-secondary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-6 h-6 text-primary-focus">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="flex flex-col justify-center items-center mt-1">
                    <span class="text-2xl font-bold">@lang('pages.my_orders.content.empty.title')</span>
                    <span
                        class="text-lg text-gray-500 font-medium">@lang('pages.my_orders.content.empty.description', ['url' => route('home')])</span>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modals')
    @parent
    <input type="checkbox" id="deleteAllOrdersModal" class="modal-toggle"/>
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
                            <span
                                class="text-2xl font-bold">@lang('pages.my_orders.content.modal.delete_all.title')</span>
                            <span
                                class="text-lg text-gray-500 font-medium">@lang('pages.my_orders.content.modal.delete_all.description')</span>
                        </div>

                        <form action="{{ route('profile.orders.deleteAll') }}" method="POST">
                            @csrf

                            <div class="modal-action mt-0">
                                <button type="submit" class="btn btn-error">
                                    @lang('pages.my_orders.content.modal.delete_all.actions.confirm')
                                </button>
                                <label for="deleteAllOrdersModal" class="btn btn-primary">
                                    @lang('pages.my_orders.content.modal.delete_all.actions.cancel')
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
