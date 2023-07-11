<?php

namespace App\Http\Controllers\facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class FacebookMarketingController extends Controller
{
    public function integrateWithAPI()
    {
        $accessToken = 'EAAL4ugcpMaABAP6Y09HA24vVnSvPqh5tdGFBofTGpmJLTTPTk2sOGd0YvM2ONQi2TvgMh20VN2jBCTUtOt1qz4OOBKKuc7DvxXAQ9x0cwHkfus5dUw0CKgeX993swRB1VJt05tVXjsTEjlLbVmMUbH4kaa1nLLbZC7WAy2OvvkPanCxHWZCoEezVanLmjRZC3B4xQZBaa9ogY1YbrK4k';
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
}
