<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiBrowserCheck
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
        $userAgent = $request->header('User-Agent');

        if ($this->isWebBrowser($userAgent)) {
            return response()->json(['error' => 'Forbidden Request'], 403);
        }

        return $next($request);
    }

    private function isWebBrowser($userAgent)
    {
        $browserPatterns = [
            '/(Mozilla|AppleWebKit|Chrome|Safari|Firefox|Edge|IE|Opera)/i', // Common browser identifiers
            '/(Windows NT|Macintosh|Linux|X11)/i', // Common operating systems
        ];

        // Check if any of the patterns match the User-Agent header
        foreach ($browserPatterns as $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return true; // It's a web browser
            }
        }

        return false; // It's not a web browser
    }
}
