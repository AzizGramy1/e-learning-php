<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reunion;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReunionController extends Controller
{
     /**
     * Lister toutes les réunions
     */
    public function index(Request $request)
    {
        $query = Reunion::query();

        // Filtres optionnels
        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->has('instructeur_id')) {
            $query->parInstructeur($request->instructeur_id);
        }

        if ($request->has('categorie_id')) {
            $query->parCategorie($request->categorie_id);
        }

        if ($request->has('course_id')) {
            $query->parCours($request->course_id);
        }

        if ($request->has('publiques') && $request->publiques) {
            $query->publiques();
        }

        return response()->json($query->with(['instructeur', 'categorie', 'participants'])->get());
    }

    /**
     * Afficher une réunion spécifique
     */
    public function show($id)
    {
        $reunion = Reunion::with(['instructeur', 'categorie', 'participants', 'commentaires'])->findOrFail($id);
        return response()->json($reunion);
    }

    /**
     * Créer une nouvelle réunion
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'instructeur_id' => 'required|exists:users,id',
            'categorie_id' => 'nullable|exists:categories,id',
            'course_id' => 'nullable|exists:courses,id',
            'max_participants' => 'nullable|integer|min:1',
            'est_prive' => 'boolean',
            'mot_de_passe' => 'nullable|string|max:255',
            'lien_video' => 'nullable|url',
            'image_url' => 'nullable|url',
            'duree' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $reunion = Reunion::create($request->all());
        return response()->json($reunion, 201);
    }

    /**
     * Mettre à jour une réunion
     */
    public function update(Request $request, $id)
    {
        $reunion = Reunion::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after_or_equal:date_debut',
            'instructeur_id' => 'sometimes|required|exists:users,id',
            'categorie_id' => 'nullable|exists:categories,id',
            'course_id' => 'nullable|exists:courses,id',
            'max_participants' => 'nullable|integer|min:1',
            'est_prive' => 'boolean',
            'mot_de_passe' => 'nullable|string|max:255',
            'lien_video' => 'nullable|url',
            'image_url' => 'nullable|url',
            'duree' => 'nullable|integer|min:1',
            'statut' => 'nullable|in:planifie,en_cours,termine,annule',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $reunion->update($request->all());
        return response()->json($reunion);
    }

    /**
     * Supprimer une réunion
     */
    public function destroy($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->delete();
        return response()->json(['message' => 'Réunion supprimée avec succès.']);
    }

    /**
     * Ajouter un participant
     */
    public function ajouterParticipant($reunionId, $userId)
    {
        $reunion = Reunion::findOrFail($reunionId);
        $user = User::findOrFail($userId);

        if ($reunion->peutRejoindre($user)) {
            $reunion->participants()->attach($user->id, ['date_inscription' => now()]);
            $reunion->rejoindre();
            return response()->json(['message' => 'Utilisateur ajouté à la réunion.']);
        }

        return response()->json(['message' => 'Impossible de rejoindre la réunion.'], 403);
    }

    /**
     * Retirer un participant
     */
    public function retirerParticipant($reunionId, $userId)
    {
        $reunion = Reunion::findOrFail($reunionId);
        $user = User::findOrFail($userId);

        if ($reunion->estInscrit($user)) {
            $reunion->participants()->detach($user->id);
            $reunion->quitter();
            return response()->json(['message' => 'Utilisateur retiré de la réunion.']);
        }

        return response()->json(['message' => 'Utilisateur non inscrit à cette réunion.'], 404);
    }

    /**
     * Démarrer une réunion
     */
    public function demarrer($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->demarrer();
        return response()->json(['message' => 'Réunion démarrée.', 'reunion' => $reunion]);
    }

    /**
     * Terminer une réunion
     */
    public function terminer($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->terminer();
        return response()->json(['message' => 'Réunion terminée.', 'reunion' => $reunion]);
    }

    /**
     * Annuler une réunion
     */
    public function annuler($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->annuler();
        return response()->json(['message' => 'Réunion annulée.', 'reunion' => $reunion]);
    }

    /**
     * Liste des réunions populaires
     */
    public function populaires($limit = 5)
    {
        $reunions = Reunion::populaires($limit)->get();
        return response()->json($reunions);
    }

    /**
     * Liste des réunions publiques avec places disponibles
     */
    public function disponibles()
    {
        $reunions = Reunion::publiques()->avecPlaces()->get();
        return response()->json($reunions);
    }

    /**
     * Statistiques globales
     */
    public function statistiques()
    {
        $total = Reunion::count();
        $enDirect = Reunion::enDirect()->count();
        $aVenir = Reunion::aVenir()->count();
        $terminees = Reunion::terminees()->count();

        return response()->json([
            'total' => $total,
            'en_direct' => $enDirect,
            'a_venir' => $aVenir,
            'terminees' => $terminees,
        ]);
    }


                    ///      ////      /////      ////      ////      /////      ////      ///
                    ///      ////      /////      ////      ////      ////      /////      ////      ///        

    /**
     * Lister toutes les réunions auxquelles l'utilisateur est inscrit
     */
    public function mesReunions()
    {
        $user = Auth::user();
        $reunions = $user->reunions()->with(['instructeur', 'categorie'])->get();
        return response()->json($reunions);
    }

    /**
     * S'inscrire à une réunion
     */
    public function rejoindreReunion($reunionId)
    {
        $user = Auth::user();
        $reunion = Reunion::findOrFail($reunionId);

        if (!$reunion->peutRejoindre($user)) {
            return response()->json(['message' => 'Impossible de rejoindre la réunion.'], 403);
        }

        $reunion->participants()->attach($user->id, ['date_inscription' => now()]);
        $reunion->rejoindre();

        return response()->json(['message' => 'Inscription réussie.', 'reunion' => $reunion]);
    }

    /**
     * Se désinscrire d'une réunion
     */
    public function quitterReunion($reunionId)
    {
        $user = Auth::user();
        $reunion = Reunion::findOrFail($reunionId);

        if (!$reunion->estInscrit($user)) {
            return response()->json(['message' => 'Vous n\'êtes pas inscrit à cette réunion.'], 404);
        }

        $reunion->participants()->detach($user->id);
        $reunion->quitter();

        return response()->json(['message' => 'Vous avez quitté la réunion.', 'reunion' => $reunion]);
    }

    /**
     * Vérifier si l'utilisateur est inscrit à une réunion
     */
    public function estInscrit($reunionId)
    {
        $user = Auth::user();
        $reunion = Reunion::findOrFail($reunionId);

        return response()->json(['inscrit' => $reunion->estInscrit($user)]);
    }

    /**
     * Lister les réunions disponibles pour l'utilisateur (publiques et avec places)
     */
    public function reunionsDisponibles()
    {
        $reunions = Reunion::publiques()->avecPlaces()->get();
        return response()->json($reunions);
    }

}
