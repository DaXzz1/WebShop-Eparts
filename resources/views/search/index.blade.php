@extends('layouts.app')

@section('title', __('pages.global_search.title'))
@section('breadcrumbs', Breadcrumbs::render('search.index'))

@section('content')
    <div class="p-4 flexflex-col bg-white shadow-xl rounded-xl">
        <div class="flex flex-col">
            <span class="text-2xl font-bold">@lang('pages.global_search.content.title')</span>
            <span class="text-lg">@lang('pages.global_search.content.description')</span>
        </div>

        <form action="{{ route('api.global_search') }}" class="flex gap-3 justify-center mx-auto items-center w-full md:max-w-md mt-4"
              id="globalSearchForm">

            <div class="flex flex-col gap-1 w-full">
                <input type="text" placeholder="@lang('pages.global_search.content.form.placeholder')" name="query"
                       class="input input-bordered input-primary input-sm w-full" id="globalSearchInput"/>
                <span class="text-xs text-gray-500 font-bold">@lang('pages.global_search.content.form.press_enter')</span>
            </div>

            <button type="submit" class="btn btn-primary">@lang('pages.global_search.content.form.search')</button>
        </form>

        <div class="mt-5 pt-5 border-t border-t-gray-300 flex flex-col gap-3 hidden" id="listParent">
            <div class="flex flex-col hidden" id="carsListParent">
                <span class="font-bold text-lg">@lang('pages.global_search.content.list.cars')</span>
                <div class="grid grid-cols-6 gap-5 mt-3" id="carsList">
                </div>
            </div>

            <div class="flex flex-col hidden" id="modelsListParent">
                <span class="font-bold text-lg">@lang('pages.global_search.content.list.models')</span>
                <div class="grid grid-cols-6 gap-5 mt-3" id="modelsList"></div>
            </div>

            <div class="flex flex-col hidden" id="partsListParent">
                <span class="font-bold text-lg">@lang('pages.global_search.content.list.parts')</span>
                <div class="grid grid-cols-6 gap-5 mt-3" id="partsList"></div>
            </div>
        </div>

        <div class="mt-5 pt-5 border-t border-t-gray-300 flex flex-col gap-3 my-5 hidden" id="noResultParent"></div>

        <div class="mt-5 pt-5 border-t border-t-gray-300 flex flex-col gap-3" id="startSearch">
            <div class="flex flex-col items-center gap-3">
                <div class="p-4 rounded-full bg-secondary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary-focus">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>

                <div class="flex flex-col justify-center items-center mt-1">
                    <span class="text-2xl font-bold">@lang('pages.global_search.content.list.start_search.title')</span>
                    <span class="text-lg text-gray-500 font-medium">@lang('pages.global_search.content.list.start_search.description')</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const globalSearchForm = document.getElementById('globalSearchForm');
        const carsList = document.getElementById('carsList');
        const modelsList = document.getElementById('modelsList');
        const partsList = document.getElementById('partsList');

        const globalSearchInput = document.getElementById('globalSearchInput');

        const carsListParent = document.getElementById('carsListParent');
        const modelsListParent = document.getElementById('modelsListParent');
        const partsListParent = document.getElementById('partsListParent');

        const listParent = document.getElementById('listParent');
        const noResultParent = document.getElementById('noResultParent');
        const startSearch = document.getElementById('startSearch');

        globalSearchForm.addEventListener("submit", search);
        window.addEventListener("load", search);

        function search(e) {
            e.preventDefault();

            const url = new URL(window.location.href);
            const type = e.type;
            if (type === "load" && url.searchParams.get('query')) {
                if (globalSearchInput.value !== url.searchParams.get('query')) {
                    globalSearchInput.value = url.searchParams.get('query');
                }
            }

            if (globalSearchInput.value.length < 2) {
                const url = new URL(window.location.href);
                url.searchParams.set('query', globalSearchInput.value);
                window.history.pushState({}, '', url);

                startSearch.classList.remove('hidden');
                listParent.classList.add('hidden');
                noResultParent.classList.add('hidden');
                return;
            }

            const actionUrl = new URL(globalSearchForm.getAttribute('action'))
            actionUrl.searchParams.set('query', globalSearchInput.value);

            fetch(actionUrl, {
                headers: {
                    'Content-Type': 'application/json',
                    "X-localization": "{{ app()->getLocale() }}",
                }
            })
                .then(response => response.json())
                .then(data => {
                    const url = new URL(window.location.href);
                    url.searchParams.set('query', globalSearchInput.value);
                    window.history.pushState({}, '', url);

                    carsList.innerHTML = '';
                    modelsList.innerHTML = '';
                    partsList.innerHTML = '';

                    startSearch.classList.add('hidden');

                    if (data.noResults) {
                        listParent.classList.add('hidden');
                        noResultParent.classList.remove('hidden');
                        noResultParent.innerHTML = data.noResults;
                        return;
                    }

                    listParent.classList.remove('hidden');
                    noResultParent.classList.add('hidden');

                    if (data.cars) {
                        carsListParent.classList.remove('hidden');
                        document.getElementById('carsList').innerHTML = data.cars
                    } else {
                        carsListParent.classList.add('hidden')
                    }

                    if (data.models) {
                        modelsListParent.classList.remove('hidden');
                        document.getElementById('modelsList').innerHTML = data.models
                    } else {
                        modelsListParent.classList.add('hidden')
                    }

                    if (data.parts) {
                        partsListParent.classList.remove('hidden');
                        document.getElementById('partsList').innerHTML = data.parts
                    } else {
                        partsListParent.classList.add('hidden')
                    }
                });
        }
    </script>
@endsection
