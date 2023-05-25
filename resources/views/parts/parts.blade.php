@extends('layouts.app')

@section("title", __("pages.parts.title", ["brand" => $car->name, "model" => $model->name]))
@section("breadcrumbs", Breadcrumbs::render("car.parts.byCategory", $car, $model, $category, $modification))

@section('content')
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="flex flex-col p-4 rounded-xl bg-white w-full lg:w-1/4">
            <img data-src="{{ asset('images/cars/models/' . $car->slug . '/' . $model->image) }}"
                 alt="{{ $model->slug }}"
                 class="w-full max-w-[300px] mx-auto rounded-xl object-cover lazy-image"/>

            <div class="flex flex-col mt-5 pt-3 border-t border-t-primary">
                <span class="text-xl font-bold">@lang('pages.partCategories.content.card.base_info')</span>
                <div class="flex flex-col gap-0.5">
                    <div class="flex justify-between text-sm">
                        <span>@lang('parts.fields.brand'):</span>
                        <b>{{ $car->name }}</b>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>@lang('parts.fields.model'): </span>
                        <b>{{ $model->name }}</b>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>@lang('parts.fields.start_production'):</span>
                        <b>{{ $model->releasedAt }}</b>
                    </div>

                    @if($model->stoppedAt)
                        <div class="flex justify-between text-sm">
                            <span>@lang('parts.fields.end_production'): </span>
                            <b>{{ $model->stoppedAt }}</b>
                        </div>
                    @endif
                </div>
            </div>

            @if($modification)
                <span
                    class="text-lg font-bold mt-3">@lang('pages.partCategories.content.card.specifications.title')</span>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col text-sm gap-0.5">
                        <span
                            class="text-base font-semibold">@lang('pages.partCategories.content.card.specifications.engine')</span>
                        @if($model->modification->engineCode)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.code'): </span>
                                <b>{{ $model->modification->engineCode }}</b>
                            </div>
                        @endif

                        @if($model->modification->engineCapacity)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.capacity'): </span>
                                <b>@lang('parts.values.engine.capacity', ['value' => $model->modification->engineCapacity, 'sub' => $model->modification->getCapacityFloat()])</b>
                            </div>
                        @endif

                        @if($model->modification->enginePower)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.power'): </span>
                                <b>@lang('parts.values.engine.power', ['value' => $model->modification->enginePower])</b>
                            </div>
                        @endif

                        @if($model->modification->engineTorque)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.torque'): </span>
                                <b>@lang('parts.values.engine.torque', ['value' => $model->modification->engineTorque])</b>
                            </div>
                        @endif

                        @if($model->modification->engineInjectionType)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.injection'): </span>
                                <b>@lang('parts.values.engine.injection.' . $model->modification->engineInjectionType)</b>
                            </div>
                        @endif

                        @if($model->modification->engineCylinderCount)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.cylinders'): </span>
                                <b>@lang('parts.values.engine.cylinders', ['value' => $model->modification->engineCylinderCount])</b>
                            </div>
                        @endif

                        @if($model->modification->engineValveCount)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.valves'): </span>
                                <b>@lang('parts.values.engine.valves', ['value' => $model->modification->engineValveCount])</b>
                            </div>
                        @endif

                        @if($model->modification->engineFuel)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.fuel'): </span>
                                <b>@lang('parts.values.engine.fuel.' . $model->modification->engineFuel)</b>
                            </div>
                        @endif

                        @if($model->modification->engineFuelConsumptionCity)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.consumption.city'): </span>
                                <b>@lang('parts.values.engine.consumption.city', ['value' => $model->modification->engineFuelConsumptionCity])</b>
                            </div>
                        @endif

                        @if($model->modification->engineFuelConsumptionHighway)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.consumption.highway'): </span>
                                <b>@lang('parts.values.engine.consumption.highway', ['value' => $model->modification->engineFuelConsumptionHighway])</b>
                            </div>
                        @endif

                        @if($model->modification->engineFuelConsumptionCombined)
                            <div class="flex justify-between">
                                <span>@lang('parts.fields.engine.consumption.combined'): </span>
                                <b>@lang('parts.values.engine.consumption.combined', ['value' => $model->modification->engineFuelConsumptionCombined])</b>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col text-sm">
                        <span
                            class="text-base font-semibold">@lang('pages.partCategories.content.card.specifications.transmission')</span>

                        <div class="flex flex-col gap-0.5">
                            @if($model->modification->transmissionType)
                                <div class="flex justify-between">
                                    <span>@lang('parts.fields.transmission.type'): </span>
                                    <b>@lang('parts.values.transmission.type.' . $model->modification->transmissionType)</b>
                                </div>
                            @endif

                            @if($model->modification->transmissionGearCount)
                                <div class="flex justify-between">
                                    <span>@lang('parts.fields.transmission.gears'): </span>
                                    <b>@lang('parts.values.transmission.gears', ['value' => $model->modification->transmissionGearCount])</b>
                                </div>
                            @endif

                            @if($model->modification->transmissionDrive)
                                <div class="flex justify-between">
                                    <span>@lang('parts.fields.transmission.drive'): </span>
                                    <b>@lang('parts.values.transmission.drive.short.' . $model->modification->transmissionDrive)</b>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($model->modification->weight || $model->modification->clearance)
                        <div class="flex flex-col text-sm">
                            <span
                                class="text-base font-semibold">@lang('pages.partCategories.content.card.specifications.body')</span>

                            <div class="flex flex-col gap-0.5">
                                @if($model->modification->weight)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.body.weight'): </span>
                                        <b>@lang('parts.values.body.weight', ['value' => $model->modification->weight])</b>
                                    </div>
                                @endif

                                @if($model->modification->clearance)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.body.clearance'): </span>
                                        <b>@lang('parts.values.body.clearance', ['value' => $model->modification->clearance])</b>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($model->modification->trunkCapacity || $model->modification->fuelTankCapacity || $model->modification->seatsCount || $model->modification->doorsCount)
                        <div class="flex flex-col text-sm">
                            <span
                                class="text-base font-semibold">@lang('pages.partCategories.content.card.specifications.interior')</span>

                            <div class="flex flex-col gap-0.5">
                                @if($model->modification->trunkCapacity)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.interior.trunk'): </span>
                                        <b>@lang('parts.values.interior.trunk', ['value' => $model->modification->trunkCapacity])</b>
                                    </div>
                                @endif

                                @if($model->modification->fuelTankCapacity)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.interior.fuel_tank'): </span>
                                        <b>@lang('parts.values.interior.fuel_tank', ['value' => $model->modification->fuelTankCapacity])</b>
                                    </div>
                                @endif

                                @if($model->modification->seatsCount)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.interior.seats'): </span>
                                        <b>@lang('parts.values.interior.seats', ['value' => $model->modification->seatsCount])</b>
                                    </div>
                                @endif

                                @if($model->modification->doorsCount)
                                    <div class="flex justify-between">
                                        <span>@lang('parts.fields.interior.doors'): </span>
                                        <b>@lang('parts.values.interior.doors', ['value' => $model->modification->doorsCount])</b>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <div class="mt-3 pt-3 border-t border-t-primary">
                <span
                    class="text-lg font-semibold">@lang('pages.partCategories.content.modification.select.title')</span>

                <div class="mt-1">
                    <select class="select select-bordered select-primary w-full" id="modificationSelect"
                            @if(count($categories) == 0) disabled @endif>
                        @if(!$modification)
                            <option
                                data-src="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug]) }}"
                                selected>@lang('pages.partCategories.content.modification.select.option.title')</option>
                        @else
                            <option selected
                                    data-src="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug]) }}">@lang('pages.partCategories.content.modification.select.none')</option>
                        @endif

                        @foreach($model->modifications as $modelModification)
                            <option
                                data-src="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug, $modelModification->id]) }}"
                                @if($modification && $modification->id == $modelModification->id) selected @endif>
                                @lang('pages.partCategories.content.modification.select.option.description', [
                                    'engineCapacity' => $modelModification->getCapacityFloat(),
                                    'engineCode' => $modelModification->engineCode,
                                    'enginePower' => $modelModification->enginePower,
                                    'transmissionDrive' => __('parts.values.transmission.drive.full.' . $modelModification->transmissionDrive),
                                    'gears' => __('parts.values.transmission.gears', ['value' => $modelModification->transmissionGearCount])
                                ])
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-5 pt-5 border-t border-t-primary flex flex-col">
                <span class="text-lg font-bold">@lang('parts.categories.title')</span>

                <div class="mt-3 flex flex-col gap-2">
                    @foreach($categories as $item)
                        <span class="font-semibold">{{ $item->name }}</span>

                        <div class="ml-5 flex flex-col gap-2">
                            @foreach($item->partCategories as $subCategory)
                                @if($subCategory->id === $category->id)
                                    <span class="text-primary">{{ $subCategory->name }}</span>
                                @else
                                    <a href="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $subCategory->slug, $modification]) }}"
                                       class="link link-primary">
                                        {{ $subCategory->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-5 flex-1">
            <div class="bg-white p-4 flex rounded-xl">
                <form class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 grid-rows-1 gap-5 w-full"
                      id="filterForm"
                      action="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug, $modification]) }}">
                    <input type="hidden" name="page" value="{{ $currentPage }}">

                    @if(count($manufacturers) > 0)
                        <div class="dropdown dropdown-end dropdown-sm flex flex-col">
                            <label tabindex="0" class="text-sm">
                                @lang('parts.filters.manufacturer.title')
                            </label>

                            <select name="manufacturer"
                                    class="select select-primary select-sm text-xs w-full max-w-xs"
                                    @if($manufacturers[0]->manufacturer === null) disabled @endif>
                                <option value="null">@lang('parts.filters.manufacturer.all')</option>
                                @if($manufacturers[0]->manufacturer !== null)
                                    @foreach($manufacturers as $item)
                                        <option value="{{ $item->manufacturer }}"
                                                @if(isset($request->manufacturer) && $request->manufacturer == $item->manufacturer) selected @endif>
                                            {{ $item->manufacturer }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    @if(count($colors) > 0)
                        <div class="dropdown dropdown-end dropdown-sm flex flex-col">
                            <label tabindex="0" class="text-sm">
                                @lang('parts.filters.colors.title')
                            </label>
                            <select name="color" class="select select-primary select-sm text-xs w-full max-w-xs"
                                    @if($colors[0]->color === null) disabled @endif>
                                <option value="null">@lang('parts.filters.colors.all')</option>
                                @if($colors[0]->color !== null)
                                    @foreach($colors as $item)
                                        <option value="{{ $item->color }}"
                                                @if(isset($request->color) && $request->color == $item->color) selected @endif>
                                            @lang('parts.values.colors.' . strtolower($item->color))
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    @if(count($locations) > 0)
                        <div class="dropdown dropdown-end dropdown-sm flex flex-col">
                            <label tabindex="0" class="text-sm">
                                @lang('parts.filters.location.title')
                            </label>
                            <select name="location" class="select select-primary select-sm text-xs w-full max-w-xs"
                                    @if($locations[0]->location === null) disabled @endif>
                                <option value="null">@lang('parts.filters.location.all')</option>
                                @if($locations[0]->location !== null)
                                    @foreach($locations as $item)
                                        <option value="{{ $item->location }}"
                                                @if(isset($request->location) && $request->location == $item->location) selected @endif>
                                            @lang('parts.values.location.' . strtolower($item->location))
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    <div class="dropdown dropdown-end dropdown-sm flex flex-col">
                        <label tabindex="0" class="text-sm">
                            @lang('parts.filters.sort_by.title')
                        </label>
                        <select name="sortMethod" class="select select-primary select-sm text-xs w-full max-w-xs">
                            @foreach($sortMethods as $key => $item)
                                <option value="{{ $key }}"
                                        @if(isset($request->sortMethod) && $request->sortMethod == $key) selected @endif>
                                    @lang('parts.filters.sort_by.methods.' . $key)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm">
                            @lang('parts.filters.price.title')
                        </label>
                        <div class="flex gap-2">
                            <input name="minPrice" type="text"
                                   class="input input-bordered input-sm input-primary text-xs w-full max-w-xs"
                                   placeholder="@lang('parts.filters.price.from')"
                                   value="{{ $request->minPrice ?? null }}">
                            <input name="maxPrice" type="text"
                                   class="input input-bordered input-sm input-primary text-xs w-full max-w-xs"
                                   placeholder="@lang('parts.filters.price.to')"
                                   value="{{ $request->maxPrice ?? null }}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex flex-col p-4 bg-white rounded-xl">
                <div class="flex justify-between items-center">
                    <span
                        class="text-lg">@choice(__('pages.parts.content.title.found'), count($parts)) {{ count($parts) }} @choice(__('pages.parts.content.title.parts'), count($parts))</span>

                    <div class="flex gap-2">
                        <button class="btn btn-primary btn-sm"
                                id="filterFormSubmit">@lang('parts.filters.search')</button>
                        @if($hasFilters)
                            <button class="btn btn-error btn-sm"
                                    id="filterFormReset">@lang('parts.filters.reset')</button>
                        @endif
                    </div>
                </div>

                <div
                    class="flex flex-col gap-5 flex-1 mt-4 pt-4 border-t border-t-primary">
                    @if($parts->count() > 0)
                        @foreach($parts as $part)
                            <div class="w-full p-2 flex flex-col gap-3">
                                <div class="flex flex-col">
                                    <span class="text-lg font-semibold">{{ $part->name }}</span>
                                    <span
                                        class="text-xs text-gray-400">@lang('parts.fields.code'): <b>#{{ $part->code }}</b></span>
                                </div>

                                <div class="flex flex-col md:flex-row gap-3">
                                    <div class="flex gap-5 w-full">
                                        <img
                                            data-src="{{ asset('images/parts/' . $part->category->model->car->slug . '/' . $part->image) }}"
                                            alt="{{ $part->name }}"
                                            class="w-32 md:w-48 h-auto my-auto object-scale-down lazy-image">

                                        <div
                                            class="items-center justify-center flex-col hidden mx-auto xl:w-[300px] md:flex">
                                            <table class="table table-compact w-full">
                                                <tbody>
                                                <tr>
                                                    <td class="text-sm text-gray-500">@lang('parts.fields.manufacturer')</td>
                                                    <td class="text-sm font-bold">{{ $part->manufacturer }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm text-gray-500">@lang('parts.fields.color')</td>
                                                    <td class="text-sm font-bold">@lang('parts.values.colors.' . strtolower($part->color ?? "unknown"))</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm text-gray-500">@lang('parts.fields.location')</td>
                                                    <td class="text-sm font-bold">@lang('parts.values.location.' . strtolower($part->location ?? "unknown"))</td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <a href="{{ route('car.parts.show', [$car->slug, $model->slug, $category->slug, $part->id, $modification ?? null]) }}"
                                               class="btn btn-primary btn-sm w-full">@lang('parts.fields.details')</a>
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
                                                <span
                                                    class="text-sm text-gray-500">@lang('parts.fields.delivery'):</span>
                                                        <span
                                                            class="font-bold">{{ Carbon\Carbon::now()->addDays(3)->translatedFormat('jS F, Y') }}</span>
                                                    </div>

                                                    <form action="{{ route('cart.add', $part->id) }}" method="POST">
                                                        @csrf

                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm mt-2 w-full">
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
                                                    <td class="text-sm text-gray-500 w-2/3">@lang('parts.fields.manufacturer')</td>
                                                    <td class="text-sm font-bold">{{ $part->manufacturer }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm text-gray-500">@lang('parts.fields.color')</td>
                                                    <td class="text-sm font-bold">@lang('parts.values.colors.' . strtolower($part->color ?? "unknown"))</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm text-gray-500">@lang('parts.fields.location')</td>
                                                    <td class="text-sm font-bold">@lang('parts.values.location.' . strtolower($part->location ?? "unknown"))</td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <a href="{{ route('car.parts.show', [$car->slug, $model->slug, $category->slug, $part->id, $modification ?? null]) }}"
                                               class="btn btn-primary btn-sm w-full">@lang('parts.fields.details')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-7 flex flex-col items-center gap-3 my-5">
                            <div class="p-4 rounded-full bg-secondary/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-6 h-6 text-primary-focus">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>

                            <div class="flex flex-col justify-center items-center mt-1">
                                <span class="text-2xl font-bold">@lang('pages.parts.content.empty.title')</span>
                                <span
                                    class="text-lg text-gray-500 font-medium">@lang('pages.parts.content.empty.description')</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex justify-center">
                    {{ $parts->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        const modificationSelect = document.getElementById('modificationSelect');
        const filterFormSubmit = document.getElementById('filterFormSubmit');
        const filterFormReset = document.getElementById('filterFormReset');

        modificationSelect.addEventListener('change', (event) => {
            window.location.href = event.target.options[event.target.selectedIndex].getAttribute('data-src');
        });

        filterFormSubmit.addEventListener('click', (event) => {
            event.preventDefault();

            const form = document.getElementById('filterForm');
            form.submit();
        });

        filterFormReset?.addEventListener('click', (event) => {
            event.preventDefault();

            const url = new URL(window.location.href);
            url.searchParams.delete('manufacturer');
            url.searchParams.delete('sortMethod');
            url.searchParams.delete('minPrice');
            url.searchParams.delete('maxPrice');
            url.searchParams.delete('color');
            url.searchParams.delete('location');

            window.location.href = url.toString();
        });
    </script>
@endsection
