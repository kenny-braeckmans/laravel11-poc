<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;

class AdministratorController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrators = Administrator::all();
        return response()->json($administrators);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:administrators,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'isSiteAdmin' => 'required|boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $administrator = Administrator::create($validated);
        return response()->json($administrator, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($administrator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'email' => 'email|unique:administrators,email,' . $id,
            'name' => 'string|max:255',
            'password' => 'string|min:8',
            'isSiteAdmin' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $administrator->update($validated);
        return response()->json($administrator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $administrator->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
