<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coinomi {

    private $api_base = 'https://api.coinomi.com/api/v1/';

    public function __construct() {
        $this->CI                           =& get_instance();
        $this->CI->load->library(array('curl', 'MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model(array('User/exchange_model', 'User/investor_model', 'User/tracker_model', 'User/wallet_model'));
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
        // Your Coinomi API Key & Base URL Link for API Request.
        $api_base                           = 'https://api.coinomi.com/api/v1/';
        $api_key                            = $this->CI->config->item('coinomi_api_key');
    }

    public function get_balance($address) {
        $endpoint = "balance/{$address}";
        return $this->make_request($endpoint);
    }

    // Add more methods for other endpoints...

    private function make_request($endpoint, $method = 'GET', $data = array()) {
        $url = $this->api_base . $endpoint;
    
        // Initialize the cURL session
        $ch = curl_init();
    
        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // If the method is POST, set the necessary options
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
    
        // Execute the cURL session and get the response
        $response = curl_exec($ch);
    
        // Close the cURL session
        curl_close($ch);
    
        // Decode the response
        $response = json_decode($response, true);
    
        // Return the response
        return $response;
    }
    

    public function get_transaction_history($address) {
        $endpoint = "transactions/{$address}";
        return $this->make_request($endpoint);
    }

    public function send_transaction($from_address, $to_address, $amount) {
        $endpoint = "send";
        $data = array(
            'from' => $from_address,
            'to' => $to_address,
            'amount' => $amount
        );
        return $this->make_request($endpoint, 'POST', $data);
    }

    public function get_exchange_rate($currency) {
        $endpoint = "exchange_rate/{$currency}";
        return $this->make_request($endpoint);
    }

    public function create_address() {
        $endpoint = "address/create";
        return $this->make_request($endpoint, 'POST');
    }
    
    public function get_address_info($address) {
        $endpoint = "address/{$address}";
        return $this->make_request($endpoint);
    }

    public function get_transaction_info($txid) {
        $endpoint = "transaction/{$txid}";
        return $this->make_request($endpoint);
    }
   
    public function get_block_info($blockhash) {
        $endpoint = "block/{$blockhash}";
        return $this->make_request($endpoint);
    }
    
}
