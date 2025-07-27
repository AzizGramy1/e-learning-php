<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Authentification requise');
        }

        if (!in_array($user->role, $roles)) {
            $rolesList = implode(', ', $roles);
            abort(403, "Rôle requis : $rolesList (Votre rôle : $user->role)");
        }

        return $next($request);
    }
}