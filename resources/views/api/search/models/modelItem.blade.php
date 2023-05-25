<a class="flex sm:flex-col bg-base-200/50 p-2 items-center transition duration-250 rounded-lg border border-base-300 hover:relative hover:scale-110"
   href="{{ route('car.parts', [$car->slug, $model->slug]) }}">

    <div class="flex flex-col w-1/3 sm:w-full">
        <img src="{{ asset('images/cars/models/' . $car->slug . '/' . $model->image) }}"
             class="w-full h-[120px] rounded-lg object-contain" alt="{{ $model->slug }}"/>

        <div class="mt-1 gap-1 flex hidden sm:flex truncate">
            <span class="text-sm text-gray-500 text-sm">
                {{ $model->releasedAt }}
            </span>

            <span class="text-sm text-gray-500 break-words text-sm truncate">-
                @if ($model->stoppedAt)
                    {{ $model->stoppedAt }}
                @else
                    ...
                @endif
            </span>
        </div>
    </div>

    <div class="flex flex-col sm:flex-1 w-full mt-2 pt-2 border-t border-t-primary">
        <span class="text-base"><b>{{ $model->car->name }}</b> {{ $model->name }}</span>
        <div class="flex flex-col">
            <span class="text-sm text-gray-500">
                @php
                    $totalPartsCount = $model->categories->map(fn($category) => $category->parts->count())->sum();
                @endphp

                @if($totalPartsCount > 0)
                    @lang('pages.models.content.card.total_parts', ['count' => $totalPartsCount])
                @else
                    @lang('pages.models.content.card.empty')
                @endif
            </span>
        </div>
    </div>
</a>
