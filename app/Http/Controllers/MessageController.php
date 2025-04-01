<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Forum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Affiche la liste des messages paginés
     */
    public function index()
    {
        try {
            $messages = Message::with(['forum', 'utilisateur'])
                        ->latest()
                        ->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des messages: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur'
            ], 500);
        }
    }

    /**
     * Crée un nouveau message dans un forum
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenu' => 'required|string|max:1000',
            'forum_id' => 'required|exists:forums,id',
            'utilisateur_id' => 'required|exists:utilisateurs,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Vérifier que le forum existe
            $forum = Forum::findOrFail($request->forum_id);

            $message = Message::create([
                'forum_id' => $request->forum_id,
                'utilisateur_id' => $request->utilisateur_id,
                'contenu' => $request->contenu
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $message->load(['forum', 'utilisateur']),
                'message' => 'Message créé avec succès'
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur création message: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création du message'
            ], 500);
        }
    }

    /**
     * Affiche un message spécifique
     */
    public function show(string $id)
    {
        try {
            $message = Message::with(['forum', 'utilisateur'])
                         ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message non trouvé'
            ], 404);
        }
    }

    /**
     * Met à jour le contenu d'un message
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'contenu' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $message = Message::findOrFail($id);
            
            // Seul le contenu peut être modifié
            $message->update([
                'contenu' => $request->contenu
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $message,
                'message' => 'Message mis à jour'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour message: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour'
            ], 500);
        }
    }

    /**
     * Supprime un message
     */
    public function destroy(string $id)
    {
        try {
            $message = Message::findOrFail($id);
            $message->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Message supprimé'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur suppression message: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }
}