<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Week;

class WeekController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weeks = Week::with('registration')->get();
        return response()->json($weeks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'weekChosen' => 'required|date',
        ]);

        $week = Week::create($validated);
        return response()->json($week, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $week = Week::with('registration')->find($id);
        if (!$week) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($week);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $week = Week::find($id);
        if (!$week) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'registration_id' => 'exists:registrations,id',
            'weekChosen' => 'date',
        ]);

        $week->update($validated);
        return response()->json($week);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $week = Week::find($id);
        if (!$week) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $week->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
