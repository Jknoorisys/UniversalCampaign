<?php

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

Route::prefix('snapchat')->group(function () {
    Route::get('generate-token', [SnapchatController::class, 'generateToken']);
    Route::get('refresh-token', [SnapchatController::class, 'refreshToken']);
    Route::get('get-all-organizations', [SnapchatController::class, 'getAllOrganizations']);
});

Route::prefix('facebook')->group(function () {
    Route::get('facebook-integration',[FacebookMarketingController::class,'integrateWithAPI']);
    
});