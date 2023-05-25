@extends('layouts.app')

@section('title', __('pages.stripe.title'))
@section('breadcrumbs', Breadcrumbs::render('stripe.index'))

@section('content')
    <form method="POST" id="deleteFromCartForm">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ route('stripe.checkout') }}" method="POST" id="stripeForm">
        @csrf

        <div class="flex gap-5 flex-col lg:flex-row">
            <div class="w-full flex flex-col gap-2 p-5 rounded-xl bg-white">
                <div class="flex flex-col gap-2">
                    <span class="font-bold text-xl">@lang('stripe.form.required_info.title')</span>
                    <span class="text-gray-500">@lang('stripe.form.required_info.description')</span>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="flex gap-10 justify-between">
                        <div class="form-control w-full">
                            <label class="label">
                            <span
                                class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.firstname.label')</span>
                            </label>
                            <input type="text" name="firstName"
                                   placeholder="@lang('stripe.form.required_info.inputs.firstname.placeholder')"
                                   class="input input-bordered input-primary w-full font-medium {{ $errors->has('firstName') ? 'input-error' : '' }}"
                                   value="{{ old('firstName', auth()->user()->firstName ?? null)  }}"/>
                            <span class="text-red-500 text-sm">{{ $errors->first('firstName') }}</span>
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                            <span
                                class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.lastname.label')</span>
                            </label>
                            <input type="text" name="lastName"
                                   placeholder="@lang('stripe.form.required_info.inputs.lastname.placeholder')"
                                   class="input input-bordered input-primary w-full font-medium {{ $errors->has('lastName') ? 'input-error' : '' }}"
                                   value="{{ old('lastName', auth()->user()->lastName ?? null) }}"/>
                            <span class="text-red-500 text-sm">{{ $errors->first('lastName') }}</span>
                        </div>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                        <span
                            class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.email.label')</span>
                        </label>
                        <input type="text" name="email"
                               placeholder="@lang('stripe.form.required_info.inputs.email.placeholder')"
                               class="input input-bordered input-primary w-full font-medium {{ $errors->has('email') ? 'input-error' : '' }}"
                               value="{{ old('email', auth()->user()->email ?? null) }}"/>
                        <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                        <span
                            class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.phone.label')</span>
                        </label>
                        <input type="text" name="phone"
                               placeholder="@lang('stripe.form.required_info.inputs.phone.placeholder')"
                               class="input input-bordered input-primary w-full font-medium {{ $errors->has('phone') ? 'input-error' : '' }}"
                               value="{{ old('phone', auth()->user()->phone ?? null) }}"/>
                        <span class="text-red-500 text-sm">{{ $errors->first('phone') }}</span>
                    </div>

                    <div class="flex flex-col border-t border-t-primary mt-2">
                        <span
                            class="text-lg font-semibold mt-3">@lang('stripe.form.required_info.shipping_address')</span>

                        <div class="flex flex-col gap-3">
                            <div class="flex justify-between gap-10">
                                <div class="form-control w-full">
                                    <label class="label">
                                    <span
                                        class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.country.label')</span>
                                    </label>
                                    <select name="country"
                                            class="input input-bordered input-primary w-full font-medium"
                                            required>
                                        <option hidden>@lang('stripe.form.required_info.inputs.country.placeholder')</option>
                                        @foreach(config('stripe.available_countries') as $code)
                                            <option value="{{ $code }}"
                                                {{ old('country', auth()->user()->country ?? null) === strtolower($code) ? 'selected' : '' }}>@lang('countries.' . $code)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                    <span
                                        class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.state.label')</span>
                                    </label>
                                    <input type="text" name="state"
                                           placeholder="@lang('stripe.form.required_info.inputs.state.placeholder')"
                                           class="input input-bordered input-primary w-full font-medium {{ $errors->has('state') ? 'input-error' : '' }}"
                                           value="{{ old('state', auth()->user()->state ?? null) }}"/>
                                    <span class="text-red-500 text-sm">{{ $errors->first('state') }}</span>
                                </div>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.city.label')</span>
                                </label>
                                <input type="text" name="city"
                                       placeholder="@lang('stripe.form.required_info.inputs.city.placeholder')"
                                       class="input input-bordered input-primary w-full font-medium {{ $errors->has('city') ? 'input-error' : '' }}"
                                       value="{{ old('city', auth()->user()->city ?? null) }}"/>
                                <span class="text-red-500 text-sm">{{ $errors->first('city') }}</span>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                <span
                                    class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.address.label')</span>
                                </label>
                                <input type="text" name="address"
                                       placeholder="@lang('stripe.form.required_info.inputs.address.placeholder')"
                                       class="input input-bordered input-primary w-full font-medium {{ $errors->has('address') ? 'input-error' : '' }}"
                                       value="{{ old('address', auth()->user()->address ?? null) }}"/>
                                <span class="text-red-500 text-sm">{{ $errors->first('address') }}</span>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                <span
                                    class="label-text font-semibold">@lang('stripe.form.required_info.inputs.address_2.label')</span>
                                </label>
                                <input type="text" name="address2"
                                       placeholder="@lang('stripe.form.required_info.inputs.address_2.placeholder')"
                                       class="input input-bordered input-primary w-full font-medium {{ $errors->has('address2') ? 'input-error' : '' }}"
                                       value="{{ old('address2', auth()->user()->address2 ?? null) }}"/>
                                <span class="text-red-500 text-sm">{{ $errors->first('address2') }}</span>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                <span
                                    class="label-text font-semibold required">@lang('stripe.form.required_info.inputs.zip.label')</span>
                                </label>
                                <input type="text" name="zipCode"
                                       placeholder="@lang('stripe.form.required_info.inputs.zip.placeholder')"
                                       class="input input-bordered input-primary w-full font-medium {{ $errors->has('zipCode') ? 'input-error' : '' }}"
                                       value="{{ old('zipCode', auth()->user()->zipCode ?? null) }}"/>
                                <span class="text-red-500 text-sm">{{ $errors->first('zipCode') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 mt-5 pt-5 border-t border-t-primary">
                    <span class="font-bold text-xl">@lang('stripe.form.optional_info.title')</span>
                    <span class="text-gray-500">@lang('stripe.form.optional_info.description')</span>

                    <div class="form-control w-full">
                        <label class="label">
                        <span
                            class="label-text font-semibold">@lang('stripe.form.optional_info.inputs.notes.label')</span>
                        </label>
                        <textarea class="textarea textarea-bordered textarea-primary font-medium h-24"
                                  placeholder="@lang('stripe.form.optional_info.inputs.notes.placeholder')"></textarea>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3">
                <div class="flex flex-col bg-white rounded-xl p-5 gap-5">
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">@lang('stripe.order.list.title')</span>
                        <span class="text-gray-500">@lang('stripe.order.list.description')</span>
                    </div>

                    <div class="flex flex-col">
                        <table class="table w-full table-compact">
                            <thead>
                            <tr>
                                <th class="w-1/2">@lang('stripe.order.list.table.product')</th>
                                <th>@lang('stripe.order.list.table.total')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(array_slice($cart, 0, 5) as $item)
                                <tr>
                                    <td>
                                        <div class="flex gap-3 items-center w-full rounded">
                                            <div class="aspect-square w-16 h-16 flex items-center justify-center">
                                                <img
                                                    data-src="{{ asset('images/parts/' . $item->category->model->car->slug . '/' . $item->image) }}"
                                                    alt="{{ $item->name }}"
                                                    class="lazy-image">
                                            </div>

                                            <div class="flex flex-col w-2/3 truncate">
                                                <span class="font-semibold truncate">{{ $item->name }}</span>
                                                <span class="text-gray-500 text-sm">#{{ $item->code }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="font-semibold flex gap-1">{{ money($item->price, 'EUR', true) }}
                                                <span class="text-gray-500 text-sm">(x{{ $item->count }})</span>
                                            </span>
                                            <span
                                                class="text-gray-500 text-sm">{{money($item->price * $item->count, 'EUR', true)}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button onclick="removeFromCart('{{ $item->id }}')" type="button"
                                                class="btn btn-outline btn-error btn-sm ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="w-1/2">@lang('stripe.order.list.table.product')</th>
                                <th>@lang('stripe.order.list.table.total')</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                        @if(count($cart) > 5)
                            <label for="cartListView"
                                   class="flex justify-center items-center w-full transition-colors duration-250 hover:bg-base-300/80 cursor-pointer p-2 rounded">
                                <span class="text-gray-500 text-sm">
                                    @if(count($cart) - 5 == 1)
                                        @lang('stripe.order.list.table.more_items.singular', ['count' => count($cart) - 5])
                                    @else
                                        @lang('stripe.order.list.table.more_items.plural', ['count' => count($cart) - 5])
                                    @endif
                                </span>
                            </label>
                        @endif
                    </div>

                    <div class="flex flex-col border-t border-t-primary pt-5">
                        <span class="text-xl font-bold">@lang('stripe.order.info.title')</span>
                        <span
                            class="text-gray-500">@lang('stripe.order.info.description')</span>

                        <div class="flex flex-col gap-2 mt-5">
                            <div class="flex gap-2 justify-between">
                                <span class="text-gray-500">@lang('stripe.order.info.shipping_cost.title')</span>
                                <span class="font-bold">
                                    @if($shippingCost > 0)
                                        {{ money($shippingCost, 'EUR', true) }}
                                    @else
                                        @lang('stripe.order.info.shipping_cost.free')
                                    @endif
                                </span>
                            </div>

                            <div class="flex gap-2 justify-between">
                                <span class="text-gray-500">@lang('stripe.order.info.approx_shipping_date')</span>
                                <span
                                    class="font-bold">{{ \Carbon\Carbon::parse($shippingDate)->translatedFormat("jS F, Y") }}</span>
                            </div>

                            <div class="flex gap-2 justify-between">
                                <span class="text-gray-500">@lang('stripe.order.info.total')</span>
                                <span class="font-bold">{{ money($total, 'EUR', true) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        @if(auth()->user())
                            <label class="label cursor-pointer gap-2 justify-start">
                                <input type="checkbox" name="saveInfo" class="checkbox checkbox-primary"/>
                                <span class="label-text">@lang('stripe.order.info.save_info')</span>
                            </label>
                        @endif

                        <button class="btn btn-primary btn-block"
                                type="submit">@lang('stripe.order.info.pay')</button>
                        <span
                            class="text-gray-500 text-sm select-none">@lang('stripe.order.info.terms_and_conditions', ['url' => 'test'])</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const deleteFromCartForm = document.getElementById('deleteFromCartForm');

        function removeFromCart(id) {
            const url = '{{ route('cart.remove', "id") }}'
            deleteFromCartForm.action = url.replace('id', id)
            deleteFromCartForm.submit()
        }
    </script>
@endsection

@section('modals')
    <input type="checkbox" id="cartListView" class="modal-toggle"/>
    <label for="cartListView" class="modal cursor-pointer modal-bottom sm:modal-middle">
        <label class="modal-box" for="">
            <span class="font-bold text-lg">@lang('stripe.order.modal.title')</span>

            <div class="overflow-y-auto max-h-[500px] mt-4">
                <div class="flex flex-col h-full mx-2">
                    @foreach($cart as $part)
                        <div
                            class="flex gap-3 items-center w-full transition-colors duration-250 hover:bg-base-300/80 cursor-pointer p-2 rounded">
                            <div class="aspect-square w-16 h-16 flex items-center justify-center">
                                <img
                                    data-src="{{ asset('images/parts/' . $part->category->model->car->slug . '/' . $part->image) }}"
                                    alt="{{ $part->name }}"
                                    class="lazy-image">
                            </div>

                            <div class="flex flex-col w-2/3 truncate">
                                <span class="font-semibold truncate">{{ $part->name }}</span>
                                <span class="text-gray-500 text-sm">#{{ $part->code }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-semibold">{{ money($part->price, 'EUR', true) }}<span
                                        class="text-gray-500 text-sm">(x3)</span></span>
                                <span
                                    class="text-gray-500 text-sm">{{money($part->price * $part->count, 'EUR', true)}}</span>
                            </div>

                            <button onclick="removeFromCart('{{ $part->id }}')" type="button"
                                    class="btn btn-outline btn-error btn-sm ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </label>
    </label>
@endsection
