<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'vendor/autoload.php';
use TomorrowIdeas\Plaid\Plaid;

class MyMIPlaid
{
    private $client_id;
    private $secret;
    private $environment;
    private $client;

    public function __construct()
    {
        $this->CI = CI_Controller::get_instance();
        $this->CI->load->config('plaid');
        $this->CI->load->model('User/plaid_model');
        $this->client_id            = $this->CI->config->item('plaid_client_id');
        $this->secret               = $this->CI->config->item('plaid_secret');
        $this->environment          = $this->CI->config->item('plaid_environment');
        $this->client = new Plaid($this->client_id, $this->secret, $this->environment);
    }

    public function get_plaid_client()
    {
        return $this->client;
    }

    public function exchange_public_token($public_token) {
        $clientID                   = $this->CI->config->item('plaid_client_id');
        $clientSecret               = $this->CI->config->item('plaid_secret');
        $clientEnvironment          = $this->CI->config->item('plaid_environment');
        try {
            // $response = $this->client->items->exchangeToken($public_token);
            // $response       = $this->CI->plaid_model->exchange_public_token($public_token); 
            // $response       = $this->CI->plaid_model->exchange_public_token_b($public_token, $clientID, $clientSecret, $clientEnvironment); 
            $response       = $this->client()->getAccessToken($public_token); 
            error_log('Success: Access_Token: ' . $response['access_token']);
            $access_token = $response['access_token'];
        } catch (Exception $e) {
            error_log('Error in exchange_public_token: ' . $e->getMessage());
            $access_token = null;
        }

        return $access_token;
    }

    public function exchange_public_token_b($public_token)
    {
        $clientID                   = $this->CI->config->item('plaid_client_id');
        $clientSecret               = $this->CI->config->item('plaid_secret');
        try {
            // $response = $this->client->items->exchangeToken($public_token);
            $response       = $this->CI->plaid_model->exchange_public_token_b($public_token, $clientID, $clientSecret); 
            error_log('Success: Access_Token: ' . $response['access_token']);
            $access_token = $response['access_token'];
        } catch (Exception $e) {
            error_log('Error in exchange_public_token: ' . $e->getMessage());
            $access_token = null;
        }

        return $access_token;
    }

    public function get_link_token($clientID, $clientSecret)
    {
        $clientID                   = $this->CI->config->item('plaid_client_id');
        $clientSecret               = $this->CI->config->item('plaid_secret');
        return $this->CI->plaid_model->get_link_token($clientID, $clientSecret);
    }
}