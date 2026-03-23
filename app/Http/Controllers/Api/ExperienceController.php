<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $experiences = $profile->experiences()->orderBy('ordre', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $experiences,
            'message' => 'Experiences retrieved successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'poste' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'competences_associees' => 'nullable|array',
            'ordre' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $experience = $request->user()->profile->experiences()->create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $experience,
            'message' => 'Experience created successfully'
        ], 201);
    }

    public function show(Experience $experience): JsonResponse
    {
        $this->authorize('view', $experience);
        
        return response()->json([
            'success' => true,
            'data' => $experience,
            'message' => 'Experience retrieved successfully'
        ]);
    }

    public function update(Request $request, Experience $experience): JsonResponse
    {
        $this->authorize('update', $experience);

        $validator = Validator::make($request->all(), [
            'poste' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'competences_associees' => 'nullable|array',
            'ordre' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $experience->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $experience,
            'message' => 'Experience updated successfully'
        ]);
    }

    public function destroy(Experience $experience): JsonResponse
    {
        $this->authorize('delete', $experience);
        
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully'
        ]);
    }
}
