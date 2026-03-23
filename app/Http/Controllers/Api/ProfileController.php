<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $profile = $request->user()->profile()->with(['experiences', 'formations', 'skills', 'languages'])->first();
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profile retrieved successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:2000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->user()->profile) {
            return response()->json(['message' => 'Profile already exists'], 422);
        }

        $profile = Profile::create(array_merge(
            $validator->validated(),
            ['user_id' => $request->user()->id]
        ));

        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profile created successfully'
        ], 201);
    }

    public function show(Profile $profile): JsonResponse
    {
        $this->authorize('view', $profile);
        
        return response()->json([
            'success' => true,
            'data' => $profile->load(['experiences', 'formations', 'skills', 'languages']),
            'message' => 'Profile retrieved successfully'
        ]);
    }

    public function update(Request $request, Profile $profile): JsonResponse
    {
        $this->authorize('update', $profile);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:2000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profile updated successfully'
        ]);
    }

    public function destroy(Profile $profile): JsonResponse
    {
        $this->authorize('delete', $profile);
        
        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile deleted successfully'
        ]);
    }
}
