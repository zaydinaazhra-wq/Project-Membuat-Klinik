<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Reservasi;

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
        // Bagikan jumlah reservasi dengan status 'menunggu' ke semua tampilan
        View::composer('*', function ($view) {
            $pendingReservasiCount = Reservasi::where('status', 'menunggu')->count();
            $view->with('pendingReservasiCount', $pendingReservasiCount);
        });
    }
}
