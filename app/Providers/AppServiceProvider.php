<?php

namespace App\Providers;
use Google\Auth\FetchAuthTokenInterface;
use Google\Auth\OAuth2;

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
        $this->app->bind(FetchAuthTokenInterface::class, function ($app) {
            $config = config('google_ads');
    
            $oauth2 = new OAuth2([
                'clientId' => $config['client_id'],
                'clientSecret' => $config['client_secret'],
                'refreshToken' => $config['refresh_token'],
            ]);
    
            return $oauth2->fetchAuthToken();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
