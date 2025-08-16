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
        // Validation des champs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            // Tentative d'authentification
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Identifiants invalides'], 401);
            }

            // Récupération de l'utilisateur authentifié via le token
            $user = JWTAuth::user();

        } catch (JWTException $e) {
            return response()->json(['error' => 'Impossible de créer le token'], 500);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'role' => $user->role->value ?? null,
            ],
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Déconnecté avec succès.']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Erreur lors de la déconnexion.'], 500);
        }
    }

    public function me()
    {
        try {
            $user = JWTAuth::user();
            if (!$user) {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }

            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token invalide'], 401);
        }
    }
}
