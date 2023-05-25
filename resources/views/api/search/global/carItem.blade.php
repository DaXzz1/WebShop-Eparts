<a class="flex sm:flex-col bg-base-200/50 p-2 items-center transition duration-250 rounded-lg border border-base-300 hover:relative hover:scale-110"
   href="{{ route('car.models', [$car->slug]) }}">

    <div class="flex flex-col w-1/3 sm:w-full">
        <img src="{{ asset('images/cars/icons/' . $car->image) }}"
             class="w-full h-[120px] rounded-lg object-contain" alt="{{ $car->slug }}"/>
    </div>

    <div class="flex flex-col sm:flex-1 w-full mt-2 pt-2 border-t border-t-primary">
        <span class="text-base">{{ $car->name }}</span>
        <div class="flex flex-col">
            <span class="text-sm text-gray-500">
                @lang('cars.total_models_count', ['count' => $car->models->count()])
            </span>
        </div>
    </div>
</a>
