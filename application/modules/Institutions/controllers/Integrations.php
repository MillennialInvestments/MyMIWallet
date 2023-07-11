<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Integrations extends Admin_Controller {
    private $client_id;
    private $secret;
    private $environment;

    public function __construct() {
        parent::__construct();
        $this->load->config('site_settings'); 
        $this->load->model('User/plaid_model');
        $this->load->library('MyMIUser');         
        $this->client_id                                        = '61d9ba14ecdeba001b3619f6';
        // // Sandbox Settings
        $this->secret                                           = '432e5c1a0716e15fd26ca0d8c56640';
        $this->environment                                      = 'sandbox';
        $this->load->library('MyMIPlaid');
        $this->MyMIPlaid                                        = $this->mymiplaid->get_plaid_client();
        
        
        // Development Settings
        // $secret                 = 'aee78c834d39555f7d3b488acfcb2f';
        // $environment            = 'development';
    }

    public function index() {
        $this->load->view('content_creator');
    }
    

    public function savePublicToken()
    {
        // $plaid = $this->MyMIPlaid;
        $beta                                                   = $this->config->item('beta');
        $date                                                   = $this->config->item('date');
        $time                                                   = $this->config->item('time');
        $hostTime                                               = $this->config->item('hostTime');
        $application                                            = 'Plaid';

        $json_data                                              = json_decode($this->input->raw_input_stream, true);
        $cuID                                                   = $json_data['cuID'];
        $publicToken                                            = $json_data['public_token'];
        $request_id                                             = $json_data['request_id'];
        if (!empty($publicToken)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['message' => 'Public token saved', 'publicToken' => $publicToken]));
        } else {
            error_log('Failed to save public token');
            $this->output->set_status_header(400)->set_content_type('application/json')->set_output(json_encode(['error' => 'Failed to save public token']));
        }
    }
    
    public function exchange_public_token() {
        $status                                                 = 1;
        $beta                                                   = $this->config->item('beta');
        $date                                                   = $this->config->item('date');
        $time                                                   = $this->config->item('time');
        $hostTime                                               = $this->config->item('hostTime');
        $application                                            = 'Plaid';

        $this->load->config('plaid');
        $json_data                                              = json_decode($this->input->raw_input_stream, true);
        $public_token                                           = $json_data['public_token'];
        $cuID                                                   = $json_data['cuID']; 
        $api_base_url                                           = 'https://sandbox.plaid.com'; // Default to sandbox
        if ($this->environment === 'development') {
            $api_base_url                                       = 'https://development.plaid.com';
        } elseif ($this->environment === 'production') {
            $api_base_url                                       = 'https://production.plaid.com';
        }

        $curl                                                   = curl_init();
        $url                                                    = $api_base_url . '/item/public_token/exchange';
    
        $data                                                   = array(
            "client_id"                                         => $this->client_id,
            "secret"                                            => $this->secret,
            "public_token"                                      => $public_token
        );
        $payload                                                = json_encode($data);
    
        curl_setopt_array($curl, array(
            CURLOPT_URL                                         => $url,
            CURLOPT_RETURNTRANSFER                              => true,
            CURLOPT_TIMEOUT                                     => 30,
            CURLOPT_HTTP_VERSION                                => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST                               => "POST",
            CURLOPT_POSTFIELDS                                  => $payload,
            CURLOPT_HTTPHEADER                                  => array(
                "Content-Type: application/json"
            ),
        ));
    
        $response                                               = curl_exec($curl);
        $err                                                    = curl_error($curl);
        curl_close($curl);
    
        if ($err) {
            error_log('cURL Error in exchange_public_token: ' . $err);
            log_message('error', 'cURL Error in exchange_public_token: ' . $err);
            $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode(['error' => 'Failed to obtain access token']));
        } else {
            $response_data                                      = json_decode($response, true);
            // log_message('error', '$response_data: ' . print_r($response_data, true));
            if (isset($response_data['error'])) {
                log_message('error', 'Plaid API Error: ' . print_r($response_data['error'], true));
            }
            if (isset($response_data['access_token'])) {
                $access_token                                   = $response_data['access_token'];
                $item_id                                        = $response_data['item_id'];
                $request_id                                     = $response_data['request_id'];
                $saveTokenID                                    = $this->plaid_model->saveTokens($status, $beta, $date, $time, $hostTime, $cuID, $application, $request_id, $public_token, $item_id, $access_token);
                log_message('error', 'saveTokensID: ' . print_r($saveTokenID, true));
                if (!empty($saveTokenID)) {
                    $walletInformation                          = $this->create_wallet($cuID, $saveTokenID, $access_token, $item_id, $api_base_url);           
                    log_message('error', 'walletInformation: ' . print_r($walletInformation, true)); 
                    $this->output->set_content_type('application/json')->set_output(json_encode(['message' => 'Access token obtained', 'public_token' => $public_token, 'access_token' => $access_token, 'item_id' => $item_id, 'request_id' => $request_id]));
                    // Template::redirect('/Wallets');
                }
            } else {
                error_log('Failed to obtain access token');
                log_message('error', 'Failed to obtain access token');
                $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode(['error' => 'Failed to obtain access token']));
            }
        }
    }

    public function create_wallet($cuID, $saveTokenID, $access_token, $item_id, $api_base_url) {
        $brokerId = "";
        $api_base_url = "";
        $broker = "";
        $broker_products = array();
        $routing_numbers = array();
        $broker_logo = "";
        $broker_primary_color = "";
        $account_id = "";
        $wallet_type = "";
        $amount = 0;
        $available_products = array();
        $billed_products = array();
        $consent_expiration_time = "";
        $error = "";
        $products = array();
        $update_type = "";
        $webhook = "";
        $getTransactions = array();
        // // Comment Out Below
        // log_message('custom', 'saveTokenID: ' . $saveTokenID); 
        // log_message('custom', 'item_id: ' . $item_id); 
        $walletStatusCheck                                      = $this->plaid_model->check_item_status($cuID, $saveTokenID, $item_id);
        // // Comment Out Below
        // log_message('custom', 'walletStatusCheck: ' . print_r($walletStatusCheck, true));
        // log_message('custom', '$wallStatusCheck Completed'); 
        if ($walletStatusCheck['walletStatus'] === 'New') {
            // // Comment Out Below
            // log_message('custom', '$wallStatusCheck[walletStatus]: New'); 
            // log_message('custom', 'Attempting to create New Wallet'); 
            $accessTokenData                                    = $this->plaid_model->getAccessToken($cuID, $item_id); 
            // // Comment Out Below
            // log_message('custom', 'accessTokenData: ' . print_r($accessTokenData)); 
            $allData                                            = array(); 
            $walletData                                         = array(); 
            $brokerData                                         = array(); 
            $transactionData                                    = array(); 
            // $json_data                                           = json_decode($this->input->raw_input_stream, true);
            $status                                             = 1;
            $active                                             = 'Yes';
            $beta                                               = $this->config->item('beta');
            $default_wallet                                     = 'No';
            $exchange_wallet                                    = 'No';
            $premium_wallet                                     = 'Yes';
            $ach_enabled                                        = 'No';
            $market_pair                                        = 'USD';
            $market                                             = 'MYMI';
            $user_id                                            = $cuID;
            $userAccount                                        = $this->mymiuser->user_account_info($user_id); 
            $user_email                                         = $userAccount['cuEmail']; 
            $username                                           = $userAccount['cuUsername']; 
            $public_token                                       = $accessTokenData['public_token'];
            $request_id                                         = $accessTokenData['request_id'];
            // $account_id                                         = $accessTokenData['account_id'];
            $item_id                                            = $accessTokenData['item_id'];
            $access_token                                       = $accessTokenData['access_token'];
            // // Comment Out Below
            // log_message('custom', 'accessTokenData[access_token]: ' . $access_token); 
            $purchase_type                                      = 'Premium'; 
            // $getItems                                           = $this->MyMIPlaid->items->get($access_token); 
            $ch                                                 = curl_init();
            $url                                                = $api_base_url . '/item/get';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            $data = array(
                'client_id'                                     => $this->client_id,
                'secret'                                        => $this->secret,
                'access_token'                                  => $access_token,
            );
            $data_string                                        = json_encode($data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            $result = curl_exec($ch);
            curl_close($ch);
            $response                                           = json_decode($result, true);
            
            $getItems                                           = $response;
            if (empty($getItems['item']['error'])) {
                $broker_id                                      = $getItems['item']['institution_id'];
                $response                                       = $this->getInstitutionDetails($brokerId);;
                $getInstitutionByID                             = $response;
                if ($getInstitutionByID['item']['institution_id'] === $broker_id) {    
                    // // Comment Out Below
                    // log_message('error','$getInstitutionByID: '.print_r($getInstitutionByID,true));
                    $institutionInfo                            = $getInstitutionByID['institution'];
                    // // Comment Out Below
                    // log_message('error','$getInstitutionByID[institution]: '.print_r($$getInstitutionByID['institution'],true));
                    $broker                                     = $institutionInfo['name'];
                    $broker_products                            = $institutionInfo['products'];
                    $routing_numbers                            = $institutionInfo['routing_numbers'];
                    $broker_logo                                = $institutionInfo['logo'];
                    $broker_primary_color                       = $institutionInfo['primary_color'];
                
                    // Add Items sub-arrays and data values to walletData
                    $available_products                         = $getInstitutionByID['item']['available_products'];
                    $billed_products                            = $getInstitutionByID['item']['billed_products'];
                    $consent_expiration_time                    = $getInstitutionByID['item']['consent_expiration_time'];
                    $error                                      = $getInstitutionByID['item']['error'];
                    $products                                   = $getInstitutionByID['item']['products'];
                    $update_type                                = $getInstitutionByID['item']['update_type'];
                    $webhook                                    = $getInstitutionByID['item']['webhook'];
                } 
            }
            $walletData                                         = array(
                'status'                                        => $status,
                'active'                                        => $active,
                'beta'                                          => $beta,
                'default_wallet'                                => $default_wallet,
                'exchange_wallet'                               => $exchange_wallet,
                'premium_wallet'                                => $premium_wallet,
                'ach_enabled'                                   => $ach_enabled,
                'market_pair'                                   => $market_pair,
                'market'                                        => $market,
                'user_id'                                       => $user_id,
                'user_email'                                    => $user_email,
                'username'                                      => $username,
                'user_id'                                       => $user_id,
                'broker_id'                                     => $broker_id,
                'broker'                                        => $broker,
                'broker_products'                               => $broker_products,
                'routing_numbers'                               => $routing_numbers,
                'broker_logo'                                   => $broker_logo,
                'broker_primary_color'                          => $broker_primary_color,
                'public_token'                                  => $public_token,
                'request_id'                                    => $request_id,
                'account_id'                                    => $account_id,
                'item_id'                                       => $item_id,
                'access_token'                                  => $access_token,
                'purchase_type'                                 => $purchase_type,
                'wallet_type'                                   => $wallet_type,
                'amount'                                        => $amount,
                'available_products'                            => $available_products,
                'billed_products'                               => $billed_products,
                'consent_expiration_time'                       => $consent_expiration_time,
                'error'                                         => $error,
                'products'                                      => $products,
                'update_type'                                   => $update_type,
                'webhook'                                       => $webhook,
            );
            
            // Add this line to save the wallet data to the database
            $walletID                                           = $this->plaid_model->saveWalletData($walletData);
            
            if (!empty($walletID)) {
                // Call the get_transactions function
                // $getTransactions                                = $this->get_transactions($access_token); 
                if ($getTransactions) {
                    $walletInformation                          = array(
                        'message'                               => 'Wallet & Transactions Submitted Successfully', 
                        'walletData'                            => $walletData,
                        'walletID'                              => $walletID,
                        'getTransactions'                       => $getTransactions,
                    ); 
                } else {
                    $walletInformation                          = array(
                        'message'                               => 'Error Submitting Transactions, but Wallet Saved Successfully',
                        'walletData'                            => $walletData,
                        'walletID'                              => $walletID,
                        'getTransactions'                       => array(
                            'message'                           => 'Failed to Get Transactions for this Account',
                        ),
                    );
                }
            } else {
                $walletInformation                              = array(
                    'message'                                   => 'Error Saving Wallet',
                    'walletData'                                => $walletData,
                    'walletID'                                  => $walletID,
                    'getTransactions'                           => array(
                        'message'                               => 'Did not get a chance to even start this!',
                    ),
                );
            }
            return $walletInformation; 
        }
    }

    function getInstitutionDetails($brokerId) {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_base_url . '/institutions/get_by_id',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                "client_id" => $this->client_id,
                "secret" => $this->secret,
                "institution_id" => $brokerId,
            )),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    
        if ($err) {
            // Handle error as needed
            return null;
        } else {
            if ($statusCode >= 400) {
                log_message('error', 'Plaid API Error: Status code: ' . $statusCode . ', Response: ' . $response);
                return null;
            } else {
                return json_decode($response, true);
            }
        }
    }

    public function get_transactions($access_token) {
        $getTransactions                                        = $this->MyMIPlaid->transactions->set($access_token, $start_date, $end_date);
        $this->plaid_model->saveTransactions($getTransactions);
        return $getTransactions; 
    }

    public function get_link_token()
    {
        $this->load->config('plaid');
        $client_id                                              = $this->config->item('plaid_client_id');
        $secret                                                 = $this->config->item('plaid_secret');

        $response                                               = $this->MyMIPlaid->get_link_token($client_id, $secret);
        echo json_encode($response);
    }

    private function storeInDatabase($validatedData)
    {
        // Code to store the validated data in a database
    }

    private function sendConfirmationEmail($validatedData)
    {
        // Code to send a confirmation email to the user
    }

    private function logProcessedData($validatedData)
    {
        // Code to log the processed data for auditing purposes
    }

    private function validateAge($validatedData)
    {
        // Code to check if the user's age meets the criteria
    }

    private function checkAllowedCountry($validatedData)
    {
        // Code to check if the user's country is in the allowed list
    }

    private function generateUserId($validatedData)
    {
        // Code to generate a unique ID for the user
    }
}