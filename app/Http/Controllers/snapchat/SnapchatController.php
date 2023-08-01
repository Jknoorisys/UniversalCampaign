<?php

namespace App\Http\Controllers\snapchat;

use App\Http\Controllers\Controller;
use App\Models\SnapchatTokens;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class SnapchatController extends Controller
{
    // Generate Access Token
    public function generateToken() {
        // Instantiate a Guzzle client
        $client = new Client();

        // Prepare the request parameters
        $params = [
            'grant_type' => 'authorization_code',
            'client_id' => '309ca9ba-76b3-4d3b-95d9-ad414cf5229f',
            'client_secret' => '3cbcf3b6a96e29f7f858',
            'code' => '2SyoJIpqVJ9O1zGzOIJvGtfLeraVyIaDPc8UXVdvMjk',
            'redirect_uri' => 'https://f66e-2401-4900-1c9a-4624-41d3-1430-f1ba-882e.ngrok-free.app'
        ];

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->post('https://accounts.snapchat.com/login/oauth2/access_token', [
            'form_params' => $params
        ]);

        // Get the response body as JSON
        $responseData = ($response->getBody());
        return $responseData;

    } 

    // Refresh Access Token
    public function refreshToken() {
        $snapchatTokens = SnapchatTokens::first();
        $refreshToken = $snapchatTokens ? $snapchatTokens->refresh_token : '';

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

        return redirect()->to('snapchat/get-all-campaigns');
    }

    // Get All Organizations
    public function getAllOrganizations() {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';

       // Instantiate a Guzzle client
        $client = new Client();

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->get('https://adsapi.snapchat.com/v1/me/organizations', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        return $responseData;
    }

    // Get All Add Accounts
    public function getAllAdAccounts() {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $organization_id = $snapchatTokens ? $snapchatTokens->organization_id : '';

       // Instantiate a Guzzle client
        $client = new Client();

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->get('https://adsapi.snapchat.com/v1/organizations/'.$organization_id.'/adaccounts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        // return $responseData['adaccounts'];
        $data['addAccounts'] = $responseData['adaccounts'];
        return view('snapchat.ad-accounts', $data);
    }

    // Get All Campaigns
    public function getAllCampaigns() {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id;

       // Instantiate a Guzzle client
        $client = new Client();

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->get('https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/campaigns', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        // return $responseData;
        $data['campaigns'] = $responseData['campaigns'];
        $data['ad_account_id'] = $ad_account_id;
        return view('snapchat.campaigns', $data);
    }

    function createCampaignForm($ad_account_id) {
        $data['ad_account_id'] = $ad_account_id;
        return view('snapchat.add-campaign', $data);
    }

    // Create Campaign
    public function createCampaign(Request $request) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $request->ad_account_id;
        $name = $request->name;
        $start_time = Carbon::parse($request->start_time);
        $objective = $request->objective;

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

        return redirect('snapchat/get-all-campaigns');
    }

    public function createAdGroupForm($campaign_id) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id;

        $data = [
            'campaign_id' => $campaign_id,
            'ad_account_id' => $ad_account_id
        ];

        return view('snapchat.create-ad-group', $data);
    }

    // create Ad Group
     public function createAdGroup(Request $request) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $type = $request->type;
        $name = $request->name;
        $objective = $request->objective;
        $config = $request->config;
        $campaign_id = $request->campaign_id;
        $placement = $request->placement;
        $bid_strategy = $request->bid_strategy;
        $max_bid = $request->max_bid;

        $data = [
            'adsquads' => [
                [
                    'campaign_id' => $campaign_id,
                    'name' => $name,
                    'type' => $type,
                    'placement_v2' => [
                        'config' => $config,
                    ],
                    'optimization_goal' => $objective,
                    'daily_budget_micro' => 1000000000,
                    'bid_strategy' => $bid_strategy,
                    'billing_event' => 'IMPRESSION',
                    'targeting' => [
                        'geos' => [
                            [
                                'country_code' => 'us',
                            ],
                        ],
                    ],
                    'start_time' => '2016-08-11T22:03:58.869Z',
                ],
            ],
        ];

        if ($data['adsquads'][0]['placement_v2']['config'] === 'CUSTOM') {
            $data['adsquads'][0]['placement_v2']['platforms'] = ['SNAPCHAT'];
            $data['adsquads'][0]['placement_v2']['snapchat_positions'] = [$placement];
        }

        if ($data['adsquads'][0]['bid_strategy'] === 'LOWEST_COST_WITH_MAX_BID') {
            $data['adsquads'][0]['bid_micro'] = $max_bid * 1000000;
        }
       
        $url = 'https://adsapi.snapchat.com/v1/campaigns/'.$campaign_id.'/adsquads';

       // Instantiate a Guzzle client
       $client = new Client();
       
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

        return redirect()->to('snapchat/get-all-campaigns');
    }

     // create media
     public function createMedia() {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id;

        // Create a new Guzzle HTTP client instance
        $client = new Client();

        // Prepare the request data
        $data = [
            'media' => [
                [
                    'name' => 'Media A - Video',
                    'type' => 'IMAGE',
                    'ad_account_id' => $ad_account_id,
                ]
            ]
        ];

        // Prepare the headers
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ];

        // Make the POST request
        $response = $client->post('https://adsapi.snapchat.com/v1/adaccounts/'.$ad_account_id.'/media', [
            'json' => $data,
            'headers' => $headers,
        ]);

        // Get the response body
        $body = $response->getBody()->getContents();

        // Print the response body
        echo $body;
    }

    // upload media
    public function uploadMedia() {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $ad_account_id = $snapchatTokens->adaccount_id;
        $filePath = "C:\Users\Noorisys-55\Pictures\Saved Pictures\download.jpg";
        
        // Create a new Guzzle HTTP client instance
        $client = new Client();

        // Prepare the headers
        $headers = [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => 'Bearer '.$accessToken,
        ];

        // Make the POST request
        $response = $client->post('https://adsapi.snapchat.com/v1/media/dd997fa2-16f1-47d2-a6aa-af3e75c8b5ad/upload', [
            'headers' => $headers,
            RequestOptions::MULTIPART => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => 'download.jpg',
                ],
            ],
        ]);

        // Get the response body
        $body = $response->getBody()->getContents();

        // Print the response body
        echo $body;
    }

    function getAllAdSet($campaign_id) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';

       // Instantiate a Guzzle client
        $client = new Client();

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->get('https://adsapi.snapchat.com/v1/campaigns/'.$campaign_id.'/adsquads', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        $data['campaign_id'] = $campaign_id;
        $data['adsquads'] = $responseData['adsquads'];
        return view('snapchat.ad_sets', $data);
    }

    function getAllAds($ad_group_id) {
        $snapchatTokens = SnapchatTokens::first();
        $accessToken = $snapchatTokens ? $snapchatTokens->access_token : '';
        $organization_id = $snapchatTokens ? $snapchatTokens->organization_id : '';

       // Instantiate a Guzzle client
        $client = new Client();

        // Send a POST request to the Snapchat OAuth 2.0 endpoint
        $response = $client->get('https://adsapi.snapchat.com/v1/adsquads/'.$ad_group_id.'/ads', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        // Get the response body as JSON
        $responseBody = (string) $response->getBody();
        $responseData = json_decode($responseBody, true);    

        return $responseData;
        $data['ads'] = $responseData['ads'];
        return $data;
        return view('snapchat.ads', $data);
    }
}
