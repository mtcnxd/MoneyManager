<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth()->user()->isAdmin){
            // redirect to front if the username is not admin
            return to_route('login')
                ->with('message', 'The email you are trying to access is not admin');
        }

        return $next($request);
    }
}
