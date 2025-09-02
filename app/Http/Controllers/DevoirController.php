<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devoir;
use App\Models\RenduDevoir;


class DevoirController extends Controller
{
    /**
     * 📌 Afficher tous les devoirs
     */
    public function index()
    {
        return response()->json(Devoir::with('rendus', 'professeur')->get());
    }

    /**
     * 📌 Créer un nouveau devoir
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'required|date',
            'matiere' => 'required|string|max:255',
            'professeur_id' => 'required|exists:users,id',
        ]);

        $devoir = Devoir::create($request->all());

        return response()->json($devoir, 201);
    }

    /**
     * 📌 Afficher un devoir spécifique
     */
    public function show($id)
    {
        $devoir = Devoir::with('rendus.etudiant', 'professeur')->findOrFail($id);
        return response()->json($devoir);
    }

    /**
     * 📌 Mettre à jour un devoir
     */
    public function update(Request $request, $id)
    {
        $devoir = Devoir::findOrFail($id);
        $devoir->update($request->all());

        return response()->json($devoir);
    }

    /**
     * 📌 Supprimer un devoir
     */
    public function destroy($id)
    {
        $devoir = Devoir::findOrFail($id);
        $devoir->delete();

        return response()->json(['message' => 'Devoir supprimé']);
    }

    /**
     * 📌 Lister les devoirs par professeur
     */
    public function getByProfesseur($professeurId)
    {
        $devoirs = Devoir::where('professeur_id', $professeurId)->with('rendus')->get();
        return response()->json($devoirs);
    }

    /**
     * 📌 Lister les devoirs par étudiant (avec rendus)
     */
    public function getByEtudiant($etudiantId)
    {
        $rendus = RenduDevoir::where('user_id', $etudiantId)->with('devoir')->get();
        return response()->json($rendus);
    }

    /**
     * 📌 Rechercher un devoir par titre
     */
    public function searchByTitre(Request $request)
    {
        $titre = $request->input('titre');
        $devoirs = Devoir::where('titre', 'like', "%$titre%")->get();
        return response()->json($devoirs);
    }

    /**
     * 📌 Rechercher les devoirs par date limite
     */
    public function searchByDate(Request $request)
    {
        $date = $request->input('date');
        $devoirs = Devoir::whereDate('date_limite', $date)->get();
        return response()->json($devoirs);
    }

    /**
     * 📌 Obtenir les devoirs en retard (non rendus)
     */
    public function devoirsEnRetard()
    {
        $today = now();
        $devoirs = Devoir::where('date_limite', '<', $today)
            ->whereDoesntHave('rendus')
            ->get();

        return response()->json($devoirs);
    }

    /**
     * 📌 Obtenir les devoirs à venir
     */
    public function devoirsAVenir()
    {
        $devoirs = Devoir::where('date_limite', '>', now())->get();
        return response()->json($devoirs);
    }

    /**
     * 📌 Statistiques : nombre de rendus par devoir
     */
    public function statsRendus($id)
    {
        $devoir = Devoir::withCount('rendus')->findOrFail($id);
        return response()->json([
            'devoir' => $devoir->titre,
            'total_rendus' => $devoir->rendus_count,
        ]);
    }

    /**
     * 📌 Exporter les devoirs en JSON
     */
    public function exportJson()
    {
        $devoirs = Devoir::with('rendus')->get();
        return response()->json($devoirs);
    }

    /**
     * 📌 Exporter les devoirs en CSV (simple)
     */
    public function exportCsv()
    {
        $devoirs = Devoir::all();
        $csv = "ID;Titre;Date Limite;Matiere\n";
        foreach ($devoirs as $d) {
            $csv .= "{$d->id};{$d->titre};{$d->date_limite};{$d->matiere}\n";
        }

        return response($csv)->header('Content-Type', 'text/csv');
    }

    /**
     * 📌 Supprimer tous les rendus d’un devoir
     */
    public function deleteRendus($id)
    {
        $devoir = Devoir::findOrFail($id);
        $devoir->rendus()->delete();

        return response()->json(['message' => 'Tous les rendus supprimés pour ce devoir']);
    }

    /**
     * 📌 Obtenir les devoirs à venir pour un étudiant spécifique (avec rendus)
     */

    public function devoirsAVenirEtudiant($etudiantId)
{
    $devoirs = Devoir::where('date_limite', '>', now())
        ->whereHas('rendus', function ($query) use ($etudiantId) {
            $query->where('user_id', $etudiantId);
        })
        ->get();

    return response()->json($devoirs);
}


    /**
     * 📌 Obtenir les devoirs à venir non rendus pour un étudiant spécifique
     */
public function devoirsAVenirNonRendus($etudiantId)
{
    $today = now();

    $devoirs = Devoir::where('date_limite', '>', $today)
        ->whereDoesntHave('soumissions', function ($query) use ($etudiantId) {
            $query->where('user_id', $etudiantId);
        })
        ->get();

    return response()->json($devoirs);
}


/**
 * 📌 Rechercher un devoir par son ID
 */
public function searchById($id)
{
    $devoir = Devoir::find($id);

    if (!$devoir) {
        return response()->json(['message' => 'Devoir introuvable'], 404);
    }

    return response()->json($devoir);
}

}
