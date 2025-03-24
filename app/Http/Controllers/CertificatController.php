<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $certificat = Certificat::create($request->all());
        return response()->json($certificat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Certificat::findOrFail($id));
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
        $certificat = Certificat::findOrFail($id);
        $certificat->update($request->all());
        return response()->json($certificat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Certificat::destroy($id);
        return response()->json(['message' => 'Certificat supprimé']);
    }
}
