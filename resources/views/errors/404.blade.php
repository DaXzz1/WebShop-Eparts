@extends('layouts.app')

@section('title', __('pages.404.title'))

@section('content')
    <div class="p-4 text-center flex flex-col justify-center h-full items-center">
        <div class="p-4 bg-error/20 flex items-center justify-center rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-error">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
        </div>

        <span class="text-3xl font-bold text-gray-800 mt-5">
            @lang('pages.404.content.title')
        </span>

        <p class="text-xl text-gray-600">@lang('pages.404.content.description')</p>

        <a href="{{ route('home') }}" class="btn btn-primary mt-4 w-full md:w-auto">@lang('pages.404.content.back_to_home')</a>
    </div>
@endsection
