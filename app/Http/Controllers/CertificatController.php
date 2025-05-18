<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Cours;
use App\Models\Message;
use App\Models\Forum;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;

class CertificatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Certificat::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'utilisateur_id' => 'required|exists:users,id',
                'cours_id' => 'required|exists:courses,id',
                'date_émission' => 'required|date',
                'code_certificat' => 'required|string|unique:certificats,code_certificat',
            ]);

            $certificat = Certificat::create($validated);
            return response()->json($certificat, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificat = Certificat::find($id);
        if (!$certificat) {
            return response()->json(['message' => 'Certificat non trouvé'], 404);
        }
        return response()->json($certificat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
            ]);

            $certificat->update($validated);
            return response()->json($certificat);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
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
}
