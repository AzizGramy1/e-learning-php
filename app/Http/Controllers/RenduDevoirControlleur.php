<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RenduDevoir;
use App\Models\Devoir;
use Illuminate\Support\Facades\Validator;


class RenduDevoirControlleur extends Controller
{
    /**
     * Afficher tous les rendus
     */
    public function index()
    {
        $rendus = RenduDevoir::with(['devoir', 'etudiant'])->get();
        return response()->json($rendus);
    }

    /**
     * Ajouter un rendu
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'devoir_id' => 'required|exists:devoirs,id',
            'user_id' => 'required|exists:users,id',
            'fichier_url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Récupérer le devoir pour vérifier la deadline
        $devoir = Devoir::find($request->devoir_id);
        $etat = now()->greaterThan($devoir->date_limite) ? 'en_retard' : 'en_attente';

        $rendu = RenduDevoir::create([
            'devoir_id' => $request->devoir_id,
            'user_id' => $request->user_id,
            'fichier_url' => $request->fichier_url,
            'date_soumission' => now(),
            'etat' => $etat,
        ]);

        return response()->json(['message' => 'Rendu ajouté avec succès', 'rendu' => $rendu]);
    }

    /**
     * Afficher un rendu spécifique
     */
    public function show($id)
    {
        $rendu = RenduDevoir::with(['devoir', 'etudiant'])->findOrFail($id);
        return response()->json($rendu);
    }

    /**
     * Modifier un rendu (ex: remplacer fichier)
     */
    public function update(Request $request, $id)
    {
        $rendu = RenduDevoir::findOrFail($id);

        $rendu->update($request->only(['fichier_url', 'etat']));
        return response()->json(['message' => 'Rendu mis à jour', 'rendu' => $rendu]);
    }

    /**
     * Supprimer un rendu
     */
    public function destroy($id)
    {
        $rendu = RenduDevoir::findOrFail($id);
        $rendu->delete();

        return response()->json(['message' => 'Rendu supprimé avec succès']);
    }

    /* ============================================================
     * 🔎 FONCTIONS DE FILTRAGE / AFFICHAGE
     * ============================================================ */

    /**
     * Afficher tous les rendus d’un utilisateur
     */
    public function rendusParEtudiant($user_id)
    {
        $rendus = RenduDevoir::with('devoir')->where('user_id', $user_id)->get();
        return response()->json($rendus);
    }

    /**
     * Afficher tous les rendus d’un devoir
     */
    public function rendusParDevoir($devoir_id)
    {
        $rendus = RenduDevoir::with('etudiant')->where('devoir_id', $devoir_id)->get();
        return response()->json($rendus);
    }

    /**
     * Filtrer par état (en_attente, corrige, en_retard…)
     */
    public function rendusParEtat($etat)
    {
        $rendus = RenduDevoir::with(['devoir', 'etudiant'])
            ->where('etat', $etat)
            ->get();

        return response()->json($rendus);
    }

    /* ============================================================
     * 🎓 CORRECTION & NOTES
     * ============================================================ */

    /**
     * Corriger un rendu (ajouter note + commentaire)
     */
    public function corrigerRendu(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
            'correcteur_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $rendu = RenduDevoir::findOrFail($id);

        $rendu->update([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'etat' => 'corrige',
            'correcteur_id' => $request->correcteur_id,
        ]);

        return response()->json(['message' => 'Rendu corrigé avec succès', 'rendu' => $rendu]);
    }

    /* ============================================================
     * 📊 STATISTIQUES
     * ============================================================ */

    /**
     * Moyenne des notes pour un devoir
     */
    public function moyenneParDevoir($devoir_id)
    {
        $moyenne = RenduDevoir::where('devoir_id', $devoir_id)
            ->whereNotNull('note')
            ->avg('note');

        return response()->json(['devoir_id' => $devoir_id, 'moyenne' => $moyenne]);
    }

    /**
     * Statistiques générales par utilisateur
     */
    public function statsParEtudiant($user_id)
    {
        $total = RenduDevoir::where('user_id', $user_id)->count();
        $corriges = RenduDevoir::where('user_id', $user_id)->where('etat', 'corrige')->count();
        $retards = RenduDevoir::where('user_id', $user_id)->where('etat', 'en_retard')->count();

        return response()->json([
            'total_rendus' => $total,
            'corriges' => $corriges,
            'en_retard' => $retards,
        ]);
    }
}
