<div class="col-span-7 flex flex-col items-center gap-3">
    <div class="p-4 rounded-full bg-secondary/20">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-primary-focus">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>

    <div class="flex flex-col justify-center items-center mt-1">
        <span class="text-2xl font-bold">@lang('errors.api.global_search.title')</span>
        <span class="text-lg text-gray-500 font-medium">@lang('errors.api.global_search.description', ['query' => $search])</span>
    </div>
</div>
