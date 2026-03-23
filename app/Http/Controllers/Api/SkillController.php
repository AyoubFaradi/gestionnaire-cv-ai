<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $skills = $profile->skills()->orderBy('category')->orderBy('name')->get();
        
        return response()->json($skills);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'level' => 'required|in:debutant,intermediaire,avance,expert',
            'category' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $skill = Skill::create([
            'profile_id' => $profile->id,
            'name' => $request->name,
            'level' => $request->level,
            'category' => $request->category,
        ]);

        return response()->json($skill, 201);
    }

    public function show(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($skill);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'level' => 'sometimes|required|in:debutant,intermediaire,avance,expert',
            'category' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skill = Skill::findOrFail($id);

        if ($skill->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $skill->update($request->only(['name', 'level', 'category']));

        return response()->json($skill);
    }

    public function destroy(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully']);
    }
}
