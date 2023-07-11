<?php

namespace App\Providers;

use Google\Ads\GoogleAds\Lib\V6\GoogleAdsClient;
use Illuminate\Support\ServiceProvider;

class GoogleAdsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GoogleAdsClient::class, function () {
            return new GoogleAdsClient([
                'clientId' => config('google-ads.clientId'),
                'clientSecret' => config('google-ads.clientSecret'),
                'refreshToken' => config('google-ads.refreshToken'),
                'developerToken' => config('google-ads.developerToken'),
                'loginCustomerId' => config('google-ads.customerId'),
            ]);
        });
    }
}
