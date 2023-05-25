<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Pluralizer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function toggleLanguage(string $locale) {
        app()->setLocale($locale);
        session()->put("locale", $locale);

        $availableLocales = config('app.available_locales');
        $locale = $availableLocales[$locale] ?? $availableLocales['et'];

        Pluralizer::useLanguage('spanish');
        return redirect()->back();
    }
}
