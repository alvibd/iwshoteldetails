<?php

namespace App\Providers;

use App\amarroom\AmarRoomService;
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
        $this->app->bind(AmarRoomService::class, function ($app){
            return new AmarRoomService($app->make('\GuzzleHttp\Client'));
        });
    }
}
