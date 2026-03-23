<?php

use Illuminate\Support\Facades\Route;

// Page d'accueil - Login/Register
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard principal
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Routes publiques pour les templates de CV
Route::get('/cv-templates', function () {
    return view('cv-templates.index');
});

Route::get('/cv-templates/{id}', function ($id) {
    return view('cv-templates.show', ['templateId' => $id]);
});

// Routes publiques pour les offres d'emploi
Route::get('/offres-emploi', function () {
    return view('job-offers.index');
});

Route::get('/offres-emploi/{id}', function ($id) {
    return view('job-offers.show', ['offerId' => $id]);
});

// Routes pour la documentation API
Route::get('/api-docs', function () {
    return view('api-docs');
});

// Routes pour les mentions légales
Route::get('/mentions-legales', function () {
    return view('legal.mentions');
});

Route::get('/politique-confidentialite', function () {
    return view('legal.privacy');
});
