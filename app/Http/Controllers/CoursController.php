<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Course::all());
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
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $cours = Course::create($validatedData);

        return response()->json($cours, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cours = Course::findOrFail($id);
        return response()->json($cours);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cours = Course::findOrFail($id);

        $validatedData = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $cours->update($validatedData);

        return response()->json($cours);
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::destroy($id);
        return response()->json(['message' => 'Cours supprimé avec succès']);
    }
}
