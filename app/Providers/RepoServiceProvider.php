<?php

namespace App\Providers;

use App\Http\Repository\EscapeRoomRepository;
use App\Http\Repository\IBaseRepository;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider
{
    /**
     * Register Repository dependency injection
     *
     * @return void
     */
    public static function register(): void
    {
        app()->bind(IBaseRepository::class, EscapeRoomRepository::class);
    }
}
