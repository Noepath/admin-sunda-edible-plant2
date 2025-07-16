<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Auth;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth = null)
    {
        $this->auth = $auth;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'firebase_token' => 'required|string',
        ]);

        try {
            // Get the Firebase token from the request
            $token = $request->input('firebase_token');
            $userInfo = null;

            // Try to verify token with Firebase if auth service is available
            if ($this->auth) {
                try {
                    $verifiedIdToken = $this->auth->verifyIdToken($token);
                    $uid = $verifiedIdToken->claims()->get('sub');
                    $userInfo = ['uid' => $uid, 'verified' => true];
                } catch (\Exception $e) {
                    \Log::warning('Firebase token verification failed: ' . $e->getMessage());
                    // Continue without server-side verification
                }
            }

            // Call the external API with the token for admin registration
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://stapin.site/api/v1/users/admin-reg');

            // Log response for debugging
            \Log::info('Admin Registration API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers()
            ]);

            if ($response->successful()) {
                // Store token and user info in session
                session([
                    'firebase_token' => $token,
                    'firebase_email' => $request->input('email'),
                    'firebase_uid' => $userInfo['uid'] ?? null,
                    'authenticated' => true,
                    'email' => $request->input('email'),
                    'admin_registered' => true
                ]);

                // Test plants API access after admin registration
                $plantsResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->get('https://stapin.site/api/v1/plants/?limit=10');

                \Log::info('Plants API Test Response:', [
                    'status' => $plantsResponse->status(),
                    'body' => $plantsResponse->body()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login and admin registration successful',
                    'user_info' => $userInfo,
                    'admin_response' => $response->json(),
                    'plants_test' => $plantsResponse->successful() ? 'Plants API accessible' : 'Plants API failed'
                ]);
            } else {
                // Handle specific API errors
                $apiError = $response->json()['detail'] ?? $response->body();

                if ($response->status() === 404 || strpos($apiError, 'tidak ditemukan') !== false) {
                    // User not found in stapin.site - but we can still create a session
                    session([
                        'firebase_token' => $token,
                        'firebase_email' => $request->input('email'),
                        'firebase_uid' => $userInfo['uid'] ?? null,
                        'authenticated' => true,
                        'email' => $request->input('email'),
                        'api_status' => 'user_not_found_in_backend'
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Firebase login successful, but user not registered in backend system',
                        'warning' => 'User not found in stapin.site backend',
                        'user_info' => $userInfo,
                        'api_error' => $apiError
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'API call failed: ' . $apiError,
                    'status_code' => $response->status(),
                    'full_response' => $response->body()
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed: ' . $e->getMessage()
            ], 401);
        }
    }

    public function logout()
    {
        // Clear all session data
        session()->flush();

        // Clear specific Firebase session keys
        session()->forget(['firebase_token', 'firebase_email', 'firebase_uid', 'authenticated']);

        // Invalidate the session
        session()->invalidate();

        // Regenerate the session token
        session()->regenerateToken();

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
