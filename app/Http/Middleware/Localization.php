<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Session;
use App;
use Jenssegers\Date\Date;

class Localization
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
        if (session('locale')) {
            App::setLocale(session('locale'));
        } else {
            session(['locale' => App::getLocale()]);
        }

        if (\Request::is('admin/*')) {
            App::setLocale('ua');
            session(['locale' => 'ua']);
        }

        Date::setLocale(session('locale'));

        if (session('locale') === 'ua') {
            Date::setLocale('uk');

        }

        return $next($request);
    }
}
