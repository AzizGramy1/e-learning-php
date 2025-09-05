<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Progress;
use App\Models\Note;
use App\Models\ModuleCours;

class CoursController extends Controller
{

/**
     * Afficher la liste de tous les cours
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Créer un nouveau cours
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'categorie' => 'nullable|string',
            'difficulte' => 'nullable|string',
            'note' => 'nullable|numeric|min:0|max:5',
            'statut' => 'nullable|string',
            'duree_totale' => 'nullable|string',
            'chapitres_total' => 'nullable|integer',
            'chapitres_completes' => 'nullable|integer',
            'progression' => 'nullable|integer|min:0|max:100',
            'certificat_obtenu' => 'boolean',
            'auteur' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $course = Course::create($validated);

        return response()->json([
            'message' => 'Cours créé avec succès',
            'data' => $course
        ], 201);
    }

    /**
     * Afficher un cours spécifique
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    /**
     * Mettre à jour un cours
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'categorie' => 'nullable|string',
            'difficulte' => 'nullable|string',
            'note' => 'nullable|numeric|min:0|max:5',
            'statut' => 'nullable|string',
            'duree_totale' => 'nullable|string',
            'chapitres_total' => 'nullable|integer',
            'chapitres_completes' => 'nullable|integer',
            'progression' => 'nullable|integer|min:0|max:100',
            'certificat_obtenu' => 'boolean',
            'auteur' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $course->update($validated);

        return response()->json([
            'message' => 'Cours mis à jour avec succès',
            'data' => $course
        ]);
    }

    /**
     * Supprimer un cours
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Cours supprimé avec succès']);
    }

    /**
     * Inscrire un utilisateur à un cours
     */
    public function inscrire(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $userId = $request->input('user_id');

        $user = User::findOrFail($userId);

        $course->etudiants()->attach($userId, [
            'progression' => 0,
            'date_inscription' => now(),
        ]);

        return response()->json(['message' => 'Utilisateur inscrit avec succès']);
    }

    /**
     * Désinscrire un utilisateur d’un cours
     */
    public function desinscrire($courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $course->etudiants()->detach($userId);

        return response()->json(['message' => 'Utilisateur désinscrit avec succès']);
    }

    /**
     * Liste des étudiants inscrits à un cours
     */
    public function getEtudiants($courseId)
    {
        $course = Course::findOrFail($courseId);
        return response()->json($course->etudiants);
    }

    /**
     * Récupérer les cours auxquels un utilisateur est inscrit
     */
    public function getCoursesByUser($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->courses);
    }

    /**
     * Détails complets d’un cours (avec option user_id pour savoir si inscrit)
     */
    public function detail($id, Request $request)
    {
        $course = Course::with('etudiants')->findOrFail($id);
        $userId = $request->input('user_id');

        $isInscrit = false;
        if ($userId) {
            $isInscrit = $course->etudiants()->where('user_id', $userId)->exists();
        }

        return response()->json([
            'course' => $course,
            'isInscrit' => $isInscrit
        ]);
    }}