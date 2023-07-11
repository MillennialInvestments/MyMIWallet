<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'vendor/autoload.php';

class GoogleAPI {

    function getClient() {
        $client = new Google_Client();
        $client->setApplicationName("Your_Application_Name");
        $client->setDeveloperKey("Your_API_Key"); // Set your API Key
        $client->setClientId("Your_Client_ID"); // Set your Client ID
        $client->setClientSecret("Your_Client_Secret"); // Set your Client Secret
        $client->setRedirectUri("Your_Redirect_URI"); // Set your Redirect URI
        $client->setScopes(array(
            'https://www.googleapis.com/auth/analytics.readonly',
            'https://www.googleapis.com/auth/webmasters'
        )); // Set your Scopes
        $client->setAccessType('offline');

        return $client;
    }
}
