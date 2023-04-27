<?php

namespace App\Providers;

use App\Http\Repository\EscapeRoomRepository;
use App\Http\Repository\IBaseRepository;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        RepoServiceProvider::register();
    }
}
