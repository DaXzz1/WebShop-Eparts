@extends('layouts.app')

@section('title', __('pages.partCategories.title', ['brand' => $car->name, 'model' => $model->name]))
@section('breadcrumbs', Breadcrumbs::render('car.parts', $car, $model, $modification))

@section('content')
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="flex flex-col p-4 rounded-xl bg-white w-full lg:w-1/4">
            <img data-src="{{ asset('images/cars/models/' . $car->slug . '/' . $model->image) }}" alt="{{ $model->slug }}"
                 class="w-full max-w-[300px] mx-auto rounded-xl lazy-image object-cover"/>

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
                            <option data-src="{{ route('car.parts', [$car->slug, $model->slug]) }}"
                                    selected>@lang('pages.partCategories.content.modification.select.option.title')</option>
                        @else
                            <option selected
                                    data-src="{{ route('car.parts', [$car->slug, $model->slug]) }}">@lang('pages.partCategories.content.modification.select.none')</option>
                        @endif

                        @foreach($model->modifications as $modelModification)
                            <option
                                data-src="{{ route('car.parts', [$car->slug, $model->slug, $modelModification->id]) }}"
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
        </div>

        <div class="p-4 rounded-xl bg-white flex-1">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="@if(!$loop->first) border-t border-gray-200 mt-5 pt-5 @endif">
                        <span class="text-2xl font-bold">{{ $category->name }}</span>

                        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-3">
                            @foreach($category->partCategories as $subCategory)
                                <a href="{{ route('car.parts.byCategory', [$car->slug, $model->slug, $subCategory->slug, $modification->id ?? null]) }}"
                                   class="p-2 flex flex-col items-center cursor-pointer rounded transition-colors duration-250 hover:bg-base-200 select-none">
                                    <img
                                        data-src="{{ asset('images/partCategories/' . $subCategory->model->car->slug . '/' . $subCategory->image) }}"
                                        alt="{{ $subCategory->name }}"
                                        class="lazy-image aspect-square w-full md:max-w-[125px] pointer-events-none">

                                    <span class="font-semibold text-center text-sm mt-3">{{ $subCategory->name }} <span
                                            class="font-normal">({{ $subCategory->count }})</span></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-3 my-5">
                    <div class="p-4 rounded-full bg-secondary/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" class="w-6 h-6 text-primary-focus">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>

                    <div class="flex flex-col justify-center items-center mt-1">
                        <span class="text-2xl font-bold">@lang('errors.partCategories.title')</span>
                        <span
                            class="text-lg text-gray-500 font-medium">@lang('errors.partCategories.description', ['car' => "$car->name $model->name"])</span>

                        <a href="{{ route('car.models', [$car->slug]) }}"
                           class="btn btn-sm btn-primary mt-5 font-semibold">@lang('errors.partCategories.back', ['brand' => $car->name])</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const modificationSelect = document.getElementById('modificationSelect');

        modificationSelect.addEventListener('change', (event) => {
            window.location.href = event.target.options[event.target.selectedIndex].getAttribute('data-src');
        });
    </script>
@endsection
