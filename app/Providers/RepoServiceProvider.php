<?php

namespace App\Providers;

use App\Http\Repository\BookingRepository;
use App\Http\Repository\EscapeRoomRepository;
use App\Http\Repository\IBookingRepository;
use App\Http\Repository\IEscapeRoomRepository;

class RepoServiceProvider
{
    /**
     * Register Repository dependency injection
     *
     * @return void
     */
    public static function register(): void
    {
        app()->bind(IEscapeRoomRepository::class, EscapeRoomRepository::class);
        app()->bind(IBookingRepository::class, BookingRepository::class);
    }
}
