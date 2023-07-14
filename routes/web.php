<?php

use App\Http\Controllers\campaign\CampaignController;
use App\Http\Controllers\snapchat\SnapchatController;
use App\Http\Controllers\facebook\FacebookMarketingController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('create-campaign', function () {
    return view('create-campaign');
});

Route::post('createCampaign', [CampaignController::class, 'createCampaign']);


Route::prefix('snapchat')->group(function () {
    Route::get('generate-token', [SnapchatController::class, 'generateToken']);
    Route::get('refresh-token', [SnapchatController::class, 'refreshToken']);
    Route::get('get-all-organizations', [SnapchatController::class, 'getAllOrganizations']);
    Route::get('get-all-adAccounts', [SnapchatController::class, 'getAllAdAccounts']);
    Route::get('get-all-campaigns/{id}', [SnapchatController::class, 'getAllCampaigns']);
    Route::get('create-campaign-form/{id}', [SnapchatController::class, 'createCampaignForm']);
    Route::post('create-campaign', [SnapchatController::class, 'createCampaign']);
    Route::get('create-ad-group-form/{id}', [SnapchatController::class, 'createAdGroupForm']);

});

Route::prefix('facebook')->group(function () {
    Route::get('facebook-integration',[FacebookMarketingController::class,'integrateWithAPI']);
    Route::get('facebook-authentication',[FacebookMarketingController::class,'generateUserAccessToken']);
    Route::get('facebook-create-campaign',[FacebookMarketingController::class,'createCampaign']);
    Route::get('facebook-getAllAdAccount',[FacebookMarketingController::class,'getAllAdAccount']);
    Route::get('facebook-get-all-campaigns/{id}',[FacebookMarketingController::class,'getAllCampaign']);
    Route::get('create-campaign-form/{id}', [FacebookMarketingController::class, 'createCampaignForm']);
    Route::get('generateToken', [FacebookMarketingController::class, 'token']);

    
});