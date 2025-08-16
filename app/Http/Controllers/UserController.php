<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRole;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Liste paginée des utilisateurs
     */
    public function index(Request $request)
    {
        try {
            $users = User::query()
                ->when($request->role, fn($q, $role) => $q->where('role', $role))
                ->when($request->search, fn($q, $search) =>
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                )
                ->withCount(['certificats', 'messages', 'paiements', 'rapports'])
                ->orderBy('created_at', 'desc')
                ->paginate($request->per_page ?? 10);

            return response()->success($users);

        } catch (\Exception $e) {
            Log::error('UserController@index', ['error' => $e->getMessage()]);
            return response()->error('Erreur lors de la récupération des utilisateurs', 500);
        }
    }

    /**
     * Crée un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', new Enum(UserRole::class)],
            'avatar' => 'nullable|image|max:2048'
        ]);

        try {
            $data = $request->only(['nom', 'email', 'role']);
            $data['password'] = Hash::make($request->password);

            if ($request->hasFile('avatar')) {
                $data['avatar_url'] = $this->storeAvatar($request->file('avatar'));
            }

            $user = User::create($data);
            return response()->success($user, 'Utilisateur créé', 201);

        } catch (\Exception $e) {
            Log::error('UserController@store', ['error' => $e->getMessage()]);
            return response()->error('Erreur lors de la création', 500);
        }
    }

    /**
     * Affiche un utilisateur avec toutes ses relations
     */
    public function show($id)
    {
        try {
            $user = User::withAllRelations()->findOrFail($id);
            if ($user->avatar_url) {
                $user->avatar_url = asset("storage/{$user->avatar_url}");
            }
            return response()->success($user);

        } catch (ModelNotFoundException $e) {
            return response()->error('Utilisateur non trouvé', 404);
        } catch (\Exception $e) {
            Log::error('UserController@show', ['error' => $e->getMessage()]);
            return response()->error('Erreur serveur', 500);
        }
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'nom' => 'sometimes|string|max:255',
                'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
                'password' => 'sometimes|string|min:8|confirmed',
                'role' => ['sometimes', new Enum(UserRole::class)],
                'avatar' => 'nullable|image|max:2048'
            ]);

            $data = $request->only(['nom', 'email', 'role']);

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('avatar')) {
                $this->deleteAvatar($user->avatar_url);
                $data['avatar_url'] = $this->storeAvatar($request->file('avatar'));
            }

            $user->update($data);
            if ($user->avatar_url) {
                $user->avatar_url = asset("storage/{$user->avatar_url}");
            }

            return response()->success($user, 'Utilisateur mis à jour');

        } catch (ModelNotFoundException $e) {
            return response()->error('Utilisateur non trouvé', 404);
        } catch (\Exception $e) {
            Log::error('UserController@update', ['error' => $e->getMessage()]);
            return response()->error('Erreur lors de la mise à jour', 500);
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if (auth()->id() == $user->id) {
                return response()->error('Auto-suppression interdite', 403);
            }

            $user->delete();
            return response()->success(message: 'Utilisateur désactivé');

        } catch (ModelNotFoundException $e) {
            return response()->error('Utilisateur non trouvé', 404);
        } catch (\Exception $e) {
            Log::error('UserController@destroy', ['error' => $e->getMessage()]);
            return response()->error('Erreur lors de la suppression', 500);
        }
    }

    /**
     * Authentification JWT
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->error('Identifiants invalides', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        auth()->logout();
        return response()->success(message: 'Déconnexion réussie');
    }

    /**
     * Rafraîchir le token
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Profil utilisateur avec toutes les relations
     */
    public function profile()
    {
        $user = auth()->user();

    // Charger toutes les relations définies dans le modèle User
    $user->loadAllRelations();

    // S'assurer que l'avatar a le bon chemin public
    if ($user->avatar_url) {
        $user->avatar_url = asset("storage/{$user->avatar_url}");
    }

    // Retourner tous les champs de la table + relations
    return response()->json([
        'success' => true,
        'data' => $user,
    ]);
    }

    /**
     * Met à jour le profil de l'utilisateur connecté
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['nom', 'email']);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $this->deleteAvatar($user->avatar_url);
            $data['avatar_url'] = $this->storeAvatar($request->file('avatar'));
        }

        $user->update($data);
        if ($user->avatar_url) {
            $user->avatar_url = asset("storage/{$user->avatar_url}");
        }

        return response()->success($user, 'Profil mis à jour');
    }

    /**
     * Récupère une relation spécifique de l'utilisateur
     */
    private function getUserRelation($userId, $relation)
    {
        try {
            $user = User::findOrFail($userId)->load($relation);
            return response()->success($user->$relation);
        } catch (ModelNotFoundException $e) {
            return response()->error('Utilisateur non trouvé', 404);
        }
    }

    public function getUserCertificats($userId) { return $this->getUserRelation($userId, 'certificats'); }
    public function getUserMessages($userId)   { return $this->getUserRelation($userId, 'messages'); }
    public function getUserPaiements($userId)  { return $this->getUserRelation($userId, 'paiements'); }
    public function getUserRapports($userId)   { return $this->getUserRelation($userId, 'rapports'); }

    /**
     * Formatage réponse JWT
     */
    protected function respondWithToken($token)
    {
        $user = auth()->user();
        if ($user->avatar_url) {
            $user->avatar_url = asset("storage/{$user->avatar_url}");
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }

    /**
     * Stocke un avatar et retourne le chemin relatif
     */
    private function storeAvatar($file): string
    {
        return $file->store('avatars', 'public'); 
    }

    /**
     * Supprime un avatar
     */
    private function deleteAvatar(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }


    public function me(Request $request)
{
    return $this->profile();
}
}

