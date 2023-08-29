<?php

namespace App\Http\Middleware\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IncreasePostMaxSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        ini_set('post_max_size', '5000M');
        ini_set('upload_max_filesize', '5000M');
        return $next($request);
    }
}
