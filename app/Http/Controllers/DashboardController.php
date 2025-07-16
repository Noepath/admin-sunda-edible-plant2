<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private const API_BASE_URL = 'https://stapin.site/api/v1';
    private const DEFAULT_LIMIT = 10;

    public function index()
    {
        // Check if user is authenticated with Firebase
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // Get token from session
        $token = Session::get('firebase_token');

        // Just pass the token to the view, let JavaScript handle the API calls
        $dashboardData = [
            'token' => $token,
            'email' => session('email'),
            'admin_registered' => session('admin_registered', false),
            'api_status' => session('api_status', 'unknown')
        ];

        return view('dashboard', $dashboardData);
    }

    /**
     * Refresh Firebase token if expired
     */
    private function refreshTokenIfNeeded(): ?string
    {
        $token = Session::get('firebase_token');

        if (!$token) {
            return null;
        }

        // Test if token is still valid
        $testResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get(self::API_BASE_URL . '/plants/', ['limit' => 1]);

        if ($testResponse->status() === 403 || $testResponse->status() === 401) {
            \Log::warning('Token expired or invalid, status: ' . $testResponse->status());
            return null;
        }

        return $token;
    }

    /**
     * Fetch plants data from API
     */
    private function fetchPlants(string $token): array
    {
        \Log::info('Fetching plants data from API');

        $response = $this->makeApiRequest('plants', $token, ['limit' => self::DEFAULT_LIMIT]);

        if ($response['success']) {
            $data = $response['data'];

            // API returns data under 'plants' key
            if (isset($data['plants'])) {
                return $data['plants'];
            } elseif (isset($data['data'])) {
                return $data['data'];
            } else {
                return is_array($data) ? $data : [];
            }
        }

        return [];
    }

    /**
     * Fetch diseases data from API
     */
    private function fetchDiseases(string $token): array
    {
        \Log::info('Fetching diseases data from API');

        $response = $this->makeApiRequest('diseases', $token, ['limit' => self::DEFAULT_LIMIT]);

        if ($response['success']) {
            $data = $response['data'];

            // API returns data under 'diseases' key
            if (isset($data['diseases'])) {
                return $data['diseases'];
            } elseif (isset($data['data'])) {
                return $data['data'];
            } else {
                return is_array($data) ? $data : [];
            }
        }

        return [];
    }

    /**
     * Fetch users data from API
     */
    private function fetchUsers(string $token): array
    {
        \Log::info('Fetching users data from API');

        $response = $this->makeApiRequest('users/admin-reg', $token);

        if ($response['success']) {
            $data = $response['data'];

            if (isset($data['users'])) {
                return $data['users'];
            } elseif (isset($data['data'])) {
                return $data['data'];
            } else {
                return is_array($data) ? $data : [];
            }
        }

        return [];
    }

    /**
     * Fetch plant categories data from API
     */
    private function fetchPlantCategories(string $token): array
    {
        \Log::info('Fetching plant categories data from API');

        $response = $this->makeApiRequest('plant-categories', $token);

        if ($response['success']) {
            $data = $response['data'];

            if (isset($data['data'])) {
                return $data['data'];
            } else {
                return is_array($data) ? $data : [];
            }
        }

        return [];
    }

    /**
     * Make API request with consistent error handling
     */
    private function makeApiRequest(string $endpoint, string $token, array $params = []): array
    {
        try {
            $url = self::API_BASE_URL . '/' . $endpoint;

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->get($url, $params);

            \Log::info("API Request to {$endpoint}:", [
                'url' => $url,
                'params' => $params,
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'status' => $response->status()
                ];
            } else {
                \Log::error("API Request failed for {$endpoint}:", [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'error' => "Failed to fetch {$endpoint} data",
                    'status' => $response->status()
                ];
            }

        } catch (\Exception $e) {
            \Log::error("API Request exception for {$endpoint}:", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    /**
     * API endpoint for fetching plants data via JavaScript
     */
    public function apiPlants()
    {
        if (!session('authenticated') || !session('firebase_token')) {
            \Log::error('API Plants: Session not authenticated or no token', [
                'authenticated' => session('authenticated'),
                'has_token' => session('firebase_token') ? 'yes' : 'no'
            ]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Session::get('firebase_token');
        \Log::info('API Plants: Using token', ['token_preview' => substr($token, 0, 20) . '...']);

        $plants = $this->fetchPlants($token);

        return response()->json(['data' => $plants]);
    }

    /**
     * API endpoint for fetching diseases data via JavaScript
     */
    public function apiDiseases()
    {
        if (!session('authenticated') || !session('firebase_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Session::get('firebase_token');
        $diseases = $this->fetchDiseases($token);

        return response()->json(['diseases' => $diseases]);
    }

    /**
     * API endpoint for fetching users data via JavaScript
     */
    public function apiUsers()
    {
        if (!session('authenticated') || !session('firebase_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Session::get('firebase_token');
        $users = $this->fetchUsers($token);

        return response()->json(['users' => $users]);
    }

    /**
     * API endpoint for fetching plant categories data via JavaScript
     */
    public function apiPlantCategories()
    {
        if (!session('authenticated') || !session('firebase_token')) {
            \Log::error('API Plant Categories: Session not authenticated or no token', [
                'authenticated' => session('authenticated'),
                'has_token' => session('firebase_token') ? 'yes' : 'no'
            ]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Session::get('firebase_token');
        \Log::info('API Plant Categories: Using token', ['token_preview' => substr($token, 0, 20) . '...']);

        $categories = $this->fetchPlantCategories($token);

        return response()->json(['data' => $categories]);
    }
}
