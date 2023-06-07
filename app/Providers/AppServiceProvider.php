<?php

namespace App\Providers;

use App\Facades\AuthFacade;
use App\Facades\BookingFacade;
use App\Facades\RoomFacade;
use App\Repositories\BookingRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use App\Repositories\RoomRepository;
use App\Repositories\TimeSlotRepository;
use App\Services\AuthService;
use App\Services\BookingService;
use App\Services\RoomService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Facades
        AuthFacade::shouldProxyTo(AuthService::class);
        BookingFacade::shouldProxyTo(BookingService::class);
        RoomFacade::shouldProxyTo(RoomService::class);

        //Repositories
        $this->app->bind(
            RoomRepositoryInterface::class,
            RoomRepository::class,
        );
        $this->app->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class,
        );
        $this->app->bind(
            TimeSlotRepositoryInterface::class,
            TimeSlotRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
