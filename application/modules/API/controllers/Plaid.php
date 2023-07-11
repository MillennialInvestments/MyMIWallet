<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Plaid extends Admin_Controller
{
    private $cuID; 
    public function __construct()
    {
        parent::__construct();
        // Load any necessary models, libraries, or helpers here.
        // $this->load->library('MyMIUser');
        // $cuID 								= $_SESSION['user_id'];
        // $userAccount                        = $this->mymiuser->user_account_info($cuID);
    }

    public function index()
    {
        $pageType = 'Automated';
        $pageName = 'Plaid';
        
        // $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function exchange_token($cuID)
    {
        $this->load->library('http');
    
        $response = $this->http->post('https://sandbox.plaid.com/item/public_token/exchange', [
            'headers'                       => [
                'Content-Type'              => 'application/json',
            ],
            'json'                          => [
                'client_id'                 => $this->config->item('plaid_client_id'),
                'secret'                    => $this->config->item('plaid_secret'),
                'public_token'              => $this->input->post('public_token'),
            ],
        ]);
    
        if ($response->getStatusCode() === 200) {
            $responseBody                   = json_decode($response->getBody(), true);
            $beta						    = $this->config->item('beta');
            $status						    = 1;
            $unix_timestamp				    = time();
            $date                           = date("m/d/Y");
            $time                           = date('H:i:s a');
            $month						    = date("n");
            $day						    = date("j");
            $year						    = date("Y");
            $accessToken                    = $responseBody['access_token'];
            if ($this->api_model->plaid_save_api_key($beta, $status, $unix_timestamp, $date, $time, $month, $day, $year, $accessToken)) {
                Template::set_message('Access Token Created & Saved Successfully', 'success'); 
                Template::redirect('Wallets/Link-Accounts/Plaid'); 
            } else {
                Template::set_message('There was an error creating and saving your Access Token. This has been submitted to support@mymiteam.com for review.', 'error'); 
                Template::redirect('Wallets'); 
            }
            // Save the access token to a database or return it to the client
            // as appropriate for your application.
            // $this->load->view('plaid/access_token', ['access_token' => $accessToken]);
        } else {
            // Handle errors or exceptions from the Plaid API.
            $this->load->view('plaid/error');
        }
    }

    // Define other functions to handle different Plaid API endpoints as needed.
}