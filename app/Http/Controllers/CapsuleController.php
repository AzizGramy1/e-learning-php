<?php

namespace App\Http\Controllers;
use App\Models\Capsule;
use App\Models\Course;  

use Illuminate\Http\Request;

class CapsuleController extends Controller
{
    /**
     * GET /capsules
     * Lister toutes les capsules avec pagination
     */
    public function index()
    {
        try {
            $capsules = Capsule::with(['course', 'unities', 'quizzes'])->latest()->paginate(10);
            return response()->json(['success' => true, 'data' => $capsules]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la récupération des capsules : " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur serveur'], 500);
        }
    }

    /**
     * GET /capsules/{id}
     * Afficher une capsule spécifique
     */
    public function show($id)
    {
        $capsule = Capsule::with(['course', 'unities', 'quizzes'])->find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $capsule]);
    }

    /**
     * GET /capsules/course/{courseId}
     * Récupérer toutes les capsules d’un cours
     */
    public function getByCourse($courseId)
    {
        $course = Course::find($courseId);
        if (!$course) {
            return response()->json(['success' => false, 'message' => 'Cours introuvable'], 404);
        }

        $capsules = Capsule::where('course_id', $courseId)->with(['unities', 'quizzes'])->get();
        return response()->json(['success' => true, 'data' => $capsules]);
    }

    /**
     * POST /capsules
     * Créer une nouvelle capsule
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $capsule = Capsule::create($request->all());
        return response()->json(['success' => true, 'data' => $capsule], 201);
    }

    /**
     * PUT /capsules/{id}
     * Mettre à jour une capsule
     */
    public function update(Request $request, $id)
    {
        $capsule = Capsule::find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'sometimes|required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $capsule->update($request->all());
        return response()->json(['success' => true, 'data' => $capsule]);
    }

    /**
     * DELETE /capsules/{id}
     * Supprimer une capsule
     */
    public function destroy($id)
    {
        $capsule = Capsule::find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }

        $capsule->delete();
        return response()->json(['success' => true, 'message' => 'Capsule supprimée avec succès']);
    }

    /**
     * GET /capsules/search
     * Recherche avancée par titre ou description
     */
    public function search(Request $request)
    {
        $query = Capsule::query();

        if ($request->has('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'LIKE', '%' . $request->description . '%');
        }

        $results = $query->with(['course', 'unities', 'quizzes'])->get();
        return response()->json(['success' => true, 'data' => $results]);
    }

    /**
     * GET /capsules/{id}/unities
     * Récupérer les unités d’une capsule
     */
    public function getUnities($id)
    {
        $capsule = Capsule::with('unities')->find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $capsule->unities]);
    }

    /**
     * GET /capsules/{id}/quizzes
     * Récupérer les quiz d’une capsule
     */
    public function getQuizzes($id)
    {
        $capsule = Capsule::with('quizzes')->find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $capsule->quizzes]);
    }

    /**
     * GET /capsules/{id}/stats
     * Statistiques d’une capsule (nb d’unités et nb de quiz)
     */
    public function getStats($id)
    {
        $capsule = Capsule::with(['unities', 'quizzes'])->find($id);
        if (!$capsule) {
            return response()->json(['success' => false, 'message' => 'Capsule introuvable'], 404);
        }

        $stats = [
            'nb_unities' => $capsule->unities->count(),
            'nb_quizzes' => $capsule->quizzes->count(),
        ];

        return response()->json(['success' => true, 'data' => $stats]);
    }
}
