<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class AIService
{
    private string $apiKey;
    private string $baseUrl;
    private string $model;
    private int $maxTokens;
    private float $temperature;

    public function __construct()
    {
        $config = Config::get('openai');
        
        $this->apiKey = $config['api_key'];
        $this->baseUrl = $config['base_url'];
        $this->model = $config['model'];
        $this->maxTokens = $config['max_tokens'];
        $this->temperature = $config['temperature'];

        // Vérifier que la clé API est configurée
        if (empty($this->apiKey)) {
            Log::warning('OpenAI API key is not configured');
        }
    }

    public function generateCV(array $data): string
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Service IA non configuré. Veuillez ajouter votre clé OpenAI.');
        }

        $prompt = $this->buildCVPrompt($data);
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/chat/completions', [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un expert en rédaction de CV professionnels. Génère un CV complet et structuré en français.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
        ]);

        if (!$response->successful()) {
            Log::error('AI Service Error: ' . $response->body());
            throw new \Exception('Erreur lors de la génération du CV');
        }

        return $response->json('choices.0.message.content');
    }

    public function generateLetter(object $jobOffer, object $profile): string
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Service IA non configuré. Veuillez ajouter votre clé OpenAI.');
        }

        $prompt = $this->buildLetterPrompt($jobOffer, $profile);
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/chat/completions', [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un expert en rédaction de lettres de motivation professionnelles. Génère une lettre de motivation personnalisée en français.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
        ]);

        if (!$response->successful()) {
            Log::error('AI Service Error: ' . $response->body());
            throw new \Exception('Erreur lors de la génération de la lettre');
        }

        return $response->json('choices.0.message.content');
    }

    public function generateEmail(array $data): string
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Service IA non configuré. Veuillez ajouter votre clé OpenAI.');
        }

        $prompt = $this->buildEmailPrompt($data);
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/chat/completions', [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un expert en communication professionnelle. Génère un email professionnel en français.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
        ]);

        if (!$response->successful()) {
            Log::error('AI Service Error: ' . $response->body());
            throw new \Exception('Erreur lors de la génération de l\'email');
        }

        return $response->json('choices.0.message.content');
    }

    public function improveText(string $text): string
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Service IA non configuré. Veuillez ajouter votre clé OpenAI.');
        }

        $prompt = "Améliore le texte suivant en le rendant plus professionnel, clair et percutant. Garde le même sens et la même longueur approximative:\n\n" . $text;
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/chat/completions', [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un expert en rédaction professionnelle. Améliore les textes en gardant leur sens original.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
        ]);

        if (!$response->successful()) {
            Log::error('AI Service Error: ' . $response->body());
            throw new \Exception('Erreur lors de l\'amélioration du texte');
        }

        return $response->json('choices.0.message.content');
    }

    private function buildCVPrompt(array $data): string
    {
        $prompt = "Génère un CV professionnel complet avec les informations suivantes:\n\n";
        
        if (!empty($data['profile'])) {
            $profile = $data['profile'];
            $prompt .= "PROFIL:\n";
            $prompt .= "- Titre: " . ($profile['title'] ?? 'Non spécifié') . "\n";
            $prompt .= "- Résumé: " . ($profile['summary'] ?? 'Non spécifié') . "\n";
            $prompt .= "- Téléphone: " . ($profile['phone'] ?? 'Non spécifié') . "\n";
            $prompt .= "- Email: " . ($profile['email'] ?? 'Non spécifié') . "\n";
            $prompt .= "- LinkedIn: " . ($profile['linkedin'] ?? 'Non spécifié') . "\n";
            $prompt .= "- GitHub: " . ($profile['github'] ?? 'Non spécifié') . "\n\n";
        }

        if (!empty($data['experiences'])) {
            $prompt .= "EXPÉRIENCES PROFESSIONNELLES:\n";
            foreach ($data['experiences'] as $exp) {
                $prompt .= "- " . $exp['poste'] . " chez " . $exp['entreprise'];
                $prompt .= " (" . $exp['date_debut'] . " - " . ($exp['actuel'] ? 'présent' : $exp['date_fin']) . ")\n";
                $prompt .= "  " . ($exp['description'] ?? '') . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($data['formations'])) {
            $prompt .= "FORMATIONS:\n";
            foreach ($data['formations'] as $formation) {
                $prompt .= "- " . $formation['diplome'] . " - " . $formation['etablissement'];
                $prompt .= " (" . $formation['date_debut'] . " - " . ($formation['actuel'] ? 'présent' : $formation['date_fin']) . ")\n";
                $prompt .= "  " . ($formation['specialite'] ?? '') . "\n";
                $prompt .= "  " . ($formation['description'] ?? '') . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($data['skills'])) {
            $prompt .= "COMPÉTENCES:\n";
            foreach ($data['skills'] as $skill) {
                $prompt .= "- " . $skill['name'] . " (" . $skill['level'] . ")\n";
            }
            $prompt .= "\n";
        }

        if (!empty($data['languages'])) {
            $prompt .= "LANGUES:\n";
            foreach ($data['languages'] as $lang) {
                $prompt .= "- " . $lang['name'] . " (" . $lang['level'] . ")\n";
            }
            $prompt .= "\n";
        }

        $prompt .= "\nGénère un CV structuré avec les sections: Informations, Résumé, Expérience, Formation, Compétences, Langues.";
        $prompt .= " Utilise un format professionnel et moderne.";
        
        return $prompt;
    }

    private function buildLetterPrompt(object $jobOffer, object $profile): string
    {
        return "Génère une lettre de motivation pour le poste suivant:\n\n" .
               "POSTE: " . $jobOffer->title . " chez " . $jobOffer->company . "\n" .
               "DESCRIPTION: " . $jobOffer->description . "\n\n" .
               "CANDIDAT:\n" .
               "- Titre: " . ($profile->title ?? 'Non spécifié') . "\n" .
               "- Résumé: " . ($profile->summary ?? 'Non spécifié') . "\n" .
               "- Expériences: " . ($profile->experiences->pluck('poste')->implode(', ') ?? 'Non spécifié') . "\n" .
               "- Compétences: " . ($profile->skills->pluck('name')->implode(', ') ?? 'Non spécifié') . "\n\n" .
               "Génère une lettre de motivation personnalisée qui met en valeur l'adéquation entre le profil et le poste.";
    }

    private function buildEmailPrompt(array $data): string
    {
        return "Génère un email professionnel avec les éléments suivants:\n\n" .
               "- Destinataire: " . ($data['recipient'] ?? 'Non spécifié') . "\n" .
               "- Sujet: " . ($data['subject'] ?? 'Non spécifié') . "\n" .
               "- Objectif: " . ($data['purpose'] ?? 'Non spécifié') . "\n" .
               "- Points clés: " . ($data['key_points'] ?? 'Non spécifié') . "\n" .
               "- Ton: " . ($data['tone'] ?? 'professionnel') . "\n\n" .
               "Génère un email complet et professionnel.";
    }
}
