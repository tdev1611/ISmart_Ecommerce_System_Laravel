<?php

namespace App\Http\Middleware;
use Illuminate\Support\Str;

use Closure;
use Illuminate\Http\Request;

class AddHtmlExtension
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
        $response = $next($request);

        if ($response->status() === 404 && !Str::contains($request->getRequestUri(), '.')) {
            $url = $request->getRequestUri() . '.html';
            return redirect($url, 301);
        }
    
        return $response;
    }
}
