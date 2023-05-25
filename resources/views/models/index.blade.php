@extends('layouts.app')

@section('title', __('pages.models.title', ['brand' => $car->name]))
@section('breadcrumbs', Breadcrumbs::render('car.models', $car))

@section('content')
    <div class="rounded-xl p-4 bg-white flex flex-col">
        <span class="text-2xl font-bold">@lang("pages.models.content.title", ['brand' => $car->name])</span>
        <span class="text-lg">@lang("pages.models.content.description", ['brand' => $car->name])</span>

        <form action="{{ route('api.models.search', $car->id) }}" method="GET" class="flex mt-3 gap-3 mx-auto items-center justify-center w-full md:max-w-lg" id="modelsSearchForm">
            <input type="text" placeholder="@lang('pages.models.content.search.placeholder', ['brand' => $car->name])" name="query"
                   class="input input-bordered input-primary input-sm w-full" id="modelsInput"/>
            <button type="submit" class="btn btn-sm btn-primary">@lang('pages.models.content.search.submit')</button>
        </form>

        <div
            class="grid gap-5 mt-5 pt-5 border-t border-t-primary grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7"
            id="modelsList">
            @foreach($models as $model)
                <a class="flex gap-0 sm:flex-col bg-base-200/50 p-2 items-center transition duration-250 rounded-lg border border-base-300 hover:bg-base-300 sm:hover:bg-base-200/50 sm:hover:relative sm:hover:scale-110"
                   href="{{ route('car.parts', [$car->slug, $model->slug]) }}">

                    <div class="flex flex-col w-1/3 aspect-video sm:w-full">
                        <img data-src="{{ asset('images/cars/models/' . $car->slug . '/' . $model->image) }}"
                             class=" lazy-image w-full h-auto sm:w-full sm:max-h-[115px] md:max-h-[100px] lg:max-h-[110px] xl:max-h-[95px] 2xl:max-h-[120px] rounded-lg object-contain" alt="{{ $model->slug }}"/>

                        <div class="mt-1 gap-1 hidden sm:flex truncate">
                            <span class="text-gray-500 text-sm">
                                {{ $model->releasedAt }}
                            </span>

                            <span class="text-gray-500 break-words text-sm truncate">-
                                @if ($model->stoppedAt)
                                    {{ $model->stoppedAt }}
                                @else
                                    ...
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col w-full sm:flex-1 ml-2 pl-2 border-l border-l-gray-300 sm:border-l-0 sm:ml-0 sm:pl-0 sm:mt-2 sm:pt-2 sm:border-t sm:border-t-primary">
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
            @endforeach
        </div>
    </div>

    <script>
        const modelsSearchForm = document.getElementById('modelsSearchForm');
        const modelsList = document.getElementById('modelsList');
        const modelsInput = document.getElementById('modelsInput');

        modelsSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const url = new URL(this.action);
            url.searchParams.append('query', modelsInput.value.toString());

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-localization': '{{ app()->getLocale() }}',
                }
            })
                .then(response => response.text())
                .then(data => {
                    modelsList.innerHTML = '';
                    modelsList.innerHTML = data;
                });
        })

    </script>
@endsection
