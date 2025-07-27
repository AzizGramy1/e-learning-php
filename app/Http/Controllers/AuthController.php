<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\User; 


class AuthController extends Controller
{
    /**
     * Connexion utilisateur (pour API et Web)
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember', false);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects'
            ], 401);
        }

        if (!$user->active) {
            return response()->json([
                'success' => false,
                'message' => 'Votre compte est désactivé'
            ], 403);
        }

        // Pour les requêtes API
        if ($request->wantsJson() || $request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }

        // Pour les requêtes web
        Auth::login($user, $remember);
        $request->session()->regenerate();
        
        return response()->json([
            'success' => true,
            'redirect' => route('profile'), // Ajout de la redirection
            'user' => $user,
            'message' => 'Connexion réussie'
        ]);
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout(Request $request)
    {
        // Pour les requêtes API
        if ($request->wantsJson() || $request->is('api/*')) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie'
            ]);
        }

        // Pour les requêtes web
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'redirect' => route('login'), // Redirection après déconnexion
            'message' => 'Déconnexion réussie'
        ]);
    }

    /**
     * Récupérer l'utilisateur connecté
     */
    public function me(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Non authentifié'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => $user->load('roles') // Charge les relations si nécessaire
        ]);
    }

    /**
     * Inscription utilisateur
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => true,
        ]);

        $user->assignRole('user');

        // Pour les requêtes API
        if ($request->wantsJson() || $request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 201);
        }

        // Pour les requêtes web
        Auth::login($user);
        
        return response()->json([
            'success' => true,
            'redirect' => route('profile'), // Redirection après inscription
            'user' => $user,
            'message' => 'Inscription réussie'
        ]);
    }

    /**
     * Vérifie si l'email existe déjà (pour validation frontend)
     */
    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        
        return response()->json([
            'exists' => $exists
        ]);
    }
}
