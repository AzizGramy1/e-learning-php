<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Quiz;    
use App\Models\Cours;
use App\Models\Message;
use App\Models\User;
use App\Models\Certificat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class QuizController extends Controller
{


    public function indexView()
    {
        $quizzes = Quiz::all();
        return view('quizView', compact('quizzes'));
    }

     // GET /quizzes
    public function index()
{
    try {
        $quizzes = Quiz::with(['cours:id,titre', 'certificat:id,nom'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $quizzes
        ]);
    } catch (\Exception $e) {
        Log::error("Erreur API lors de la récupération des quiz : " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Erreur serveur'
        ], 500);
    }
}

    // POST /quizzes
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cours_id' => 'required|exists:courses,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'passage_max' => 'required|integer|min:1',
            'note_minimale' => 'required|numeric|min:0|max:100',
            'est_actif' => 'required|boolean',
            'date_ouverture' => 'required|date',
            'date_fermeture' => 'required|date|after_or_equal:date_ouverture',
            'aleatoire_questions' => 'required|boolean',
            'correction_auto' => 'required|boolean',
            'certificat_id' => 'nullable|exists:certificats,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $quiz = Quiz::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $quiz
        ], 201);
    }

    // GET /quizzes/{id}
    public function show($id)
    {
        $quiz = Quiz::with(['cours', 'certificat', 'questions'])->find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz introuvable'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $quiz
        ]);
    }

    // PUT /quizzes/{id}
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz non trouvé'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'cours_id' => 'sometimes|required|exists:courses,id',
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'sometimes|required|integer|min:1',
            'passage_max' => 'sometimes|required|integer|min:1',
            'note_minimale' => 'sometimes|required|numeric|min:0|max:100',
            'est_actif' => 'sometimes|required|boolean',
            'date_ouverture' => 'sometimes|required|date',
            'date_fermeture' => 'sometimes|required|date|after_or_equal:date_ouverture',
            'aleatoire_questions' => 'sometimes|required|boolean',
            'correction_auto' => 'sometimes|required|boolean',
            'certificat_id' => 'nullable|exists:certificats,id'
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $quiz->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $quiz
        ]);
    }

    // DELETE /quizzes/{id}
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz non trouvé'
            ], 404);
        }

        $quiz->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quiz supprimé avec succès'
        ]);
    }
}
