<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Make sure to load the MyMIPlaid library in your controller
require_once APPPATH . 'libraries/MyMIPlaid.php';

class Transactions extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the required models
        $this->load->model('User/plaid_model');
        // Load Plaid_lib
        $this->load->library('MyMIPlaid');
        
        // Initialize MyMIPlaid
        $this->MyMIPlaid = new MyMIPlaid();
    }

    public function index()
    {
        // Get the Request data
        $accessToken = $this->input->post('access_token');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        log_message('debug', 'Access Token: ' . $accessToken);

        // Get transactions
        $transactions = $this->getTransactions($accessToken, $start_date, $end_date);
    
        // Check if the transactions array is empty
        if (empty($transactions)) {
            // If empty, return an empty array as JSON
            echo json_encode(array());
        } else {
            // If not empty, return the transactions array as JSON
            echo json_encode($transactions);
        }
    }

    public function getTransactions() {
        // Load required models here, if any
        $this->load->model('User/plaid_model');
        // Load the MyMIPlaid library
        $this->load->library('MyMIPlaid');
        // Get the Plaid Client
        $plaid = $this->MyMIPlaid->client;
        $accessToken = $this->input->post('access_token');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
    
        try {
            // Fetch transactions from Plaid
            $response = $plaid->transactions->list($accessToken, [
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
    
            // Get the transactions
            $transactions = $response['transactions'];
    
            // Return the transactions as an array
            return $transactions;
        } catch (Exception $e) {
            // Handle exceptions
            $errorMessage = $e->getMessage();
    
            // Log the error message
            log_message('error', 'Error fetching transactions: ' . $errorMessage);
    
            // Return an empty array
            return array();
        }
    }

    public function fetch_transactions() {
        $accessToken = $this->input->post('access_token');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
    
        $transactions = $this->get_transactions($accessToken, $start_date, $end_date);
    
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['transactions' => $transactions]));
    }

    public function saveTransaction()
    {
    
        // Get the input data
        $transactionData = json_decode($this->input->raw_input_stream, true);
    
        // Save the transaction using the model
        $result = $this->plaid_model->save_transaction($transactionData);
    
        // Send the response as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['result' => $result]));
    }
}