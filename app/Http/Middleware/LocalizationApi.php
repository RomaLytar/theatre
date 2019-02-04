<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Session;
use App;
use Jenssegers\Date\Date;

class LocalizationApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($lang = $request->input('lang')) {
            App::setLocale($lang);
        } else {
            session(['locale' => App::getLocale()]);
        }

        Date::setLocale($lang ?? App::getLocale());

        if ($lang === 'ua') {
            Date::setLocale('uk');
        }

        return $next($request);
    }
}
