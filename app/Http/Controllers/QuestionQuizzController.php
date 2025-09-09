<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuestionQuizz;
use Illuminate\Support\Facades\Validator;   

class QuestionQuizzController extends Controller
{
     /**
     * Liste toutes les questions d’un quiz
     */
    public function index($quizId)
    {
        $quiz = Quiz::with('questions')->find($quizId);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz introuvable'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $quiz->questions
        ]);
    }

    /**
     * Ajouter une question à un quiz
     */
    public function store(Request $request, $quizId)
    {
        $validator = Validator::make($request->all(), [
            'intitule' => 'required|string',
            'type' => 'required|string|in:QCM,VF,TEXTE',
            'points' => 'required|integer|min:1',
            'options' => 'nullable|array',
            'reponse_correcte' => 'required',
            'reponse_1' => 'nullable|string',
            'reponse_2' => 'nullable|string',
            'reponse_3' => 'nullable|string',
            'reponse_4' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $quiz = Quiz::find($quizId);
        if (!$quiz) {
            return response()->json(['success' => false, 'message' => 'Quiz introuvable'], 404);
        }

        $question = $quiz->questions()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $question
        ], 201);
    }

    /**
     * Afficher une seule question
     */
    public function show($quizId, $id)
    {
        $question = QuestionQuizz::where('quiz_id', $quizId)->find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question introuvable'
            ], 404);
        }

        return response()->json(['success' => true, 'data' => $question]);
    }

    /**
     * Modifier une question
     */
    public function update(Request $request, $quizId, $id)
    {
        $question = QuestionQuizz::where('quiz_id', $quizId)->find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question introuvable'
            ], 404);
        }

        $question->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $question
        ]);
    }

    /**
     * Supprimer une question
     */
    public function destroy($quizId, $id)
    {
        $question = QuestionQuizz::where('quiz_id', $quizId)->find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question introuvable'
            ], 404);
        }

        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Question supprimée avec succès'
        ]);
    }

    /**
     * Vérifier une réponse utilisateur
     */
    public function checkAnswer(Request $request, $quizId, $id)
    {
        $request->validate([
            'reponse' => 'required|string'
        ]);

        $question = QuestionQuizz::where('quiz_id', $quizId)->find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question introuvable'
            ], 404);
        }

        $userAnswer = trim($request->input('reponse'));

        $correctAnswers = is_array($question->reponse_correcte)
            ? $question->reponse_correcte
            : [$question->reponse_correcte];

        $isCorrect = in_array($userAnswer, $correctAnswers);

        return response()->json([
            'success' => true,
            'question_id' => $question->id,
            'userAnswer' => $userAnswer,
            'correct' => $isCorrect,
            'expected' => $correctAnswers,
            'points' => $isCorrect ? $question->points : 0,
            'options' => [
                $question->reponse_1,
                $question->reponse_2,
                $question->reponse_3,
                $question->reponse_4,
            ]
        ]);
    }
}
