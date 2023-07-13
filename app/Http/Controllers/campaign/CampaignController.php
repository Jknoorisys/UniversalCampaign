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

        $snapchatCampaign = $this->snapchatCampaign($snapchatData);
        return $snapchatCampaign;
    }

    function snapchatCampaign($snapchatData) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $refreshToken = $snapchatTokens ? $snapchatTokens->refresh_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id ? $snapchatTokens->adaccount_id : '';

        // Instantiate a Guzzle client
        $client = new Client();

        // Prepare the request parameters
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => '309ca9ba-76b3-4d3b-95d9-ad414cf5229f',
            'client_secret' => '3cbcf3b6a96e29f7f858',
            'refresh_token' => $refreshToken,
        ];

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->post('https://accounts.snapchat.com/login/oauth2/access_token', [
            'form_params' => $params
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        $snapchatTokens->access_token = $responseData['access_token'];
        $snapchatTokens->refresh_token = $responseData['refresh_token'];
        $snapchatTokens->save();

        $name = $snapchatData['name'];
        $start_time = Carbon::parse($snapchatData['start_time']);
        $objective = $snapchatData['objective'];
        $end_time = $snapchatData['end_time'] ? Carbon::parse($snapchatData['end_time']) : null;
        $daily_budget_micro  = $snapchatData['daily_cpc'] * 1000000;
        $lifetime_spend_cap_micro  = $snapchatData['lifetime_cpc'] * 1000000;

        $data = [
            'campaigns' => [
                array_merge(
                    [
                        'name' => $name,
                        'ad_account_id' => $ad_account_id,
                        'status' => 'PAUSED',
                        'start_time' => $start_time,
                        'objective' => $objective,
                        'daily_budget_micro' => $daily_budget_micro,
                        'lifetime_spend_cap_micro' => $lifetime_spend_cap_micro,
                    ],
                    (($end_time !== null && $end_time !== '') ? ['end_time' => $end_time] : [])
                )
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
        
        return $responseData;
    }
}
