
<div
    class='flex items-center justify-between transition-colors duration-250 hover:bg-gray-300 py-2 px-2.5 cursor-pointer' onclick="window.location.href = '{{ route('car.parts.show', [$part->category->model->car->slug, $part->category->model->slug, $part->category->slug, $part->id, $part->modification->id ?? null]) }}'">
    <div class="aspect-square w-10 h-10 flex items-center justify-center">
        <img src='{{ asset('images/parts/' . $part->category->model->car->name . '/' . $part->image) }}' alt='{{$part->name}}' class='object-cover'>
    </div>

    <div class='flex flex-col mx-3 truncate w-full'>
        <span class='text-sm font-semibold truncate' title="{{$part->name}}">{{$part->name}}</span>
        <span class='text-xs text-gray-500'>@lang('parts.fields.code'): {{$part->code}}</span>
    </div>

    <div class="flex items-center gap-3 flex-1 ml-3">
        <span class='text-sm font-semibold my-auto'>{{ money($part->price, 'EUR', true) }}</span>

        <form action="{{ route('cart.add', $part->id) }}" method="POST">
            @csrf

            <button type="submit"
                    class='btn btn-primary btn-sm text-xs font-semibold whitespace-nowrap w-full'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline xl:hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>

                <span class="hidden xl:inline">@lang('cart.add')</span>
            </button>
        </form>
    </div>
</div>
