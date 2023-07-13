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
        // return $request->all();
        $name = $request->name ? $request->name : '';
        $start_time = $request->start_time ? $request->start_time : '';
        $end_time = $request->end_time ? $request->end_time : '';
        $daily_cpc = $request->daily_cpc ? $request->daily_cpc : '';
        $lifetime_cpc = $request->lifetime_cpc ? $request->lifetime_cpc : '';

        $snapchatData = [
            'objective' => $request->snapchat_objective,
            'name'      => $name,
            'start_time' => $start_time,
            'end_time'   => $end_time,
            'daily_cpc'  => $daily_cpc,
            'lifetime_cpc' => $lifetime_cpc
        ];

        $this->snapchatCampaign($snapchatData);
    }

    function snapchatCampaign($snapchatData) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id ? $snapchatTokens->adaccount_id : '';
        $name = $snapchatData->name;
        $start_time = Carbon::parse($snapchatData->start_time);
        $objective = $snapchatData->objective;

       // Instantiate a Guzzle client
        $client = new Client();

        $data = [
            'campaigns' => [
                [
                    'name' => $name,
                    'ad_account_id' => $ad_account_id,
                    'status' => 'PAUSED',
                    'start_time' => $start_time,
                    'objective' => $objective
                ]
            ]
        ];
        
        $url = 'https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/campaigns';
        
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ],
            'json' => $data
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);
        
        return true;
    }
}
