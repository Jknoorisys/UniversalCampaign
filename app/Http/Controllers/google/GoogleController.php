<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Auth\CredentialsLoader;
use Google\Auth\OAuth2;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Loop;
use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;
use UnexpectedValueException;

class GoogleController extends Controller
{
    /**
     * @var string the OAuth2 scope for the Google Ads API
     * @see https://developers.google.com/google-ads/api/docs/oauth/internals#scope
     */
    private const SCOPE = 'https://www.googleapis.com/auth/adwords';

    /**
     * @var string the Google OAuth2 authorization URI for OAuth2 requests
     * @see https://developers.google.com/identity/protocols/OAuth2InstalledApp#step-2-send-a-request-to-googles-oauth-20-server
     */
    private const AUTHORIZATION_URI = 'https://accounts.google.com/o/oauth2/v2/auth';

    /**
     * @var string the OAuth2 call back IP address.
     */
    private const OAUTH2_CALLBACK_IP_ADDRESS = '127.0.0.1';

    public static function main()
    {
        if (!class_exists(HttpServer::class)) {
            echo 'Please install "react/http" package to be able to run this example';
            exit(1);
        }

        // Creates a socket for localhost with random port. Port 0 is used to tell the SocketServer
        // to create a server with a random port.
        $socket = new SocketServer(self::OAUTH2_CALLBACK_IP_ADDRESS . ':0');

        // To fill in the values below, generate a client ID and client secret from the Google Cloud
        // Console (https://console.cloud.google.com) by creating credentials for either a web or
        // desktop app OAuth client ID.
        // If using a web application, add the following to its "Authorized redirect URIs":
        //   http://127.0.0.1
        print 'Enter your OAuth2 client ID here: ';
        $clientId = trim(fgets(STDIN));

        print 'Enter your OAuth2 client secret here: ';
        $clientSecret = trim(fgets(STDIN));

        $redirectUrl = str_replace('tcp:', 'http:', $socket->getAddress());
        $oauth2 = new OAuth2(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'authorizationUri' => self::AUTHORIZATION_URI,
                'redirectUri' => $redirectUrl,
                'tokenCredentialUri' => CredentialsLoader::TOKEN_CREDENTIAL_URI,
                'scope' => self::SCOPE,
                // Create a 'state' token to prevent request forgery. See
                // https://developers.google.com/identity/protocols/OpenIDConnect#createxsrftoken
                // for details.
                'state' => sha1(openssl_random_pseudo_bytes(1024))
            ]
        );

        $authToken = null;

        $server = new HttpServer(
            function (ServerRequestInterface $request) use ($oauth2, &$authToken) {
                // Stops the server after tokens are retrieved.
                if (!is_null($authToken)) {
                    Loop::stop();
                }

                // Check if the requested path is the one set as the redirect URI. We add '/' here
                // so the parse_url method can function correctly, since it cannot detect the URI
                // without '/' at the end, which is the case for the value of getRedirectUri().
                if (
                    $request->getUri()->getPath()
                    !== parse_url($oauth2->getRedirectUri() . '/', PHP_URL_PATH)
                ) {
                    return new Response(
                        404,
                        ['Content-Type' => 'text/plain'],
                        'Page not found'
                    );
                }

                // Exit if the state is invalid to prevent request forgery.
                $state = $request->getQueryParams()['state'];
                if (empty($state) || ($state !== $oauth2->getState())) {
                    throw new UnexpectedValueException(
                        "The state is empty or doesn't match expected one." . PHP_EOL
                    );
                };

                // Set the authorization code and fetch refresh and access tokens.
                $code = $request->getQueryParams()['code'];
                $oauth2->setCode($code);
                $authToken = $oauth2->fetchAuthToken();

                $refreshToken = $authToken['refresh_token'];
                print 'Your refresh token is: ' . $refreshToken . PHP_EOL;

                $propertiesToCopy = '[GOOGLE_ADS]' . PHP_EOL;
                $propertiesToCopy .= 'developerToken = "INSERT_DEVELOPER_TOKEN_HERE"' . PHP_EOL;
                $propertiesToCopy .=  <<<EOD
; Required for manager accounts only: Specify the login customer ID used to authenticate API calls.
; This will be the customer ID of the authenticated manager account. You can also specify this later
; in code if your application uses multiple manager account + OAuth pairs.
; loginCustomerId = "INSERT_LOGIN_CUSTOMER_ID_HERE"
EOD;
                $propertiesToCopy .= PHP_EOL . '[OAUTH2]' . PHP_EOL;
                $propertiesToCopy .= "clientId = \"{$oauth2->getClientId()}\"" . PHP_EOL;
                $propertiesToCopy .= "clientSecret = \"{$oauth2->getClientSecret()}\"" . PHP_EOL;
                $propertiesToCopy .= "refreshToken = \"$refreshToken\"" . PHP_EOL;

                print 'Copy the text below into a file named "google_ads_php.ini" in your home '
                    . 'directory, and replace "INSERT_DEVELOPER_TOKEN_HERE" with your developer '
                    . 'token:' . PHP_EOL;
                print PHP_EOL . $propertiesToCopy;

                return new Response(
                    200,
                    ['Content-Type' => 'text/plain'],
                    'Your refresh token has been fetched. Check the console output for '
                    . 'further instructions.'
                );
            }
        );

        $server->listen($socket);
        printf(
            'Log into the Google account you use for Google Ads and visit the following URL '
            . 'in your web browser: %1$s%2$s%1$s%1$s',
            PHP_EOL,
            $oauth2->buildFullAuthorizationUri(['access_type' => 'offline'])
        );
    }
}
