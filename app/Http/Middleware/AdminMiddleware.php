<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "a"){
            return $next($request);
        }else{
            return response()->json([
                'response' => 'unauthorized',
                'status' => 404,
                'message' => 'Not a dev mode account credential',
            ], 404);
        }
    }
}
