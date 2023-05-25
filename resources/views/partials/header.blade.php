<div class="bg-base-100 w-full fixed top-0 left-0 z-[2] border-b border-b-base-300 shadow">
    <div class="navbar container items-center mx-auto hidden lg:flex">
        <div class="navbar-start">
            <a href="{{ route('home') }}" class="btn btn-ghost font-semibold normal-case text-xl"><span
                    class="text-primary">E</span>parts</a>
        </div>

        @include("partials.search")

        <div class="navbar-end">
            <div class="dropdown dropdown-end ml-3">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(count(session()->get('cart', [])) > 0)
                            <span class="badge badge-sm indicator-item">{{ count(session()->get('cart')) }}</span>
                        @endif
                    </div>
                </label>

                <div tabindex="0" class="mt-3 card card-compact dropdown-content w-72 bg-base-100 shadow">
                    <div class="card-body">
                        @if(count(session()->get('cart', [])) > 0)
                            <span class="font-bold text-lg">
                                    {{ count(session()->get('cart')) }} @choice(__('cart.popup.countChoice'), count(session()->get('cart')))
                                </span>

                            <span>@lang('cart.popup.subtotal', ['count' => money(array_sum(array_map(function($part) { return $part['price'] * $part['count']; }, session()->get('cart'))), 'EUR', true)])</span>

                            <div class="card-actions">
                                <a href="{{ route('cart.index') }}"
                                   class="btn btn-primary btn-sm btn-block">@lang('cart.button.view')</a>
                            </div>
                        @else
                            <span class="font-bold text-lg">{{ __('cart.popup.empty') }}</span>
                            <div class="card-actions">
                                <a href="{{ route('cart.index') }}"
                                   class="btn btn-primary btn-sm btn-block">@lang('cart.button.open')</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->user())
                <div class="dropdown dropdown-end ml-5">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img class="lazy-image" data-src="{{asset('images/users/' . auth()->user()->avatar)}}"/>
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                        <div class="p-2 pb-2 mb-2 border-b border-b-gray-300">
                            <span
                                class="text-sm line-clamp-2">@lang('header.dropdown.welcome', ['name' => auth()->user()->name])</span>
                        </div>

                        @if(auth()->user() && auth()->user()->canAccessFilament())
                            <li>
                                <a class="font-medium gap-2" href="{{ route('filament.pages.dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/>
                                    </svg>
                                    @lang('header.dropdown.filament')
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="font-medium gap-2" href="{{ route('profile.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>

                                @lang('header.dropdown.my_profile')
                            </a>
                        </li>

                        <li>
                            <a class="font-medium gap-2" href="{{ route('profile.orders') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                </svg>
                                @lang('header.dropdown.my_orders')
                            </a>
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="font-medium text-error flex gap-2" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                    </svg>

                                    @lang('header.dropdown.logout')
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="flex gap-3 ml-5">
                    <a href="{{ route('login') }}"
                       class="btn btn-primary btn-outline btn-sm">@lang('header.auth.login')</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">@lang('header.auth.register')</a>
                </div>
            @endif
        </div>
    </div>

    <nav class="p-3 flex lg:hidden w-full">
        <div class="flex flex-wrap items-center justify-between w-full">
            <a class="flex items-center" href="{{ route('home') }}">
                <span class="self-center text-xl font-semibold whitespace-nowrap ">Eparts</span>
            </a>
            <button data-collapse-toggle="navbar-hamburger" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-hamburger" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden w-full" id="navbar-hamburger">
                @if(auth()->user())
                    <div class="flex p-2 gap-3 items-center">
                        <img data-src="{{ asset('images/users/' . auth()->user()->avatar) }}" alt="Logo" class="w-10 h-10 rounded-full aspect-square lazy-image">

                        <span
                            class="line-clamp-2">@lang('header.dropdown.welcome', ['name' => auth()->user()->name])</span>

                        @if(auth()->user())
                            <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                                @csrf
                                <button type="submit"
                                        class="btn btn-error btn-outline btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                    </svg>
                                    @lang('header.dropdown.logout')
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                <ul class="flex flex-col mt-4 rounded-lg mt-2 pt-2 border-t border-t-primary">
                    <li>
                        <a href="{{ route('home') }}"
                           class="flex gap-2 py-2 pl-3 pr-4 text-[#181830] transition-colors duration-250 rounded hover:bg-[#e0a82e]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                            </svg>
                            @lang('header.dropdown.main')
                        </a>
                    </li>

                    @if(auth()->user() && auth()->user()->canAccessFilament())
                        <li>
                            <a href="{{ route('filament.pages.dashboard') }}"
                               class="flex gap-2 py-2 pl-3 pr-4 text-[#181830] transition-colors duration-250 rounded hover:bg-[#e0a82e]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/>
                                </svg>
                                @lang('header.dropdown.filament')
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('cart.index') }}"
                           class="flex gap-2 py-2 pl-3 pr-4 text-[#181830] transition-colors duration-250 rounded hover:bg-[#e0a82e]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @lang('header.dropdown.cart')

                            @if(count(session()->get('cart', [])) > 0)
                                <span
                                    class="badge badge-primary badge-lg indicator-item ml-auto">{{ count(session()->get('cart')) }}</span>
                            @endif
                        </a>
                    <li>

                    @if(auth()->user())
                        <li>
                            <a
                                class="flex gap-2 py-2 pl-3 pr-4 text-[#181830] transition-colors duration-250 rounded hover:bg-[#e0a82e]"
                                href="{{ route('profile.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>

                                @lang('header.dropdown.my_profile')
                            </a>
                        </li>

                        <li>
                            <a
                                class="flex gap-2 py-2 pl-3 pr-4 text-[#181830] transition-colors duration-250 rounded hover:bg-[#e0a82e]"
                                href="{{ route('profile.orders') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                </svg>
                                @lang('header.dropdown.my_orders')
                            </a>
                        </li>
                    @endif
                </ul>

                @if(!auth()->user())
                    <div class="flex flex-col gap-3 mt-4 pt-4 border-t border-t-primary">
                        <span class="text-sm text-gray-500 text-center">@lang('header.auth.text')</span>

                        <div class="flex gap-3 items-center justify-center">
                            <a href="{{ route('login') }}"
                               class="btn btn-primary btn-outline btn-sm">@lang('header.auth.login')</a>
                            <a href="{{ route('register') }}"
                               class="btn btn-primary btn-sm">@lang('header.auth.register')</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="bg-base-200 hidden md:flex">
        <div class="container mx-auto">
            @yield('breadcrumbs')
        </div>
    </div>
</div>
