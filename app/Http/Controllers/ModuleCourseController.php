<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleCourse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; 

class ModuleCourseController extends Controller
{
 /**
     * GET /modules
     * Lister tous les modules
     */
    public function index()
    {
        try {
            $modules = ModuleCourse::with('course')->latest()->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $modules
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur API lors de la récupération des modules : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur'
            ], 500);
        }
    }

    /**
     * GET /modules/{id}
     * Afficher un module spécifique
     */
    public function show($id)
    {
        $module = ModuleCourse::with(['course', 'quizzes'])->find($id);
        if (!$module) {
            return response()->json(['success' => false, 'message' => 'Module introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $module]);
    }

    /**
     * POST /modules
     * Créer un nouveau module
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

        $module = ModuleCourse::create($request->all());

        return response()->json(['success' => true, 'data' => $module], 201);
    }

    /**
     * PUT /modules/{id}
     * Mettre à jour un module
     */
    public function update(Request $request, $id)
    {
        $module = ModuleCourse::find($id);
        if (!$module) {
            return response()->json(['success' => false, 'message' => 'Module introuvable'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'sometimes|required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $module->update($request->all());
        return response()->json(['success' => true, 'data' => $module]);
    }

    /**
     * DELETE /modules/{id}
     * Supprimer un module
     */
    public function destroy($id)
    {
        $module = ModuleCourse::find($id);
        if (!$module) {
            return response()->json(['success' => false, 'message' => 'Module introuvable'], 404);
        }

        $module->delete();
        return response()->json(['success' => true, 'message' => 'Module supprimé avec succès']);
    }

    /**
     * GET /modules/course/{courseId}
     * Récupérer tous les modules d’un cours spécifique
     */
    public function getModulesByCourse($courseId)
    {
        try {
            $modules = ModuleCourse::with('quizzes')
                ->where('course_id', $courseId)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $modules
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la récupération des modules du cours $courseId : " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur serveur'], 500);
        }
    }

    /**
     * GET /modules/{id}/quizzes
     * Lister tous les quizzes d’un module
     */
    public function getQuizzes($id)
    {
        $module = ModuleCourse::with('quizzes')->find($id);
        if (!$module) {
            return response()->json(['success' => false, 'message' => 'Module introuvable'], 404);
        }
        return response()->json(['success' => true, 'data' => $module->quizzes]);
    }}
