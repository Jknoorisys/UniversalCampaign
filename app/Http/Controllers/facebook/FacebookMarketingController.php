<?php

namespace App\Http\Controllers\facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class FacebookMarketingController extends Controller
{
    public function integrateWithAPI()
    {
        $accessToken = '836427821167008|pfYU8tMbvBMID9nH3GrIezhhZWw';
        $url = 'https://graph.facebook.com/v13.0/me';

        $client = new Client();
        $response = $client->request('GET', $url, [
            'query' => [
                'access_token' => $accessToken
            ]
        ]);

        $data = json_decode($response->getBody()->getContents());

        // Handle the API response here
        // You can perform operations on $data returned by the API
        return $data;
    }
    public function generateUserAccessToken(Request $request)
    {
        $accessTokenUrl = 'https://graph.facebook.com/v13.0/oauth/access_token';
        
        $response = (new Client())->request('GET', $accessTokenUrl, [
            'query' => [
                'grant_type' => 'authorization_code',
                'client_id' => '836427821167008',
                'client_secret' => '76a16b4c22495ec7c88521f2ed554176',
                'redirect_uri' => 'http://127.0.0.1:8000/',
                'code' => $request->code, // The authorization code obtained from Facebook login process
            ],
        ]);
        
        $data = json_decode($response->getBody(), true);
        
        return response()->json($data);
    }
    
}
