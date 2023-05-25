@extends('layouts.app')

@section('title', __('pages.partDetails.title', ['part_number' => $part->code]))
@section('breadcrumbs', Breadcrumbs::render('car.parts.show', $car, $model, $category, $part, $modification))

@section('content')
    <div class="p-4 bg-white rounded-xl">
        <div class="w-full p-2 flex flex-col gap-3">
            <div class="flex flex-col">
                <span class="text-lg font-semibold">{{ $part->name }}</span>
                <span
                    class="text-xs text-gray-400">@lang('parts.fields.code'): <b>#{{ $part->code }}</b></span>
            </div>

            <div class="flex flex-col md:flex-row gap-3">
                <div class="flex gap-5 w-full">
                    <div class="aspect-square flex justify-center items-center max-w-[150px] md:max-w-[300px]">
                        <img data-src="{{ asset('images/parts/' . $part->category->model->car->slug . '/' . $part->image) }}"
                             alt="{{ $part->name }}"
                             class="rounded-xl w-full lazy-image">
                    </div>

                    <div class="items-center justify-center flex-col hidden md:flex mx-auto">
                        <table class="table table-compact">
                            <tbody>
                            <tr>
                                <td>@lang('parts.fields.manufacturer')</td>
                                <td class="font-bold">{{ $part->manufacturer }}</td>
                            </tr>

                            @if($part->color)
                                <tr>
                                    <td>@lang('parts.fields.color')</td>
                                    <td class="font-bold">@lang('parts.values.colors.' . strtolower($part->color))</td>
                                </tr>
                            @endif

                            @if($part->location)
                                <tr>
                                    <td>@lang('parts.fields.location')</td>
                                    <td class="font-bold">@lang('parts.values.location.' . strtolower($part->location))</td>
                                </tr>
                            @endif

                            @if($part->width)
                                <tr>
                                    <td>@lang('parts.fields.width')</td>
                                    <td class="font-bold">@lang('parts.values.width', ['value' => $part->width])</td>
                                </tr>
                            @endif

                            @if($part->height)
                                <tr>
                                    <td>@lang('parts.fields.height')</td>
                                    <td class="font-bold">@lang('parts.values.height', ['value' => $part->height])</td>
                                </tr>
                            @endif

                            @if($part->length)
                                <tr>
                                    <td>@lang('parts.fields.length')</td>
                                    <td class="font-bold">@lang('parts.values.length', ['value' => $part->length])</td>
                                </tr>
                            @endif

                            @if($part->material)
                                <tr>
                                    <td>@lang('parts.fields.material')</td>
                                    <td class="font-bold">@lang('parts.values.material.' . strtolower($part->material))</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col items-end justify-center text-sm ml-auto">
                        <div class="flex items-center gap-1">
                            <span class="text-sm text-gray-500">@lang('parts.fields.price'):</span>
                            <span class="font-bold">{{ money($part->price, 'EUR', true) }}</span>
                        </div>

                        <div class="flex items-center gap-1">
                                            <span
                                                class="text-sm text-gray-500">@lang('parts.fields.stock.in_stock'):</span>
                            @if($part->quantity)
                                <span
                                    class="font-bold">@lang('parts.fields.stock.items', ['value' => $part->quantity])</span>
                            @else
                                <span
                                    class="font-bold text-error">@lang('parts.fields.stock.out_of_stock')</span>
                            @endif
                        </div>

                        @if($part->quantity)
                            <div class="flex flex-col">
                                <div class="flex items-center gap-1">
                                    <span class="text-sm text-gray-500">@lang('parts.fields.delivery'):</span>
                                    <span
                                        class="font-bold">{{ Carbon\Carbon::now()->addDays(3)->translatedFormat('jS F, Y') }}</span>
                                </div>

                                <form action="{{ route('cart.add', $part->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-primary btn-sm mt-2 w-full">
                                        @lang('cart.add')
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="items-center justify-center w-full col-span-2 flex md:hidden">
                    <div class="flex flex-col w-full">
                        <table class="table table-compact">
                            <tbody>
                            <tr>
                                <td>@lang('parts.fields.manufacturer')</td>
                                <td class="font-bold">{{ $part->manufacturer }}</td>
                            </tr>

                            @if($part->color)
                                <tr>
                                    <td>@lang('parts.fields.color')</td>
                                    <td class="font-bold">@lang('parts.values.colors.' . strtolower($part->color))</td>
                                </tr>
                            @endif

                            @if($part->location)
                                <tr>
                                    <td>@lang('parts.fields.location')</td>
                                    <td class="font-bold">@lang('parts.values.location.' . strtolower($part->location))</td>
                                </tr>
                            @endif

                            @if($part->width)
                                <tr>
                                    <td>@lang('parts.fields.width')</td>
                                    <td class="font-bold">@lang('parts.values.width', ['value' => $part->width])</td>
                                </tr>
                            @endif

                            @if($part->height)
                                <tr>
                                    <td>@lang('parts.fields.height')</td>
                                    <td class="font-bold">@lang('parts.values.height', ['value' => $part->height])</td>
                                </tr>
                            @endif

                            @if($part->length)
                                <tr>
                                    <td>@lang('parts.fields.length')</td>
                                    <td class="font-bold">@lang('parts.values.length', ['value' => $part->length])</td>
                                </tr>
                            @endif

                            @if($part->material)
                                <tr>
                                    <td>@lang('parts.fields.material')</td>
                                    <td class="font-bold">@lang('parts.values.material.' . strtolower($part->material))</td>
                                </tr>
                            @endif

                            @if($part->modification)
                                <tr>
                                    <td>@lang('parts.fields.engine.code')</td>
                                    <td class="font-bold">{{ $part->modification->engineCode }}</td>
                                </tr>

                                @if($part->modification->engineCapacity)
                                    <tr>
                                        <td>@lang('parts.fields.engine.capacity')</td>
                                        <td class="font-bold">@lang('parts.values.engine.capacity', ['value' => $model->modification->engineCapacity, 'sub' => $model->modification->getCapacityFloat()])</td>
                                    </tr>
                                @endif

                                @if($part->modification->enginePower)
                                    <tr>
                                        <td>@lang('parts.fields.engine.power')</td>
                                        <td class="font-bold">@lang('parts.values.engine.power', ['value' => $model->modification->enginePower])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineTorque)
                                    <tr>
                                        <td>@lang('parts.fields.engine.torque')</td>
                                        <td class="font-bold">@lang('parts.values.engine.torque', ['value' => $model->modification->engineTorque])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineFuel)
                                    <tr>
                                        <td>@lang('parts.fields.engine.fuel')</td>
                                        <td class="font-bold">@lang('parts.values.engine.fuel.' . $model->modification->engineFuel)</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineFuelConsumptionCity)
                                    <tr>
                                        <td>@lang('parts.fields.engine.consumption.city')</td>
                                        <td class="font-bold">@lang('parts.values.engine.consumption.city', ['value' => $model->modification->engineFuelConsumptionCity])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineFuelConsumptionHighway)
                                    <tr>
                                        <td>@lang('parts.fields.engine.consumption.highway')</td>
                                        <td class="font-bold">@lang('parts.values.engine.consumption.highway', ['value' => $model->modification->engineFuelConsumptionHighway])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineFuelConsumptionCombined)
                                    <tr>
                                        <td>@lang('parts.fields.engine.consumption.combined')</td>
                                        <td class="font-bold">@lang('parts.values.engine.consumption.combined', ['value' => $model->modification->engineFuelConsumptionCombined])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineInjectionType)
                                    <tr>
                                        <td>@lang('parts.fields.engine.injection')</td>
                                        <td class="font-bold">@lang('parts.values.engine.injection.' . $model->modification->engineInjectionType)</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineCylinderCount)
                                    <tr>
                                        <td>@lang('parts.fields.engine.cylinders')</td>
                                        <td class="font-bold">@lang('parts.values.engine.cylinders', ['value' => $model->modification->engineCylinderCount])</td>
                                    </tr>
                                @endif

                                @if($part->modification->engineValveCount)
                                    <tr>
                                        <td>@lang('parts.fields.engine.valves')</td>
                                        <td class="font-bold">@lang('parts.values.engine.valves', ['value' => $model->modification->engineValveCount])</td>
                                    </tr>
                                @endif

                                @if($part->modification->transmissionType)
                                    <tr>
                                        <td>@lang('parts.fields.transmission.type')</td>
                                        <td class="font-bold">@lang('parts.values.transmission.type.' . $model->modification->transmissionType)</td>
                                    </tr>
                                @endif

                                @if($part->modification->transmissionGearCount)
                                    <tr>
                                        <td>@lang('parts.fields.transmission.gears')</td>
                                        <td class="font-bold">@lang('parts.values.transmission.gears', ['value' => $model->modification->transmissionGearCount])</td>
                                    </tr>
                                @endif

                                @if($part->modification->transmissionDrive)
                                    <tr>
                                        <td>@lang('parts.fields.transmission.drive')</td>
                                        <td class="font-bold">@lang('parts.values.transmission.drive.short.' . $model->modification->transmissionDrive)</td>
                                    </tr>
                                @endif

                                @if($part->modification->weight)
                                    <tr>
                                        <td>@lang('parts.fields.body.weight')</td>
                                        <td class="font-bold">@lang('parts.values.body.weight', ['value' => $model->modification->weight])</td>
                                    </tr>
                                @endif

                                @if($part->modification->clearance)
                                    <tr>
                                        <td>@lang('parts.fields.body.clearance')</td>
                                        <td class="font-bold">@lang('parts.values.body.clearance', ['value' => $model->modification->clearance])</td>
                                    </tr>
                                @endif

                                @if($part->modification->fuelTankCapacity)
                                    <tr>
                                        <td>@lang('parts.fields.interior.fuel_tank')</td>
                                        <td class="font-bold">@lang('parts.values.interior.fuel_tank', ['value' => $model->modification->fuelTankCapacity])</td>
                                    </tr>
                                @endif

                                @if($part->modification->trunkCapacity)
                                    <tr>
                                        <td>@lang('parts.fields.interior.trunk')</td>
                                        <td class="font-bold">@lang('parts.values.interior.trunk', ['value' => $model->modification->trunkCapacity])</td>
                                    </tr>
                                @endif

                                @if($part->modification->seatsCount)
                                    <tr>
                                        <td>@lang('parts.fields.interior.seats')</td>
                                        <td class="font-bold">@lang('parts.values.interior.seats', ['value' => $model->modification->seatsCount])</td>
                                    </tr>
                                @endif

                                @if($part->modification->doorsCount)
                                    <tr>
                                        <td>@lang('parts.fields.interior.doors')</td>
                                        <td class="font-bold">@lang('parts.values.interior.doors', ['value' => $model->modification->doorsCount])</td>
                                    </tr>
                                @endif

                                @if($part->modification->body)
                                    <tr>
                                        <td>@lang('parts.fields.body.type')</td>
                                        <td class="font-bold">{{ $part->modification->body->{app()->getLocale() . 'Name'} }}</td>
                                    </tr>
                                @endif
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-5 pt-5 border-t border-t-primary">
            <span class="text-xl font-bold">@lang('pages.partDetails.content.may_be_interested.title')</span>

            <div class="grid md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-5 mt-5">
                @if($mayBeInterested->count() > 0)
                    @foreach($mayBeInterested as $product)
                        <div class="card bg-base-200/80 shadow cursor-pointer card-compact"
                             onclick="window.location.href = '{{ route('car.parts.show', [$product->category->model->car->slug, $product->category->model->slug, $product->category->slug, $product->id]) }}'">
                            <div class="card-body">
                                @if(\Carbon\Carbon::parse($product->createdAt)->diffInDays(now()) < 7)
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
                                <span class="text-2xl font-bold">@lang('pages.partDetails.content.may_be_interested.empty.title')</span>
                                <span class="text-lg text-gray-500 font-medium">@lang('pages.partDetails.content.may_be_interested.empty.description')</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
