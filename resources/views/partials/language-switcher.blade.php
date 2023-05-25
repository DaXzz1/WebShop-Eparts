@php
    $locale = $available_locales[app()->getLocale()];

    unset($available_locales[app()->getLocale()]);
@endphp

<div class="dropdown dropdown-top dropdown-end mt-5 w-full">
    <label tabindex="0" class="btn btn-ghost btn-circle w-auto flex gap-2 px-3">
        <img data-src="{{ asset('images/flags/' . app()->getLocale(). '.png') }}" alt="{{ $locale['native'] }}"
             class="w-6 h-4 lazy-image"/>
        <span>{{ $locale['native'] }}</span>
    </label>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-[240px] mt-6">
        @foreach($available_locales as $locale => $available_locale)
            <li>
                <a href="{{ route('language', $locale) }}" class="flex items-center">
                    <img data-src="{{ asset('images/flags/' . $locale . '.png') }}" alt="{{ $available_locale['native'] }}"
                         class="w-6 h-4 lazy-image"/>
                    <span class="ml-1 font-medium">{{ $available_locale['native'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
