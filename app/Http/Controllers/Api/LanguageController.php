<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    /**
     * Afficher la liste des langues de l'utilisateur.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $languages = $user->profile->languages()->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $languages,
            'message' => 'Langues récupérées avec succès'
        ]);
    }

    /**
     * Enregistrer une nouvelle langue.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|in:debutant,elementaire,intermediaire,avance,bilingue,langue_maternelle',
            'certification' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        
        // Vérifier que l'utilisateur a un profil
        if (!$user->profile) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez créer un profil avant d\'ajouter des langues'
            ], 422);
        }

        $language = Language::create([
            'profile_id' => $user->profile->id,
            'name' => $validated['name'],
            'level' => $validated['level'],
            'certification' => $validated['certification'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $language,
            'message' => 'Langue ajoutée avec succès'
        ], 201);
    }

    /**
     * Afficher une langue spécifique.
     */
    public function show(Language $language): JsonResponse
    {
        $this->authorize('view', $language);
        
        return response()->json([
            'success' => true,
            'data' => $language,
            'message' => 'Langue récupérée avec succès'
        ]);
    }

    /**
     * Mettre à jour une langue.
     */
    public function update(Request $request, Language $language): JsonResponse
    {
        $this->authorize('update', $language);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|in:debutant,elementaire,intermediaire,avance,bilingue,langue_maternelle',
            'certification' => 'nullable|string|max:255',
        ]);

        $language->update($validated);

        return response()->json([
            'success' => true,
            'data' => $language,
            'message' => 'Langue mise à jour avec succès'
        ]);
    }

    /**
     * Supprimer une langue.
     */
    public function destroy(Language $language): JsonResponse
    {
        $this->authorize('delete', $language);
        
        $language->delete();

        return response()->json([
            'success' => true,
            'message' => 'Langue supprimée avec succès'
        ]);
    }
}
