<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile()->with(['experiences', 'formations', 'skills'])->first();
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json($profile);
    }

    public function store(Request $request)
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

        $profile = Profile::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'summary' => $request->summary,
            'phone' => $request->phone,
            'address' => $request->address,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
        ]);

        return response()->json($profile, 201);
    }

    public function show(Request $request, $id)
    {
        $profile = Profile::with(['experiences', 'formations', 'skills'])
            ->findOrFail($id);

        if ($profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($profile);
    }

    public function update(Request $request, $id)
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

        $profile = Profile::findOrFail($id);

        if ($profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $profile->update($request->only([
            'title', 'summary', 'phone', 'address', 'linkedin', 'github'
        ]));

        return response()->json($profile);
    }

    public function destroy(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        if ($profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
