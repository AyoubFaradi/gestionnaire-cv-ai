<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormationController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $formations = $profile->formations()->orderBy('date_debut', 'desc')->get();
        
        return response()->json($formations);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diplome' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
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

        $formation = Formation::create([
            'profile_id' => $profile->id,
            'diplome' => $request->diplome,
            'etablissement' => $request->etablissement,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->actuel ? null : $request->date_fin,
            'actuel' => $request->actuel ?? false,
            'lieu' => $request->lieu,
        ]);

        return response()->json($formation, 201);
    }

    public function show(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        if ($formation->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($formation);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diplome' => 'sometimes|required|string|max:255',
            'etablissement' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'actuel' => 'boolean',
            'lieu' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $formation = Formation::findOrFail($id);

        if ($formation->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->only(['diplome', 'etablissement', 'description', 'date_debut', 'lieu']);
        
        if ($request->has('actuel')) {
            $data['actuel'] = $request->actuel;
            $data['date_fin'] = $request->actuel ? null : $formation->date_fin;
        }
        
        if ($request->has('date_fin') && !$request->actuel) {
            $data['date_fin'] = $request->date_fin;
        }

        $formation->update($data);

        return response()->json($formation);
    }

    public function destroy(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        if ($formation->profile->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $formation->delete();

        return response()->json(['message' => 'Formation deleted successfully']);
    }
}
