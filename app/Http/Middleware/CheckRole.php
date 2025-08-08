<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate(); // Récupère l'utilisateur via JWT
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Authentification requise'], 401);
        }

        if (!$user || !in_array($user->role->value, $roles)) {
            $rolesList = implode(', ', $roles);
            return response()->json([
                'error' => "Rôle requis : $rolesList (Votre rôle : " . ($user ? $user->role->value : 'non authentifié') . ")"
            ], 403);
        }

        return $next($request);
    }
}