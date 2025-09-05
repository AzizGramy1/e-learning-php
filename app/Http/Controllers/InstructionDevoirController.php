<?php

namespace App\Http\Controllers;

use App\Models\InstructionDevoir;
use Illuminate\Http\Request;


class InstructionDevoirController extends Controller
{
    // 🔹 Lister toutes les instructions
    public function index()
    {
        return InstructionDevoir::all();
    }

    // 🔹 Créer une nouvelle instruction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points' => 'nullable|string',
            'sousPoints' => 'nullable|string'
        ]);

        $instruction = InstructionDevoir::create($validated);
        return response()->json($instruction, 201);
    }

    // 🔹 Récupérer une instruction par ID
    public function show($id)
    {
        return InstructionDevoir::findOrFail($id);
    }

    // 🔹 Récupérer une instruction par titre
    public function getByTitle($title)
    {
        return InstructionDevoir::where('title', $title)->firstOrFail();
    }

    // 🔹 Mettre à jour une instruction
    public function update(Request $request, $id)
    {
        $instruction = InstructionDevoir::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'points' => 'nullable|string',
            'sousPoints' => 'nullable|string'
        ]);

        $instruction->update($validated);
        return response()->json($instruction);
    }

    // 🔹 Supprimer une instruction
    public function destroy($id)
    {
        $instruction = InstructionDevoir::findOrFail($id);
        $instruction->delete();
        return response()->json(['message' => 'Instruction supprimée avec succès']);
    }
}
