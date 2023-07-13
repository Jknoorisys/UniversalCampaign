<?php

namespace App\Http\Controllers\facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FacebookMarketingController extends Controller
{
    public function integrateWithAPI()
    {
        $accessToken = 'EAAL4ugcpMaABAGkielnFZBqyYaFrNTGRwMHgAWi76GoIbrw8ajahZA9NaVJolWQdnoxa9b637iDvVCd53GBUEoIAWP1v4I8HStmkJvbBX9Pp4d9WGuMIShFqxIVn7wPxQsZCC3qGZCnWZA3VeSMfDUZA17IizIPD7ZAhst85aZAINK1N2FqEA4LZBl8esH8qekAZA0cYsue3t39IHRb34oojfCTZBOXYizPZBrUZD';
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
    public function getAllAdAccount()
    {
        $apiUrl = 'https://graph.facebook.com/v17.0/me/adaccounts';
        $accessToken = 'EAAL4ugcpMaABADRSDVrUxrmfsFZBqiPG3F40urU1Lv9rcJhfeqLZAYh5SNqGFtRpefpuZBmALDRDHyHuZAlR6SfJvpn7ew9d6a4d2XMJktRq6dhpjxtNayJTa4HCnWWYkXd2ZCXi3al3Si146UGXzUM9FWBhlxyQ5rytEhDirTQLIZCwTgQIvW9hTq2KCz6jT4wWKvClpeSeWDXm15kRb3OO6adAqqdIcZD';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $addAccounts = json_decode($response, true);
        // return $addAccounts;
        $data['addAccounts'] = $addAccounts['data'];

        // return $addAccounts['data'];
        // Access the ad accounts data
        // foreach ($adAccountsData['data'] as $addAccounts) {
        //     $addAccountsId = $addAccounts['account_id'];
        //     $addAccountsName = $addAccounts['id'];

        //     // Do something with the ad account ID and name
        // }
        return view('facebook.ad_accounts', $data);
    }
    public function getAllCampaign($ad_account_id)
    {
        $apiUrl = 'https://graph.facebook.com/v17.0/act_1250917015624823/campaigns';
        $accessToken = 'EAAL4ugcpMaABADRSDVrUxrmfsFZBqiPG3F40urU1Lv9rcJhfeqLZAYh5SNqGFtRpefpuZBmALDRDHyHuZAlR6SfJvpn7ew9d6a4d2XMJktRq6dhpjxtNayJTa4HCnWWYkXd2ZCXi3al3Si146UGXzUM9FWBhlxyQ5rytEhDirTQLIZCwTgQIvW9hTq2KCz6jT4wWKvClpeSeWDXm15kRb3OO6adAqqdIcZD';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $campaignsData = json_decode($response, true);
        $data['campaigns'] = $campaignsData['data'];
        $data['ad_account_id'] = $ad_account_id;
        return view('facebook.campaigns', $data);
        
        // Access the campaigns data
        // foreach ($campaignsData['data'] as $campaign) {
        //     $campaignId = $campaign['id'];
        //     $campaignName = $campaign['name'];
        //     return $campaign;
        //     // Do something with the campaign ID and name
        // }
    }
    public function createCampaignForm($ad_account_id)
    {
        $data['ad_account_id'] = $ad_account_id;
        return view('facebook.add-campaign', $data);
    }
    public function createCampaign(Request $request)
    {
        $apiUrl = 'https://graph.facebook.com/v17.0/act_1250917015624823/campaigns';
        $accessToken = 'EAAL4ugcpMaABADRSDVrUxrmfsFZBqiPG3F40urU1Lv9rcJhfeqLZAYh5SNqGFtRpefpuZBmALDRDHyHuZAlR6SfJvpn7ew9d6a4d2XMJktRq6dhpjxtNayJTa4HCnWWYkXd2ZCXi3al3Si146UGXzUM9FWBhlxyQ5rytEhDirTQLIZCwTgQIvW9hTq2KCz6jT4wWKvClpeSeWDXm15kRb3OO6adAqqdIcZD';

        $data = [
            'name' => 'My Campaign',
            'objective' => 'OUTCOME_LEADS',
            'status' => 'PAUSED',
            'special_ad_categories' => array('credit'),
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $campaignData = json_decode($response, true);

        return response()->json($campaignData);
    }
}
