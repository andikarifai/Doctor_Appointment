<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AppointmentService;
use App\Repositories\AppointmentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(AppointmentService::class, function ($app) {
            return new AppointmentService($app->make(AppointmentRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
