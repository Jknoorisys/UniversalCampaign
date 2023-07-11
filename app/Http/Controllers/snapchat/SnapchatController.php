<?php

namespace App\Http\Controllers\snapchat;

use App\Http\Controllers\Controller;
use App\Models\SnapchatTokens;
use GuzzleHttp\Client;
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

        return $responseData;
    }

    // Get All Organizations with Ad Accounts
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

        return $responseBody;
    }
}
