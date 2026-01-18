<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * List of supported locales
     */
    protected $supportedLocales = ['en', 'id'];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale'));
        
        if (in_array($locale, $this->supportedLocales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
