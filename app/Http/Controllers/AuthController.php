<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\User; 
use App\Enums\UserRole; 

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    
    
public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $credentials = $request->only('email', 'password');

    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        $user = Auth::user();
        $customClaims = ['role' => $user->role->value, 'nom' => $user->nom];
        $newToken = JWTAuth::fromUser($user, $customClaims); // Génère un nouveau token avec les claims
    } catch (JWTException $e) {
        return response()->json(['error' => 'Impossible de créer le token'], 500);
    }

    return response()->json([
        'access_token' => $newToken,
        'user' => [
            'id' => $user->id,
            'nom' => $user->nom,
            'email' => $user->email,
            'role' => $user->role->value,
        ],
    ]);
}

        public function logout()
        {
            try {
                if (!Auth::guard('api')->check()) {
                    return response()->json(['error' => 'Aucun utilisateur connecté'], 401);
                }

                Auth::guard('api')->logout();
                return response()->json(['message' => 'Déconnecté avec succès.']);
            } catch (JWTException $e) {
                return response()->json(['error' => 'Erreur lors de la déconnexion.'], 500);
            }
        }

        public function me()
        {
            try {
                $user = Auth::guard('api')->user();
                if (!$user) {
                    return response()->json(['error' => 'Utilisateur non authentifié'], 401);
                }

                return response()->json([
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'email' => $user->email,
                    'role' => $user->role->value,
                ]);
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token invalide'], 401);
            }
        }

}
