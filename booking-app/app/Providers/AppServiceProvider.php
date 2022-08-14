<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Contracts\Services\CustomerServiceInterface', 'App\Services\CustomerService');
        $this->app->bind('App\Contracts\Services\BookingServiceInterface', 'App\Services\BookingService');
        $this->app->bind('App\Contracts\Services\CarServiceInterface', 'App\Services\CarService');
        $this->app->bind('App\Contracts\Dao\CommonDaoInterface', 'App\Dao\CommonDao');
    }
}
