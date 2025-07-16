<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Auth::class, function ($app) {
            try {
                $serviceAccountPath = config('firebase.service_account_path');

                if (file_exists($serviceAccountPath)) {
                    $factory = (new Factory)
                        ->withServiceAccount($serviceAccountPath);
                } else {
                    // Fallback to project ID only
                    $factory = (new Factory)
                        ->withProjectId(config('firebase.project_id'));
                }

                return $factory->createAuth();
            } catch (\Exception $e) {
                // Log error and return null for graceful degradation
                \Log::error('Firebase Auth initialization failed: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
