<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    // Constantes pour les rôles
    const ROLE_ETUDIANT = 'etudiant';
    const ROLE_FORMATEUR = 'formateur';
    const ROLE_ADMIN = 'administrateur';

    /**
     * Liste paginée des utilisateurs (pour admin)
     * GET /api/users
     */
    public function index(Request $request)
    {
        try {
            $query = User::query();

            // Filtrage par rôle si spécifié
            if ($request->has('role')) {
                $query->where('role', $request->role);
            }

            // Recherche par nom ou email
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            }

            $users = $query->withCount(['certificats', 'messages', 'paiements', 'rapports'])
                         ->orderBy('created_at', 'desc')
                         ->paginate($request->per_page ?? 10);

            return response()->json([
                'success' => true,
                'data' => $users
            ]);

        } catch (\Exception $e) {
            Log::error('UserController@index - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des utilisateurs'
            ], 500);
        }
    }

    /**
     * Crée un nouvel utilisateur
     * POST /api/users
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mot_de_passe' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in([self::ROLE_ETUDIANT, self::ROLE_FORMATEUR, self::ROLE_ADMIN])],
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['nom', 'email', 'role']);
            $data['mot_de_passe'] = Hash::make($request->mot_de_passe);

            // Gestion de l'avatar
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $data['avatar_url'] = asset("storage/$path");
            }

            $user = User::create($data);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Utilisateur créé avec succès'
            ], 201);

        } catch (\Exception $e) {
            Log::error('UserController@store - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur'
            ], 500);
        }
    }

    /**
     * Affiche un utilisateur spécifique
     * GET /api/users/{id}
     */
    public function show($id)
    {
        try {
            $user = User::with(['certificats', 'messages.forum', 'paiements', 'rapports'])
                     ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        } catch (\Exception $e) {
            Log::error('UserController@show - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur'
            ], 500);
        }
    }

    /**
     * Met à jour un utilisateur
     * PUT /api/users/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nom' => 'sometimes|string|max:255',
                'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'mot_de_passe' => 'sometimes|string|min:8|confirmed',
                'role' => ['sometimes', Rule::in([self::ROLE_ETUDIANT, self::ROLE_FORMATEUR, self::ROLE_ADMIN])],
                'avatar' => 'nullable|image|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['nom', 'email', 'role']);

            if ($request->has('mot_de_passe')) {
                $data['mot_de_passe'] = Hash::make($request->mot_de_passe);
            }

            // Gestion de l'avatar
            if ($request->hasFile('avatar')) {
                // Supprimer l'ancien avatar si existe
                if ($user->avatar_url) {
                    $oldPath = str_replace(asset('storage/'), '', $user->avatar_url);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
                $data['avatar_url'] = asset("storage/$path");
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Utilisateur mis à jour avec succès'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        } catch (\Exception $e) {
            Log::error('UserController@update - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour'
            ], 500);
        }
    }

    /**
     * Supprime un utilisateur (soft delete)
     * DELETE /api/users/{id}
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Empêche l'auto-suppression
            if (auth()->id() == $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous ne pouvez pas supprimer votre propre compte'
                ], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur désactivé avec succès'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        } catch (\Exception $e) {
            Log::error('UserController@destroy - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }

    /**
     * Récupère le profil de l'utilisateur connecté
     * GET /api/profile
     */
    public function profile()
    {
        try {
            $user = auth()->user()->load([
                'certificats', 
                'messages.forum', 
                'paiements', 
                'rapports'
            ]);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);

        } catch (\Exception $e) {
            Log::error('UserController@profile - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du profil'
            ], 500);
        }
    }

    /**
     * Met à jour le profil de l'utilisateur connecté
     * PUT /api/profile
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();

            $validator = Validator::make($request->all(), [
                'nom' => 'sometimes|string|max:255',
                'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'mot_de_passe' => 'sometimes|string|min:8|confirmed',
                'avatar' => 'nullable|image|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['nom', 'email']);

            if ($request->has('mot_de_passe')) {
                $data['mot_de_passe'] = Hash::make($request->mot_de_passe);
            }

            // Gestion de l'avatar
            if ($request->hasFile('avatar')) {
                // Supprimer l'ancien avatar si existe
                if ($user->avatar_url) {
                    $oldPath = str_replace(asset('storage/'), '', $user->avatar_url);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('avatar')->store('avatars', 'public');
                $data['avatar_url'] = asset("storage/$path");
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Profil mis à jour avec succès'
            ]);

        } catch (\Exception $e) {
            Log::error('UserController@updateProfile - ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du profil'
            ], 500);
        }
    }


    // Méthodes pour les relations
public function getUserCertificats($userId)
{
    $user = User::with('certificats')->findOrFail($userId);
    return response()->json($user->certificats);
}

public function getUserMessages($userId)
{
    $user = User::with('messages')->findOrFail($userId);
    return response()->json($user->messages);
}

public function getUserPaiements($userId)
{
    $user = User::with('paiements')->findOrFail($userId);
    return response()->json($user->paiements);
}

public function getUserRapports($userId)
{
    $user = User::with('rapports')->findOrFail($userId);
    return response()->json($user->rapports);
}   
}