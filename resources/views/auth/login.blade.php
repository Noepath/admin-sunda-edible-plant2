<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Sunda Edible Plant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gradient-to-br from-green-400 to-blue-600 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                    Admin Login
                </h2>
                <p class="mt-2 text-center text-sm text-gray-200">
                    Sunda Edible Plant Administration
                </p>
                <div class="mt-4 p-3 bg-white bg-opacity-20 rounded-lg">
                    <p class="text-center text-xs text-white">
                        <strong>Quick Test:</strong> Email & Password sudah diisi otomatis<br>
                        Atau gunakan email dummy: admin@test.com, user@demo.com
                    </p>
                </div>
            </div>
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow-lg" id="loginForm">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input id="email" name="email" type="email" required
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="admin@test.com (testing email)"
                           value="admin@test.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="password123 (testing password)"
                           value="password123">
                </div>

                <div>
                    <button type="submit" id="loginBtn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50">
                        <span id="loginText">Sign in</span>
                        <span id="loadingText" class="hidden">Signing in...</span>
                    </button>
                </div>

                <div class="text-center">
                    <a href="/register" class="text-green-600 hover:text-green-500">
                        Don't have an account? Register here
                    </a>
                </div>

                <div id="errorMessage" class="hidden mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                </div>

                <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                </div>

                @if(session('success'))
                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script type="module">
        // Firebase configuration
        const firebaseConfig = {
            apiKey: "{{ config('firebase.api_key') }}",
            authDomain: "{{ config('firebase.auth_domain') }}",
            projectId: "{{ config('firebase.project_id') }}",
            storageBucket: "{{ config('firebase.storage_bucket') }}",
            messagingSenderId: "{{ config('firebase.messaging_sender_id') }}",
            appId: "{{ config('firebase.app_id') }}",
            measurementId: "{{ config('firebase.measurement_id') }}"
        };

        // Initialize Firebase
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
        import { getAuth, signInWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        // Get form elements
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginBtn = document.getElementById('loginBtn');
        const loginText = document.getElementById('loginText');
        const loadingText = document.getElementById('loadingText');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');

        // Handle form submission
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = emailInput.value;
            const password = passwordInput.value;

            // Show loading state
            loginBtn.disabled = true;
            loginText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');

            try {
                // Sign in with Firebase
                const userCredential = await signInWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;

                // Get the ID token
                const idToken = await user.getIdToken();

                // Send token to Laravel backend
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        firebase_token: idToken
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message with token and admin registration status
                    const tokenPreview = idToken.substring(0, 50) + '...';
                    let adminStatus = '';

                    if (data.admin_registered) {
                        adminStatus = '<p class="text-sm text-green-600">✅ Admin registration successful</p>';
                    } else if (data.warning) {
                        adminStatus = `<p class="text-sm text-yellow-600">⚠️ ${data.warning}</p>`;
                    }

                    let plantsStatus = '';
                    if (data.plants_test) {
                        plantsStatus = `<p class="text-sm text-blue-600">🌱 ${data.plants_test}</p>`;
                    }

                    successMessage.innerHTML = `
                        <div class="space-y-3">
                            <p class="font-semibold text-green-800">✅ Login successful!</p>
                            ${adminStatus}
                            ${plantsStatus}
                            <div class="bg-white p-3 rounded border">
                                <p class="text-sm text-gray-700 mb-2"><strong>Firebase Token:</strong></p>
                                <div class="flex items-center space-x-2">
                                    <input type="text" readonly value="${idToken}"
                                           class="flex-1 px-2 py-1 text-xs border rounded font-mono bg-gray-50"
                                           onclick="this.select()" id="login-token">
                                    <button onclick="copyLoginToken()"
                                            class="px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                        📋 Copy
                                    </button>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Token berhasil dibuat dan siap digunakan untuk API!</p>
                            </div>
                            <p class="text-sm">Redirecting to dashboard...</p>
                        </div>
                    `;
                    successMessage.classList.remove('hidden');

                    // Redirect or handle successful login
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 3000); // Increased time to allow copying
                } else {
                    throw new Error(data.message || 'Login failed');
                }

            } catch (error) {
                console.error('Login error:', error);
                errorMessage.textContent = error.message || 'An error occurred during login';
                errorMessage.classList.remove('hidden');
            } finally {
                // Reset loading state
                loginBtn.disabled = false;
                loginText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        });

        // Function to copy token from login success message
        function copyLoginToken() {
            const tokenInput = document.getElementById('login-token');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999);

            try {
                document.execCommand('copy');

                // Show feedback
                const copyBtn = event.target;
                const originalText = copyBtn.textContent;
                copyBtn.textContent = '✅ Copied!';
                copyBtn.classList.add('bg-green-600');
                copyBtn.classList.remove('bg-blue-600');

                setTimeout(() => {
                    copyBtn.textContent = originalText;
                    copyBtn.classList.remove('bg-green-600');
                    copyBtn.classList.add('bg-blue-600');
                }, 2000);

                // Use modern clipboard API if available
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(tokenInput.value);
                }
            } catch (err) {
                console.error('Failed to copy token: ', err);
            }
        }
    </script>
</body>
</html>
