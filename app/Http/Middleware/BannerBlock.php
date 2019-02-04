<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Banner;

class BannerBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session(['banners' => Banner::with('media', 'translate')->get()]);
        return $next($request);
    }
}
