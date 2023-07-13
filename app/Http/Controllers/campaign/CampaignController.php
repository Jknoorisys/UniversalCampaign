<?php

namespace App\Http\Controllers\campaign;

use App\Http\Controllers\Controller;
use App\Models\SnapchatTokens;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    function createCampaign(Request $request) {
        return $request->all();
        
    }
}
