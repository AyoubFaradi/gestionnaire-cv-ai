<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestionnaire Intelligent de CV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-8">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-indigo-600 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-file-alt text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Gestionnaire de CV</h2>
            <p class="mt-2 text-sm text-gray-600">Connectez-vous pour gérer votre CV avec l'IA</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <form id="loginForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="jean.dupont@example.com">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Se souvenir de moi</label>
                    </div>
                </div>

                <div>
                    <button type="submit" id="loginBtn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-indigo-500 group-hover:text-indigo-400"></i>
                        </span>
                        <span id="loginText">Se connecter</span>
                        <span id="loadingSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i> Connexion...
                        </span>
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte ? 
                        <button type="button" id="showRegisterBtn" class="font-medium text-indigo-600 hover:text-indigo-500">
                            S'inscrire
                        </button>
                    </p>
                </div>
            </form>
        </div>

        <!-- Formulaire d'inscription (caché par défaut) -->
        <div id="registerSection" class="bg-white rounded-lg shadow-lg p-8 hidden">
            <form id="registerForm" class="space-y-6">
                <div>
                    <label for="registerName" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input id="registerName" name="name" type="text" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Jean Dupont">
                </div>

                <div>
                    <label for="registerEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="registerEmail" name="email" type="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="jean.dupont@example.com">
                </div>

                <div>
                    <label for="registerPassword" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="registerPassword" name="password" type="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="••••••••">
                </div>

                <div>
                    <label for="passwordConfirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input id="passwordConfirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="••••••••">
                </div>

                <div>
                    <button type="submit" id="registerBtn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-green-500 group-hover:text-green-400"></i>
                        </span>
                        <span id="registerText">S'inscrire</span>
                        <span id="registerSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i> Inscription...
                        </span>
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Déjà un compte ? 
                        <button type="button" id="showLoginBtn" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Se connecter
                        </button>
                    </p>
                </div>
            </form>
        </div>

        <!-- Messages d'erreur -->
        <div id="errorAlert" class="hidden bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Erreur</h3>
                    <div id="errorMessage" class="mt-2 text-sm text-red-700"></div>
                </div>
            </div>
        </div>

        <!-- Message de succès -->
        <div id="successAlert" class="hidden bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Succès</h3>
                    <div id="successMessage" class="mt-2 text-sm text-green-700"></div>
                </div>
            </div>
        </div>

        <!-- Compte de test -->
        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Compte de test</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Email: <code>jean.dupont@example.com</code></p>
                        <p>Mot de passe: <code>password123</code></p>
                    </div>
                    <div class="mt-2 text-xs text-blue-600">
                        <p><strong>Note:</strong> Si l'inscription échoue, c'est probablement parce que cet email est déjà utilisé.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_BASE = '/api';
        
        // Elements DOM
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const loginSection = loginForm.parentElement;
        const registerSection = document.getElementById('registerSection');
        const showRegisterBtn = document.getElementById('showRegisterBtn');
        const showLoginBtn = document.getElementById('showLoginBtn');
        const errorAlert = document.getElementById('errorAlert');
        const successAlert = document.getElementById('successAlert');

        // Toggle entre login et register
        showRegisterBtn.addEventListener('click', () => {
            loginSection.classList.add('hidden');
            registerSection.classList.remove('hidden');
            hideMessages();
        });

        showLoginBtn.addEventListener('click', () => {
            registerSection.classList.add('hidden');
            loginSection.classList.remove('hidden');
            hideMessages();
        });

        // Login
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            hideMessages();
            
            const formData = new FormData(loginForm);
            const data = Object.fromEntries(formData);
            
            setLoading('login', true);
            
            try {
                const response = await fetch(`${API_BASE}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    localStorage.setItem('token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));
                    showSuccess('Connexion réussie! Redirection...');
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1500);
                } else {
                    if (response.status === 422 && result.errors) {
                        // Erreurs de validation
                        const errorMessages = Object.values(result.errors).flat();
                        showError(errorMessages.join(', '));
                    } else {
                        // Autres erreurs
                        showError(result.message || 'Erreur de connexion');
                    }
                }
            } catch (error) {
                showError('Erreur de connexion au serveur');
            } finally {
                setLoading('login', false);
            }
        });

        // Register
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            hideMessages();
            
            const formData = new FormData(registerForm);
            const data = Object.fromEntries(formData);
            
            if (data.password !== data.password_confirmation) {
                showError('Les mots de passe ne correspondent pas');
                return;
            }
            
            setLoading('register', true);
            
            try {
                const response = await fetch(`${API_BASE}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    localStorage.setItem('token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));
                    showSuccess('Inscription réussie! Redirection...');
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1500);
                } else {
                    if (response.status === 422 && result.errors) {
                        // Erreurs de validation
                        const errorMessages = Object.values(result.errors).flat();
                        showError(errorMessages.join(', '));
                    } else {
                        // Autres erreurs
                        showError(result.message || 'Erreur d\'inscription');
                    }
                }
            } catch (error) {
                showError('Erreur de connexion au serveur');
            } finally {
                setLoading('register', false);
            }
        });

        function setLoading(form, loading) {
            if (form === 'login') {
                document.getElementById('loginText').classList.toggle('hidden', loading);
                document.getElementById('loadingSpinner').classList.toggle('hidden', !loading);
                document.getElementById('loginBtn').disabled = loading;
            } else {
                document.getElementById('registerText').classList.toggle('hidden', loading);
                document.getElementById('registerSpinner').classList.toggle('hidden', !loading);
                document.getElementById('registerBtn').disabled = loading;
            }
        }

        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            errorAlert.classList.remove('hidden');
        }

        function showSuccess(message) {
            document.getElementById('successMessage').textContent = message;
            successAlert.classList.remove('hidden');
        }

        function hideMessages() {
            errorAlert.classList.add('hidden');
            successAlert.classList.add('hidden');
        }
    </script>
</body>
</html>
