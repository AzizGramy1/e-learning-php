<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::with('utilisateur')->orderBy('date_paiement', 'desc')->paginate(10);
        return view('paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $utilisateurs = Utilisateur::all();
        return view('paiements.create', compact('utilisateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,complété,échoué',
            'date_paiement' => 'required|date',
            'méthode_paiement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Paiement::create($request->all());

        return redirect()->route('paiements.index')
            ->with('success', 'Paiement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paiement = Paiement::with('utilisateur')->findOrFail($id);
        return view('paiements.show', compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $utilisateurs = Utilisateur::all();
        return view('paiements.edit', compact('paiement', 'utilisateurs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,complété,échoué',
            'date_paiement' => 'required|date',
            'méthode_paiement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());

        return redirect()->route('paiements.index')
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }


     /**
     * API: Liste des paiements (pour applications mobiles/autres services)
     */
    public function apiIndex()
    {
        $paiements = Paiement::with('utilisateur')->get();
        return response()->json($paiements);
    }

    /**
     * API: Afficher un paiement spécifique
     */
    public function apiShow($id)
    {
        $paiement = Paiement::with('utilisateur')->findOrFail($id);
        return response()->json($paiement);
    }
}
