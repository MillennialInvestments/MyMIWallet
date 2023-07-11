<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plaid_model extends BF_Model {
    public function __construct() {
        parent::__construct();
        // $this->load->library('MyMIPlaid');
        // $this->MyMIPlaid = $this->mymiplaid->get_plaid_client();
    }

    public function savePublicToken($beta, $date, $time, $hostTime, $application, $cuID, $publicToken, $request_id)
    {
        // Save the public_token to your database table (e.g., 'public_tokens')
        $data = [
            'beta'                                      => $beta,
            'date'                                      => $date,
            'time'                                      => $time,
            'hostTime'                                  => $hostTime,
            'application'                               => $application,
            'created_by'                                => $cuID,
            'request_id'                                => $request_id,
            'public_token'                              => $publicToken,
        ];
    
        return $this->db->insert('bf_users_public_tokens', $data);
    }

    public function exchange_public_token($public_token) {
        $client = $this->MyMIPlaid->get_plaid_client();
        $response = $client->exchangePublicToken($public_token);
        return json_decode($response, true);
    }

    public function saveTokens($status, $beta, $date, $time, $hostTime, $created_by, $application, $request_id, $public_token, $item_id, $access_token)
    {
        $data = array(  
            'status'                => $status, 
            'beta'                  => $beta,
            'date'                  => $date,
            'time'                  => $time,
            'hostTime'              => $hostTime,
            'created_by'            => $created_by,
            'application'           => $application,
            'request_id'            => $request_id,
            'public_token'          => $public_token,
            'item_id'               => $item_id, 
            'access_token'          => $access_token
        );
        $this->db->insert('bf_users_public_tokens', $data);
        return $this->db->insert_id(); 
    }

    public function check_item_status($cuID, $saveTokenID, $item_id) {
        $this->db->from('bf_users_wallet'); 
        $this->db->where('item_id', $item_id); 
        $getItem                    = $this->db->get()->result_array(); 
        if (!empty($getItemStatus['id'])) {
            $walletStatus           = 'Existing'; 
            $walletData             = $getItem;
            $accessData             = array(); 
        } else {
            $walletStatus           = 'New'; 
            $walletData             = array(); 
            $accessData             = $this->getAccessToken($cuID, $item_id); 
        }
        $walletStatusCheck          = array(
            'walletStatus'          => $walletStatus,
            'walletData'            => $walletData,
            'accessData'            => $accessData,
        ); 
        return $walletStatusCheck;
    }
    
    public function getAccessToken($cuID, $item_id) {
        $this->db->from('bf_users_public_tokens'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('item_id', $item_id); 
        $accessTokenData            = $this->db->get()->row_array(); 
        return $accessTokenData;
    }
    
    public function saveWalletData($walletData) {
        $this->db->insert('bf_users_wallet', $walletData);
        return $this->db->insert_id();
    }

    public function getInstitutionByID($institution_id)
    {
        try {
            $response = $this->MyMIPlaid->institutions->get($institution_id);
            return $response;
        } catch (Exception $e) {
            log_message('custom', 'Error in getInstitutionByID: ' . $e->getMessage());
            $repsponse = array(
                'error' => 'Error in getInstitutionByID: ' . $e->getMessage(),
            );
            return null;
        }
        $getInstitutionByID = $response;
        return $getInstitutionByID;
    }

    public function saveTransactions($transactions) {
        foreach ($transactions as $transaction) {
            // Prepare the data according to your table structure
            $data = array(
                'transaction_id' => $transaction['transaction_id'],
                'account_id' => $transaction['account_id'],
                // Add other fields as needed
            );
            $this->db->insert('bf_users_wallet_transactions', $data);
        }
    }
    
    public function get_link_token($client_id, $secret)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.plaid.com/link/token/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                'client_id' => $client_id,
                'secret' => $secret,
                'user' => array(
                    'client_user_id' => 'unique_user_id',
                ),
                'client_name' => 'Plaid App',
                'products' => array('auth', 'transactions'),
                'country_codes' => array('US'),
                'language' => 'en',
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}

// class Plaid_model extends CI_Model
// {
//     public function __construct()
//     {
//         parent::__construct();
//     }

//     public function addBankAndInvestmentAccount($accessToken, $itemId)
//     {
//         // Add your logic to store the access token and item ID
//     }
    
//     public function savePublicToken($beta, $date, $time, $hostTime, $application, $cuID, $linkToken, $request_id)
//     {
//         // Save the public_token to your database table (e.g., 'public_tokens')
//         $data = [
//             'beta'                                      => $beta,
//             'date'                                      => $date,
//             'time'                                      => $time,
//             'hostTime'                                  => $hostTime,
//             'application'                               => $application,
//             'created_by'                                => $cuID,
//             'request_id'                                => $request_id,
//             'public_token'                              => $linkToken,
//         ];
    
//         return $this->db->insert('bf_users_public_tokens', $data);
//     }

//     public function saveAccessToken($publicToken, $accessToken) {
//         //Update the Public Token Record with the New Access Token
//         $data = [
//             'accessToken'                               => $accessToken,
//         ];

//         $this->db->where('public_token', $publicToken); 
//         return $this->db->update('bf_users_public_tokens', $data); 
//     }

//     public function updateAccessToken($link_token, $accessToken)
//     {
//         $data = [
//             'accessToken' => $accessToken,
//         ];

//         $this->db->where('public_token', $link_token);
//         return $this->db->update('bf_users_public_tokens', $data);
//     }
        
//     public function get_all_transactions()
//     {
//         // Fetch all transactions from the database
//         $query = $this->db->get('transactions');
//         return $query->result();
//     }

//     public function save_transaction($transactionData)
//     {
//         // Insert the transaction data into the database
//         $this->db->insert('transactions', $transactionData);
//         return $this->db->insert_id();
//     }

//     public function get_all_wallets()
//     {
//         // Fetch all wallets from the database
//         $query = $this->db->get('wallets');
//         return $query->result();
//     }

//     public function get_wallet_details($walletId)
//     {
//         // Fetch the wallet details by ID from the database
//         $query = $this->db->get_where('wallets', ['id' => $walletId]);
//         return $query->row();
//     }

//     public function getAccessTokenByRequestId($cuID, $requestID)
//     {
//         $this->db->select('public_token');
//         $this->db->from('bf_users_public_tokens');
//         $this->db->where('created_by', $cuID);
//         $this->db->where('request_id', $requestID);
//         $getAccessToken = $this->db->get(); // Change from result_array() to row_array()
//         return $getAccessToken; 
//     }

//     public function save_transactions($transactions) {
//         $data = [];
    
//         // Iterate through the transactions and prepare the data for insertion
//         foreach ($transactions as $transaction) {
//             $data[]                                     = [
//                 'account_id'                            => $transaction->getAccountId(),
//                 'transaction_id'                        => $transaction->getTransactionId(),
//                 'amount'                                => $transaction->getAmount(),
//                 'category'                              => implode(', ', $transaction->getCategory()),
//                 'date'                                  => $transaction->getDate(),
//                 'name'                                  => $transaction->getName(),
//                 'payment_channel'                       => $transaction->getPaymentChannel(),
//                 'payment_meta'                          => json_encode($transaction->getPaymentMeta()),
//                 'pending'                               => $transaction->getPending(),
//                 'pending_transaction_id'                => $transaction->getPendingTransactionId(),
//                 'transaction_type'                      => $transaction->getTransactionType(),
//             ];
//         }
    
//         // Insert the transactions into your database table (e.g., 'transactions')
//         $this->db->insert_batch('bf_users_transactions', $data);
        
//         // Create blank $saveTransactions array to prepare for sending data back to the controller
//         $saveTransactions                           = array(); 
//         // Check if the insert was successful
//         if ($this->db->affected_rows() > 0) {
//                 $message                                = 'Transactions Save Successfully!<br>Affected Rows: ' . $this->db->affected_rows();
//         } else {
//             $message                                    = 'Transactions could not be saved successfully!'; 
//         }
//         $saveTransactions                               = array(
//             'message'                                   => $message,
//         );
//         return $saveTransactions;
//     }
    
//     public function updateTransactionsOnLogin($accessToken, $itemId)
//     {
//         $plaidClient                                    = $this->plaid->getClient();
//         $startDate                                      = date('Y-m-d', strtotime('-30 days'));
//         $endDate                                        = date('Y-m-d');

//         $response                                       = $plaidClient->getTransactions($accessToken, $startDate, $endDate);

//         foreach ($response['transactions'] as $transaction) {
//             // Add your logic to update transactions in the bf_users_trades table
//         }
//     }

//     // Note that TomorrowIdeas/plaid-sdk-php does not have built-in support for ACH transfers
//     // You may need to extend the package or use a different Plaid PHP SDK
// }