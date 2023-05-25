<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as RequestAlias;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param RequestAlias $request
     * @param Closure $next
     * @return Response|RedirectResponse|JsonResponse|BinaryFileResponse
     */
    public function handle(RequestAlias $request, Closure $next): Response|RedirectResponse|JsonResponse|BinaryFileResponse
    {
        $cookie = null;

        if (str_contains($request->url(), "admin")) {
            app()->setLocale("en");
            $cookie = cookie('locale', 'en', 60 * 24 * 30);
        } else {
            $locale = $request->hasHeader('X-localization') ?
                $request->header('X-localization') :
                config('app.fallback_locale');

            app()->setLocale($locale);
            $cookie = cookie('locale', $locale, 60 * 24 * 30);

            if (Session::has("locale")) {
                app()->setLocale(Session::get("locale"));
                $cookie = cookie('locale', Session::get("locale"), 60 * 24 * 30);
            }
        }

        $response = $next($request);
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        return $response->withCookie($cookie);
    }
}
