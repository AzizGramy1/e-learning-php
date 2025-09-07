<?php

namespace App\Http\Controllers;
use App\Models\Unity;
use App\Models\Capsule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;   

use Illuminate\Http\Request;

class UnityController extends Controller
{
    /**
     * GET /unities
     * Lister toutes les unités avec pagination
     */
    public function index()
    {
        try {
            $unities = Unity::with('capsule')->latest()->paginate(10);
            return response()->json(['success' => true, 'data' => $unities]);
        } catch (\Exception $e) {
            Log::error("Erreur API lors de la récupération des unités : " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur serveur'], 500);
        }
    }

    /**
     * GET /unities/{id}
     * Afficher une unité spécifique
     */
    public function show($id)
    {
        $unity = Unity::with('capsule')->find($id);
        if (!$unity) {
            return response()->json(['success' => false, 'message' => 'Unité introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $unity]);
    }

    /**
     * GET /unities/capsule/{capsuleId}
     * Récupérer toutes les unités d’une capsule
     */
    public function getByCapsule($capsuleId)
    {
        $capsule = Capsule::find($capsuleId);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }

        $unities = Unity::where('capsule_id', $capsuleId)->get();
        return response()->json(['success' => true, 'data' => $unities]);
    }

    /**
     * POST /unities
     * Créer une nouvelle unité
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video,image,code',
            'content' => 'nullable|string',
            'capsule_id' => 'required|exists:capsules,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $unity = Unity::create($request->all());
        return response()->json(['success' => true, 'data' => $unity], 201);
    }

    /**
     * PUT /unities/{id}
     * Mettre à jour une unité
     */
    public function update(Request $request, $id)
    {
        $unity = Unity::find($id);
        if (!$unity) {
            return response()->json(['success' => false, 'message' => 'Unité introuvable'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:pdf,video,image,code',
            'content' => 'nullable|string',
            'capsule_id' => 'sometimes|required|exists:capsules,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $unity->update($request->all());
        return response()->json(['success' => true, 'data' => $unity]);
    }

    /**
     * DELETE /unities/{id}
     * Supprimer une unité
     */
    public function destroy($id)
    {
        $unity = Unity::find($id);
        if (!$unity) {
            return response()->json(['success' => false, 'message' => 'Unité introuvable'], 404);
        }

        $unity->delete();
        return response()->json(['success' => true, 'message' => 'Unité supprimée avec succès']);
    }

    /**
     * GET /unities/search
     * Recherche avancée par titre, type ou contenu
     */
    public function search(Request $request)
    {
        $query = Unity::query();

        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('content')) {
            $query->where('content', 'LIKE', '%' . $request->content . '%');
        }

        $results = $query->with('capsule')->get();

        return response()->json(['success' => true, 'data' => $results]);
    }

    /**
     * GET /unities/capsule/{capsuleId}/count
     * Compter le nombre d’unités d’une capsule
     */
    public function countByCapsule($capsuleId)
    {
        $count = Unity::where('capsule_id', $capsuleId)->count();
        return response()->json(['success' => true, 'count' => $count]);
    }

    /**
     * GET /unities/type/{type}
     * Récupérer toutes les unités par type (pdf, video, image, code)
     */
    public function getByType($type)
    {
        $allowedTypes = ['pdf', 'video', 'image', 'code'];
        if (!in_array($type, $allowedTypes)) {
            return response()->json(['success' => false, 'message' => 'Type invalide'], 400);
        }

        $unities = Unity::where('type', $type)->get();
        return response()->json(['success' => true, 'data' => $unities]);
    }
}
