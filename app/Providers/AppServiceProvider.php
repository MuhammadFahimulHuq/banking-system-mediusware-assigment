<?php

namespace App\Providers;


use App\Services\Transaction\TransactionService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    { 
        $this->app->bind(UserService::class);
        $this->app->bind(TransactionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
