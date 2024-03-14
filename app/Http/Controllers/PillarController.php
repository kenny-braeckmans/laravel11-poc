<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pillar;

class PillarController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pillars = Pillar::all();
        return response()->json($pillars);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:pillars,email',
        ]);

        $pillar = Pillar::create($validated);
        return response()->json($pillar, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pillar = Pillar::find($id);
        if (!$pillar) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($pillar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pillar = Pillar::find($id);
        if (!$pillar) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'nullable|email|unique:pillars,email,'.$id,
        ]);

        $pillar->update($validated);
        return response()->json($pillar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pillar = Pillar::find($id);
        if (!$pillar) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $pillar->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
