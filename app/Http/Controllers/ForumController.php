<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum; 
use App\Models\Cours;
use App\Models\Message;
use App\Models\User; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ForumController extends Controller
{
    /**
     * Affiche la liste des forums paginés
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
{
    try {
        $forums = Forum::with(['cours', 'utilisateur', 'messages'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $forums
        ]);

    } catch (\Exception $e) {
        Log::error('Erreur de récupération des forums : ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'Impossible de charger les forums'
        ], 500);
    }
}
    /**
     * Crée un nouveau forum
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'cours_id' => 'required|exists:cours,id',
            'utilisateur_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $forum = Forum::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'cours_id' => $request->cours_id,
                'utilisateur_id' => $request->utilisateur_id
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $forum->load(['cours', 'utilisateur']),
                'message' => 'Forum créé avec succès'
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur création forum: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création du forum'
            ], 500);
        }
    }

    /**
     * Affiche un forum spécifique avec ses relations
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $forum = Forum::with(['cours', 'utilisateur', 'messages'])
                      ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $forum
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forum non trouvé'
            ], 404);
        }
    }

    /**
     * Met à jour un forum existant
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'cours_id' => 'sometimes|exists:cours,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $forum = Forum::findOrFail($id);
            
            $forum->update($request->only(['titre', 'description', 'cours_id']));

            return response()->json([
                'status' => 'success',
                'data' => $forum->refresh()->load(['cours', 'utilisateur']),
                'message' => 'Forum mis à jour'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour forum: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour'
            ], 500);
        }
    }

    /**
     * Supprime un forum
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $forum = Forum::findOrFail($id);
            $forum->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Forum supprimé'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur suppression forum: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }

    /**
     * Récupère les forums d'un cours spécifique
     *
     * @param  string  $coursId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byCours($coursId)
    {
        try {
            $forums = Forum::with(['utilisateur', 'messages'])
                        ->where('cours_id', $coursId)
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $forums
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur récupération forums par cours: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }

    /**
     * Récupère les forums créés par un utilisateur
     *
     * @param  string  $utilisateurId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byUtilisateur($utilisateurId)
    {
        try {
            $forums = Forum::with(['cours', 'messages'])
                        ->where('utilisateur_id', $utilisateurId)
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $forums
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur récupération forums par utilisateur: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }


    public function showMessages($forumId)
{
    try {
        $messages = Message::with('utilisateur')
            ->where('forum_id', $forumId)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ]);
    } catch (\Exception $e) {
        Log::error('Erreur récupération messages: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur'
        ], 500);
    }
    }

    /**
     * Récupère les messages d'un forum spécifique
     *
     * @param  string  $forumId
     * @return \Illuminate\Http\JsonResponse
     */
    public function messagesByForum($forumId)
    {
        try {
            $messages = Message::with(['forum', 'utilisateur'])
                        ->where('forum_id', $forumId)
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur récupération messages par forum: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }
    /**
     * Récupère les messages d'un utilisateur spécifique
     *
     * @param  string  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function messagesByUser($userId)
    {
        try {
            $messages = Message::with(['forum', 'utilisateur'])
                        ->where('utilisateur_id', $userId)
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur récupération messages par utilisateur: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }
    /**
     * Récupère les forums d'un utilisateur spécifique
     *
     * @param  string  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function forumsByUser($userId)   
    {
        try {
            $forums = Forum::with(['cours', 'messages'])
                        ->where('utilisateur_id', $userId)
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $forums
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur récupération forums par utilisateur: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }          
}