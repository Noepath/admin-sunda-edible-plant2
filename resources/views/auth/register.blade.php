<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sunda Edible Plant Admin</title>
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
                    Register Admin
                </h2>
                <p class="mt-2 text-center text-sm text-gray-200">
                    Create new admin account
                </p>
            </div>
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow-lg" id="registerForm">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input id="email" name="email" type="email" required
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="Enter your email">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="Enter your password (min 6 characters)">
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input id="confirmPassword" name="confirmPassword" type="password" required
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="Confirm your password">
                </div>

                <div>
                    <button type="submit" id="registerBtn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50">
                        <span id="registerText">Create Account</span>
                        <span id="loadingText" class="hidden">Creating Account...</span>
                    </button>
                </div>

                <div class="text-center">
                    <a href="/login" class="text-green-600 hover:text-green-500">
                        Already have an account? Login here
                    </a>
                </div>

                <div id="errorMessage" class="hidden mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                </div>

                <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                </div>
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
        import { getAuth, createUserWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        // Get form elements
        const registerForm = document.getElementById('registerForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const registerBtn = document.getElementById('registerBtn');
        const registerText = document.getElementById('registerText');
        const loadingText = document.getElementById('loadingText');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');

        // Handle form submission
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = emailInput.value;
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Validate passwords match
            if (password !== confirmPassword) {
                errorMessage.textContent = 'Passwords do not match';
                errorMessage.classList.remove('hidden');
                return;
            }

            if (password.length < 6) {
                errorMessage.textContent = 'Password must be at least 6 characters';
                errorMessage.classList.remove('hidden');
                return;
            }

            // Show loading state
            registerBtn.disabled = true;
            registerText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');

            try {
                // Create user with Firebase
                const userCredential = await createUserWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;

                successMessage.innerHTML = `
                    <strong>Account created successfully!</strong><br>
                    Email: ${email}<br>
                    You can now <a href="/login" class="underline font-semibold">login here</a>
                `;
                successMessage.classList.remove('hidden');

                // Clear form
                registerForm.reset();

            } catch (error) {
                console.error('Registration error:', error);
                let errorMsg = 'An error occurred during registration';

                if (error.code === 'auth/email-already-in-use') {
                    errorMsg = 'Email already in use. Please use a different email or login.';
                } else if (error.code === 'auth/weak-password') {
                    errorMsg = 'Password is too weak. Please use a stronger password.';
                } else if (error.code === 'auth/invalid-email') {
                    errorMsg = 'Invalid email address.';
                }

                errorMessage.textContent = errorMsg;
                errorMessage.classList.remove('hidden');
            } finally {
                // Reset loading state
                registerBtn.disabled = false;
                registerText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
