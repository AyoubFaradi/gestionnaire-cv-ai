<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $experiences = $profile->experiences()->orderBy('date_debut', 'desc')->get();
        
        return response()->json($experiences);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poste' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'actuel' => 'boolean',
            'lieu' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $experience = Experience::create([
            'profile_id' => $profile->id,
            'poste' => $request->poste,
            'entreprise' => $request->entreprise,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->actuel ? null : $request->date_fin,
            'actuel' => $request->actuel ?? false,
            'lieu' => $request->lieu,
        ]);

        return response()->json($experience, 201);
    }

    public function show(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        if ($experience->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($experience);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'poste' => 'sometimes|required|string|max:255',
            'entreprise' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'actuel' => 'boolean',
            'lieu' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $experience = Experience::findOrFail($id);

        if ($experience->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->only(['poste', 'entreprise', 'description', 'date_debut', 'lieu']);
        
        if ($request->has('actuel')) {
            $data['actuel'] = $request->actuel;
            $data['date_fin'] = $request->actuel ? null : $experience->date_fin;
        }
        
        if ($request->has('date_fin') && !$request->actuel) {
            $data['date_fin'] = $request->date_fin;
        }

        $experience->update($data);

        return response()->json($experience);
    }

    public function destroy(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        if ($experience->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $experience->delete();

        return response()->json(['message' => 'Experience deleted successfully']);
    }
}
