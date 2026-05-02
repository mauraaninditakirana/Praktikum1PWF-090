<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Dedoc\Scramble\Scramble;
// PERUBAHAN: Namespace ini disesuaikan ke versi Scramble terbaru agar tidak error
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

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
        // Gate untuk Hak Akses Fitur Web
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });
        
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin';
        });

        // Konfigurasi Dokumentasi API (Scramble)
        Scramble::configure()
            ->routes(function (Route $route) {
                // Hanya mendokumentasikan rute yang berawalan 'api/'
                return Str::startsWith($route->uri, 'api/');
            })
            ->withDocumentTransformers(function (OpenApi $openApi) {
                // Menambahkan fitur otentikasi Bearer Token di UI Scramble
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });

        // Mengizinkan siapa saja (termasuk yang belum login) untuk melihat halaman dokumentasi
        Gate::define('viewApiDocs', function (?User $user = null) {
            return true;
        });
    }
}