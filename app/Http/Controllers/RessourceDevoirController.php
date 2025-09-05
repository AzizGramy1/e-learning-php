<?php

namespace App\Http\Controllers;

use App\Models\RessourceDevoir;
use Illuminate\Http\Request;

class RessourceDevoirController extends Controller
{
    // 🔹 Lister toutes les ressources
    public function index()
    {
        return RessourceDevoir::all();
    }

    // 🔹 Créer une nouvelle ressource
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'iconType' => 'nullable|string|max:50',
            'ressourceLinkName' => 'nullable|string|max:255',
            'descriptionLink' => 'nullable|string'
        ]);

        $ressource = RessourceDevoir::create($validated);
        return response()->json($ressource, 201);
    }

    // 🔹 Récupérer une ressource par ID
    public function show($id)
    {
        return RessourceDevoir::findOrFail($id);
    }

    // 🔹 Récupérer une ressource par nom
    public function getByName($name)
    {
        return RessourceDevoir::where('name', $name)->firstOrFail();
    }

    // 🔹 Mettre à jour une ressource
    public function update(Request $request, $id)
    {
        $ressource = RessourceDevoir::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'iconType' => 'nullable|string|max:50',
            'ressourceLinkName' => 'nullable|string|max:255',
            'descriptionLink' => 'nullable|string'
        ]);

        $ressource->update($validated);
        return response()->json($ressource);
    }

    // 🔹 Supprimer une ressource
    public function destroy($id)
    {
        $ressource = RessourceDevoir::findOrFail($id);
        $ressource->delete();
        return response()->json(['message' => 'Ressource supprimée avec succès']);
    }
}
