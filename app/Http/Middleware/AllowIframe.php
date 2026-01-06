<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowIframe
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

        $allowedDomains = config('iframe.allowed_domains');

        // Remove default Laravel frame blocking
        $response->headers->remove('X-Frame-Options');

        // Build CSP frame-ancestors
        $domains = implode(' ', array_map('escapeshellarg', $allowedDomains));

        $response->headers->set(
            'Content-Security-Policy',
            "frame-ancestors 'self' $domains"
        );

        return $response;
    }
}
