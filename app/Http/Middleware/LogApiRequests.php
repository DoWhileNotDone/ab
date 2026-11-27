<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::channel('requests')->info('API request', [
            'method' => $request->method(),
            'path' => $request->path(),
        ]);

        return $next($request);
    }
}
