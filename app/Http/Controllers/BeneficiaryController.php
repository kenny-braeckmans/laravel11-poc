<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;

class BeneficiaryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return response()->json($beneficiaries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:beneficiaries,email',
        ]);

        $beneficiary = Beneficiary::create($validated);
        return response()->json($beneficiary, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beneficiary = Beneficiary::find($id);
        if (!$beneficiary) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($beneficiary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beneficiary = Beneficiary::find($id);
        if (!$beneficiary) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'nullable|email|unique:beneficiaries,email,' . $id,
        ]);

        $beneficiary->update($validated);
        return response()->json($beneficiary);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beneficiary = Beneficiary::find($id);
        if (!$beneficiary) {
            return response()->json(['message' => 'Not Found!'], Response::HTTP_NOT_FOUND);
        }

        $beneficiary->delete();
        return response()->json(['message' => 'Deleted Successfully'], Response::HTTP_OK);
    }
}
