<a class="flex sm:flex-col bg-base-200/50 p-2 items-center transition duration-250 rounded-lg border border-base-300 hover:relative hover:scale-110"
   href="{{ route('car.parts.show', [$part->category->model->car->slug, $part->category->model->slug, $part->category->slug, $part->id, $part->modification->id ?? null]) }}">

    <div class="flex flex-col w-1/3 sm:w-full">
        <img src="{{ asset('images/parts/' . $part->category->model->car->slug . '/' . $part->image) }}"
             class="w-full h-[120px] rounded-lg object-contain" alt="{{ $part->name }}"/>
    </div>

    <div class="flex flex-col sm:flex-1 w-full mt-2 pt-2 border-t border-t-primary">
        <span class="text-base font-bold">{{ $part->name }}</span>
        <div class="flex gap-2 flex-wrap mt-1">
            <span class="badge badge-primary">{{ $part->category->model->car->name }}</span>
            <span class="badge badge-primary">{{ $part->category->model->name }}</span>
            <span class="badge badge-primary">{{ $part->category->{app()->getLocale() . 'Name'} }}</span>
        </div>

        <div class="mt-2 pt-2 border-t border-t-gray-300 flex flex-col">
            <div class="flex gap-1 items-center text-sm">
                <span class="text-gray-500">@lang('parts.fields.stock.in_stock'):</span>
                @if($part->quantity)
                    <span
                        class="font-bold">@lang('parts.fields.stock.items', ['value' => $part->quantity])</span>
                @else
                    <span
                        class="font-bold text-error">@lang('parts.fields.stock.out_of_stock')</span>
                @endif
            </div>
            <div class="flex gap-1 items-center text-sm">
                <span class="text-gray-500">@lang('parts.fields.price'):</span>
                <span
                    class="font-bold">{{ money($part->price, "EUR", true) }}
                                        </span>
            </div>
        </div>
    </div>
</a>
