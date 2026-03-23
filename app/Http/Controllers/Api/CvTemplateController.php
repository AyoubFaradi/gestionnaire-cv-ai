<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CvTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CvTemplateController extends Controller
{
    /**
     * Afficher la liste des templates de CV.
     */
    public function index(): JsonResponse
    {
        $templates = CvTemplate::active()->orderBy('is_default', 'desc')->orderBy('name', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $templates,
            'message' => 'Templates de CV récupérés avec succès'
        ]);
    }

    /**
     * Enregistrer un nouveau template de CV.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'style' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'options' => 'nullable|array',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
            'preview_image' => 'nullable|string|max:255',
        ]);

        // Si ce template est défini par défaut, retirer le statut par défaut des autres
        if ($validated['is_default']) {
            CvTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        $template = CvTemplate::create($validated);

        return response()->json([
            'success' => true,
            'data' => $template,
            'message' => 'Template de CV créé avec succès'
        ], 201);
    }

    /**
     * Afficher un template spécifique.
     */
    public function show(CvTemplate $cvTemplate): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $cvTemplate,
            'message' => 'Template de CV récupéré avec succès'
        ]);
    }

    /**
     * Mettre à jour un template de CV.
     */
    public function update(Request $request, CvTemplate $cvTemplate): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'style' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'options' => 'nullable|array',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
            'preview_image' => 'nullable|string|max:255',
        ]);

        // Si ce template est défini par défaut, retirer le statut par défaut des autres
        if ($validated['is_default'] && !$cvTemplate->is_default) {
            CvTemplate::where('is_default', true)->where('id', '!=', $cvTemplate->id)->update(['is_default' => false]);
        }

        $cvTemplate->update($validated);

        return response()->json([
            'success' => true,
            'data' => $cvTemplate,
            'message' => 'Template de CV mis à jour avec succès'
        ]);
    }

    /**
     * Supprimer un template de CV.
     */
    public function destroy(CvTemplate $cvTemplate): JsonResponse
    {
        // Empêcher la suppression du template par défaut
        if ($cvTemplate->is_default) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer le template par défaut'
            ], 422);
        }

        $cvTemplate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template de CV supprimé avec succès'
        ]);
    }

    /**
     * Obtenir les options par défaut pour les templates.
     */
    public function getDefaultOptions(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => CvTemplate::getDefaultOptions(),
            'message' => 'Options par défaut récupérées avec succès'
        ]);
    }
}
