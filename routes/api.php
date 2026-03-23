<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\JobOfferController;
use App\Http\Controllers\Api\AIController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\CvTemplateController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes publiques pour les offres d'emploi (accessibles sans authentification)
Route::get('/public/job-offers', [JobOfferController::class, 'index']);
Route::get('/public/job-offers/{id}', [JobOfferController::class, 'show']);

// Routes publiques pour les templates de CV (accessibles sans authentification)
Route::get('/public/cv-templates', [CvTemplateController::class, 'index']);
Route::get('/public/cv-templates/{id}', [CvTemplateController::class, 'show']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // Authentification
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Profile CRUD
    Route::apiResource('profiles', ProfileController::class);
    
    // Experiences CRUD
    Route::apiResource('experiences', ExperienceController::class);
    
    // Formations CRUD
    Route::apiResource('formations', FormationController::class);
    
    // Skills CRUD
    Route::apiResource('skills', SkillController::class);
    
    // Languages CRUD
    Route::apiResource('languages', LanguageController::class);
    
    // CV Templates CRUD (admin uniquement)
    Route::apiResource('cv-templates', CvTemplateController::class);
    
    // Job Offers (lecture publique, écriture protégée)
    Route::apiResource('job-offers', JobOfferController::class)->except(['index', 'show']);
    
    // AI Endpoints
    Route::prefix('ai')->group(function () {
        Route::post('/generate/cv', [AIController::class, 'generateCV']);
        Route::post('/generate/letter', [AIController::class, 'generateLetter']);
        Route::post('/generate/email', [AIController::class, 'generateEmail']);
        Route::post('/improve', [AIController::class, 'improveText']);
        
        // Documents générés
        Route::get('/documents', [AIController::class, 'getDocuments']);
        Route::get('/documents/{id}', [AIController::class, 'getDocument']);
        Route::delete('/documents/{id}', [AIController::class, 'deleteDocument']);
    });
});
