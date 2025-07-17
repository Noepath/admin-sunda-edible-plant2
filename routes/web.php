<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Protected routes
Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //     }

    //     $token = session('firebase_token');

    //     try {
    //         $response = Http::timeout(30)->withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json'
    //         ])->get('https://stapin.site/api/v1/diseases');

    //         if ($response->successful()) {
    //             return response()->json($response->json());
    //         } else {
    //             \Log::error('Diseases API error: ' . $response->status() . ' - ' . $response->body());
    //             return response()->json([
    //                 'error' => 'Failed to fetch diseases data',
    //                 'status' => $response->status(),
    //                 'message' => $response->body()
    //             ], $response->status());
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Diseases API exception: ' . $e->getMessage());
    //         return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
    //     }
    // })->name('proxy.diseases');

    // Plants routes
    Route::get('/plants', function () {
        // Check if user is authenticated with Firebase
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $data = [
            'token' => session('firebase_token'),
            'email' => session('email'),
            'admin_registered' => session('admin_registered', false),
            'api_status' => session('api_status', 'unknown')
        ];

        return view('plants.index', $data);
    })->name('plants.index');

    Route::get('/plants/create', function () {
        // Check if user is authenticated with Firebase
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $data = [
            'token' => session('firebase_token'),
            'email' => session('email'),
            'admin_registered' => session('admin_registered', false),
            'api_status' => session('api_status', 'unknown')
        ];

        return view('plants.create', $data);
    })->name('plants.create');

    Route::post('/plants', function () {
        // Handle plant creation
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // TODO: Implement plant creation logic
        return redirect()->route('plants.index')->with('success', 'Plant created successfully');
    })->name('plants.store');

    // Diseases routes
    Route::get('/diseases', function () {
        // Check if user is authenticated with Firebase
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $data = [
            'token' => session('firebase_token'),
            'email' => session('email'),
            'admin_registered' => session('admin_registered', false),
            'api_status' => session('api_status', 'unknown')
        ];

        return view('diseases.index', $data);
    })->name('diseases.index');

    // Users routes
    Route::get('/users', function () {
        // Check if user is authenticated with Firebase
        if (!session('authenticated') || !session('firebase_token')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $data = [
            'token' => session('firebase_token'),
            'email' => session('email'),
            'admin_registered' => session('admin_registered', false),
            'api_status' => session('api_status', 'unknown')
        ];

        return view('users.index', $data);
    })->name('users.index');

    // Settings routes
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
