<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            try {
                auth()->user()->update([
                    'last_activity' => now(),
                    'last_ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            } catch (\Exception $e) {
                Log::error('Erreur journalisation activité: '.$e->getMessage());
            }
        }

        return $next($request);
    }
}