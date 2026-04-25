<?php

namespace App\Providers;

use App\Models\Product; 
use App\Policies\ProductPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Daftarkan Policy (Agar Controller tahu Product dijaga oleh ProductPolicy)
        Gate::policy(Product::class, ProductPolicy::class);

        // 2. Definisi Gate untuk Export
        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
