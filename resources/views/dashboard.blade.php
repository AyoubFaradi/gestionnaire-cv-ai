<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestionnaire Intelligent de CV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-file-alt text-indigo-600 text-2xl mr-3"></i>
                        <span class="text-xl font-semibold text-gray-900">Gestionnaire de CV</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span id="userName" class="text-sm text-gray-700"></span>
                    <button onclick="logout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h1 class="text-2xl font-bold text-gray-900">Bienvenue dans votre Dashboard</h1>
                    <p class="mt-1 text-gray-600">Gérez votre CV et accédez aux fonctionnalités IA</p>
                </div>
            </div>
        </div>

        <!-- Grid des fonctionnalités -->
        <div class="px-4 py-6 sm:px-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Profil -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Mon Profil</dt>
                                    <dd class="text-lg font-medium text-gray-900">Gérer mes informations</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="manageProfile()" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Gérer le profil →
                        </button>
                    </div>
                </div>

                <!-- Expériences -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-briefcase text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Expériences</dt>
                                    <dd class="text-lg font-medium text-gray-900">Mon parcours professionnel</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="manageExperiences()" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Gérer les expériences →
                        </button>
                    </div>
                </div>

                <!-- Formations -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Formations</dt>
                                    <dd class="text-lg font-medium text-gray-900">Mon parcours académique</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="manageFormations()" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Gérer les formations →
                        </button>
                    </div>
                </div>

                <!-- Compétences -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <i class="fas fa-cogs text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Compétences</dt>
                                    <dd class="text-lg font-medium text-gray-900">Mes compétences techniques</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="manageSkills()" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Gérer les compétences →
                        </button>
                    </div>
                </div>

                <!-- Génération IA -->
                <div class="bg-white overflow-hidden shadow rounded-lg border-2 border-purple-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <i class="fas fa-magic text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">IA</dt>
                                    <dd class="text-lg font-medium text-gray-900">Générer avec l'IA</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="generateWithAI()" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                            Accéder à l'IA →
                        </button>
                    </div>
                </div>

                <!-- Offres d'emploi -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                <i class="fas fa-search text-white text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Offres d'emploi</dt>
                                    <dd class="text-lg font-medium text-gray-900">Consulter les offres</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <button onclick="viewJobOffers()" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Voir les offres →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- API Documentation -->
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-code mr-2"></i>Documentation API
                    </h2>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2">Base URL: <code class="bg-gray-200 px-2 py-1 rounded">/api</code></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <h3 class="font-semibold text-gray-700 mb-2">Authentification:</h3>
                                <ul class="space-y-1 text-gray-600">
                                    <li><code class="bg-gray-200 px-1 rounded">POST /login</code> - Connexion</li>
                                    <li><code class="bg-gray-200 px-1 rounded">POST /register</code> - Inscription</li>
                                    <li><code class="bg-gray-200 px-1 rounded">POST /logout</code> - Déconnexion</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-700 mb-2">CRUD:</h3>
                                <ul class="space-y-1 text-gray-600">
                                    <li><code class="bg-gray-200 px-1 rounded">GET/POST/PUT/DELETE /profiles</code></li>
                                    <li><code class="bg-gray-200 px-1 rounded">GET/POST/PUT/DELETE /experiences</code></li>
                                    <li><code class="bg-gray-200 px-1 rounded">GET/POST/PUT/DELETE /skills</code></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const API_BASE = '/api';
        let currentUser = null;
        let authToken = null;

        // Vérifier l'authentification
        function checkAuth() {
            authToken = localStorage.getItem('token');
            currentUser = JSON.parse(localStorage.getItem('user') || 'null');

            if (!authToken || !currentUser) {
                window.location.href = '/';
                return false;
            }

            // Afficher le nom de l'utilisateur
            document.getElementById('userName').textContent = currentUser.name;
            return true;
        }

        // Déconnexion
        async function logout() {
            try {
                await fetch(`${API_BASE}/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            } finally {
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                window.location.href = '/';
            }
        }

        // Fonctions de navigation
        function manageProfile() {
            alert('Fonctionnalité de gestion du profil - À implémenter avec l\'API /api/profiles');
        }

        function manageExperiences() {
            alert('Fonctionnalité de gestion des expériences - À implémenter avec l\'API /api/experiences');
        }

        function manageFormations() {
            alert('Fonctionnalité de gestion des formations - À implémenter avec l\'API /api/formations');
        }

        function manageSkills() {
            alert('Fonctionnalité de gestion des compétences - À implémenter avec l\'API /api/skills');
        }

        function generateWithAI() {
            alert('Fonctionnalités IA - À implémenter avec l\'API /api/ai/*');
        }

        function viewJobOffers() {
            alert('Consultation des offres - À implémenter avec l\'API /api/job-offers');
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            if (!checkAuth()) {
                return;
            }

            // Charger les données de l'utilisateur
            loadUserData();
        });

        async function loadUserData() {
            try {
                const response = await fetch(`${API_BASE}/profile`, {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const profile = await response.json();
                    console.log('Profile loaded:', profile);
                }
            } catch (error) {
                console.error('Error loading profile:', error);
            }
        }
    </script>
</body>
</html>
