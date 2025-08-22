<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rules\RequiredIf;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Course;

class CertificatController extends Controller
{
    /**
     * Lister tous les certificats avec les relations utilisateur + cours
     */
    public function index()
    {
        $certificats = Certificat::with(['utilisateur', 'cours'])->get();
        return response()->json($certificats);
    }

    /**
     * Créer un nouveau certificat
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'cours_id' => 'required|exists:courses,id',
                'date_émission' => 'required|date',
                'code_certificat' => 'required|string|unique:certificats,code_certificat',
                'note' => 'nullable|numeric|min:0|max:100',
                'description_obtention' => 'nullable|string|max:255',
            ]);

            $certificat = Certificat::create($validated);
            return response()->json($certificat->load(['utilisateur', 'cours']), 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Afficher un certificat précis avec relations
     */
    public function show(string $id)
    {
        $certificat = Certificat::with(['utilisateur', 'cours'])->find($id);
        if (!$certificat) {
            return response()->json(['message' => 'Certificat non trouvé'], 404);
        }
        return response()->json($certificat);
    }

    /**
     * Mettre à jour un certificat
     */
    public function update(Request $request, string $id)
    {
        try {
            $certificat = Certificat::find($id);
            if (!$certificat) {
                return response()->json(['message' => 'Certificat non trouvé'], 404);
            }

            $validated = $request->validate([
                'utilisateur_id' => 'sometimes|exists:users,id',
                'cours_id' => 'sometimes|exists:courses,id',
                'date_émission' => 'sometimes|date',
                'code_certificat' => 'sometimes|string|unique:certificats,code_certificat,' . $id,
                'note' => 'sometimes|numeric|min:0|max:100',
                'description_obtention' => 'sometimes|string|max:255',
            ]);

            $certificat->update($validated);
            return response()->json($certificat->load(['utilisateur', 'cours']));
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Supprimer un certificat
     */
    public function destroy(string $id)
    {
        $certificat = Certificat::find($id);
        if (!$certificat) {
            return response()->json(['message' => 'Certificat non trouvé'], 404);
        }
        
        $certificat->delete();
        return response()->json(['message' => 'Certificat supprimé avec succès']);
    }

    /**
     * 📌 Récupérer tous les certificats d’un utilisateur donné
     */
    public function getByUser($userId)
    {
        $certificats = Certificat::with('cours')->where('utilisateur_id', $userId)->get();
        if ($certificats->isEmpty()) {
            return response()->json(['message' => 'Aucun certificat trouvé pour cet utilisateur'], 404);
        }
        return response()->json($certificats);
    }

    /**
     * 📌 Vérifier un certificat via son code unique
     */
    public function verifyByCode($code)
    {
        $certificat = Certificat::with(['utilisateur', 'cours'])->where('code_certificat', $code)->first();
        if (!$certificat) {
            return response()->json(['message' => 'Certificat invalide ou inexistant'], 404);
        }
        return response()->json([
            'message' => 'Certificat valide ✅',
            'certificat' => $certificat
        ]);
    }

    /**
     * 📌 Télécharger un certificat en JSON (plus tard tu pourras le transformer en PDF)
     */
    public function download($id)
    {
        $certificat = Certificat::with(['utilisateur', 'cours'])->find($id);
        if (!$certificat) {
            return response()->json(['message' => 'Certificat non trouvé'], 404);
        }

        // Ici tu pourrais générer un PDF avec dompdf ou snappy
        return response()->json([
            'certificat' => $certificat,
            'message' => 'Téléchargement du certificat simulé (à remplacer par PDF)'
        ]);
    }


    public function mesCertificats()
    {
        $user = Auth::user(); // l’utilisateur connecté
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        // Récupérer ses certificats via la relation
        $certificats = $user->certificats;  

        return response()->json([
            'success' => true,
            'data' => $certificats
        ]);
    }
}
