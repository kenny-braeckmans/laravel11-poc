<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['administrator', 'beneficiary'])->get();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'keyword' => 'required|string|max:255|unique:projects,keyword',
            'startDate' => 'required|date',
            'duration' => 'required|integer',
            'administrator_id' => 'required|exists:administrators,id',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
        ]);

        $project = Project::create($validated);
        return response()->json($project, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with(['administrator', 'beneficiary'])->find($id);
        if (!$project) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'keyword' => 'string|max:255|unique:projects,keyword,' . $id,
            'startDate' => 'date',
            'duration' => 'integer',
            'administrator_id' => 'exists:administrators,id',
            'beneficiary_id' => 'exists:beneficiaries,id',
        ]);

        $project->update($validated);
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $project->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
