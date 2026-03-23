<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\JobOffer;
use App\Services\AI\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AIController extends Controller
{
    private AIService $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function generateCV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id' => 'required|exists:profiles,id',
            'template' => 'sometimes|string|in:modern,classic,creative',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = $request->user()->profile;
        
        if (!$profile || $profile->id != $request->profile_id) {
            return response()->json(['message' => 'Profile not found or unauthorized'], 404);
        }

        try {
            $data = [
                'profile' => $profile->toArray(),
                'experiences' => $profile->experiences->toArray(),
                'formations' => $profile->formations->toArray(),
                'skills' => $profile->skills->toArray(),
            ];

            $cvContent = $this->aiService->generateCV($data);

            $document = Document::create([
                'user_id' => $request->user()->id,
                'type' => 'cv',
                'title' => 'CV - ' . $profile->title,
                'content' => $cvContent,
                'metadata' => [
                    'template' => $request->template ?? 'modern',
                    'profile_id' => $profile->id,
                    'generated_at' => now(),
                ],
            ]);

            return response()->json([
                'document' => $document,
                'content' => $cvContent,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la génération du CV: ' . $e->getMessage()], 500);
        }
    }

    public function generateLetter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_offer_id' => 'required|exists:job_offers,id',
            'profile_id' => 'required|exists:profiles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = $request->user()->profile;
        
        if (!$profile || $profile->id != $request->profile_id) {
            return response()->json(['message' => 'Profile not found or unauthorized'], 404);
        }

        try {
            $jobOffer = JobOffer::findOrFail($request->job_offer_id);
            $letterContent = $this->aiService->generateLetter($jobOffer, $profile);

            $document = Document::create([
                'user_id' => $request->user()->id,
                'type' => 'lettre',
                'title' => 'Lettre de motivation - ' . $jobOffer->title,
                'content' => $letterContent,
                'metadata' => [
                    'job_offer_id' => $jobOffer->id,
                    'profile_id' => $profile->id,
                    'generated_at' => now(),
                ],
            ]);

            return response()->json([
                'document' => $document,
                'content' => $letterContent,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la génération de la lettre: ' . $e->getMessage()], 500);
        }
    }

    public function generateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'purpose' => 'required|string',
            'key_points' => 'sometimes|array',
            'key_points.*' => 'string',
            'tone' => 'sometimes|string|in:professionnel,amical,formel,direct',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $emailContent = $this->aiService->generateEmail($request->all());

            $document = Document::create([
                'user_id' => $request->user()->id,
                'type' => 'email',
                'title' => 'Email - ' . $request->subject,
                'content' => $emailContent,
                'metadata' => [
                    'recipient' => $request->recipient,
                    'subject' => $request->subject,
                    'purpose' => $request->purpose,
                    'generated_at' => now(),
                ],
            ]);

            return response()->json([
                'document' => $document,
                'content' => $emailContent,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la génération de l\'email: ' . $e->getMessage()], 500);
        }
    }

    public function improveText(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|min:10|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $improvedText = $this->aiService->improveText($request->text);

            return response()->json([
                'original' => $request->text,
                'improved' => $improvedText,
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'amélioration du texte: ' . $e->getMessage()], 500);
        }
    }

    public function getDocuments(Request $request)
    {
        $documents = $request->user()->documents()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($documents);
    }

    public function getDocument(Request $request, $id)
    {
        $document = $request->user()->documents()->findOrFail($id);

        return response()->json($document);
    }

    public function deleteDocument(Request $request, $id)
    {
        $document = $request->user()->documents()->findOrFail($id);
        $document->delete();

        return response()->json(['message' => 'Document supprimé avec succès']);
    }
}
