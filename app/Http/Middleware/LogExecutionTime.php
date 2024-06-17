<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogExecutionTime
{
    public function handle($request, Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $end = microtime(true);
        $executionTime = ($end - $start);

        Log::info('Execution Time: ' . $executionTime . ' seconds');

        return $response;
    }
}
