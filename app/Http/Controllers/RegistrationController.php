<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::with(['pillar', 'project'])->get();
        return response()->json($registrations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pillar_id' => 'required|exists:pillars,id',
            'project_id' => 'required|exists:projects,id',
            'authToken' => 'required|string|unique:registrations,authToken',
        ]);

        $registration = Registration::create($validated);
        return response()->json($registration, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registration = Registration::with(['pillar', 'project'])->find($id);
        if (!$registration) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($registration);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'pillar_id' => 'exists:pillars,id',
            'project_id' => 'exists:projects,id',
            'authToken' => 'string|unique:registrations,authToken,' . $id,
        ]);

        $registration->update($validated);
        return response()->json($registration);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $registration->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
