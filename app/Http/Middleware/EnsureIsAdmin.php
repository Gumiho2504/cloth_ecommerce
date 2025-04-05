<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (request()->user() === null || !request()->user()->isAdmin()) {
            //dd(['401', 'Unauthorized'], request()->user()->isAdmin());
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
