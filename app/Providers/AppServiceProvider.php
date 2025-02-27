<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator; // Asegúrate de importar esta clase correctamente
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap(); // Aquí faltaba el punto y coma
    }
}
