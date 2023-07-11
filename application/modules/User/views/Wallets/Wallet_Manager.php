<?php
<<<<<<< HEAD
$this->load->library('encryption'); 
$key                                                = bin2hex($this->encryption->create_key(16));
$this->encryption->initialize(
    array(
            'cipher'                                => 'aes-256',
            'mode'                                  => 'ctr',
            'key'                                   => hex2bin($key)
    )
);
$orderForm							    	        = trim(file_get_contents("php://input"));
$orderForm						    		        = json_decode($orderForm, true);

// GET Request Defined Variables
$formMode                                           = $orderForm['form_mode'];
$accountType                                        = $orderForm['wallet_type'];
$active									            = 'Yes';
$beta									            = $orderForm['beta'];
$status						                        = 'Incomplete';
$unix_timestamp				                        = time();
$date                                               = date("m/d/Y");
$time                                               = date('H:i:s a');
$month						                        = date("n");
$day						                        = date("j");
$year						                        = date("Y");
$time 						                        = date("G:i:s");
$default_wallet							            = 'No';
$exchange_wallet						            = 'No';
$form_mode								            = $orderForm['form_mode'];
$redirectURL							            = $orderForm['redirectURL'];
$user_id								            = $orderForm['user_id'];
$user_email								            = $orderForm['user_email'];
$username								            = $orderForm['username'];
$walletID                                           = $orderForm['wallet_id'];
$wallet_type                                        = $orderForm['wallet_type'];
$purchase_type                                      = $orderForm['purchase_type'];

if ($formMode === 'Add') {
    if ($wallet_type === 'Banking') {
        // Wallet Variable
        $broker                                     = $orderForm['bank_name'];
        $nickname                                   = $orderForm['nickname'];
        $amount                                     = $orderForm['balance'];
        // Bank Account Information
        $bank_name                                  = $orderForm['bank_name'];
        $account_type                               = $orderForm['account_type'];
        $bank_account_owner                         = $orderForm['bank_account_owner'];
        // !!! BANK ACCOUNT / ROUTING NUMBER INPUTS
        // $routing_number                             = $this->encryption->encrypt($orderForm['routing_number']);
        // $routing_number                             = $orderForm['routing_number'];
        // $account_number                             = $this->encryption->encrypt($orderForm['account_number']);
        // $account_number                             = $orderForm['account_number'];
        $nickname                                   = $orderForm['nickname'];
        $balance                                    = $orderForm['balance'];

        $accountData                                = array(
            'status'                                => 1,
            'beta'                                  => $beta,
            'date'                                  => $date,
            'time'                                  => $time,
            'user_id'                               => $user_id,
            'user_email'                            => $user_email,
            'username'                              => $username,
            'wallet_id'                             => $walletID,
            'bank_name'                             => $bank_name,
            'account_type'                          => $account_type,
            'bank_account_owner'                    => $bank_account_owner,
            'routing_number'                        => $routing_number,
            'account_number'                        => $account_number,
            'nickname'                              => $nickname,
            'balance'                               => $balance,
        );

        $this->db->insert('bf_users_bank_accounts', $accountData); 
        echo '<script>console.log("Bank Account Submitted. Database Submission Complete"</script>';
        $initial_value                              = $amount;
        $walletData								    = array(
            'active'							    => $active,
            'beta'								    => $beta,
            'default_wallet'					    => $default_wallet,
            'exchange_wallet'					    => $exchange_wallet,
            'user_id'							    => $user_id,
            'username'							    => $username,
            'user_email'						    => $user_email,
            'broker'							    => $broker,
            'nickname'							    => $nickname,
            'purchase_type'                         => $purchase_type,
            'wallet_type'						    => $wallet_type,
            'amount'							    => $amount,
            'initial_value'						    => $initial_value,
        );
        echo '<script>console.log("Wallet Submitted. Database Submission Complete"</script>';
        return $this->db->insert('bf_users_wallet', $walletData);
    } elseif ($wallet_type === 'Credit') {
        // Wallet Variable
        $credit_status                              = $orderForm['credit_status']; 
        if ($credit_status === 'Active') {
            $status                                 = 1;
        } elseif ($credit_status === 'Closed') {
            $status                                 = 2; 
        } else {
            $status                                 = 0; 
        }
        $broker                                     = $orderForm['bank_name'];
        $nickname                                   = $orderForm['nickname'];
        // $amount                                 = $orderForm['balance'];
        // Credit Card Account Information
        $account_type                               = $orderForm['wallet_type'];
        $bank_name                                  = $orderForm['bank_name'];
        $nikcname                                   = $orderForm['nickname'];
        $account_number                             = $orderForm['account_number'];
        // $account_number                             = $this->encryption->encrypt($orderForm['account_number']);
        $credit_limit                               = $orderForm['credit_limit'];
        $current_balance                            = $orderForm['current_balance'];
        $available_balance                          = $orderForm['available_balance'];

        $accountData                                = array(
            'status'                                => $status,
            'beta'                                  => $beta,
            'date'                                  => $date,
            'time'                                  => $time,
            'user_id'                               => $user_id,
            'user_email'                            => $user_email,
            'username'                              => $username,
            'wallet_id'                             => $walletID,
            'account_type'                          => $account_type,
            'bank_name'                             => $bank_name,
            'nickname'                              => $nickname,
            'account_number'                        => $account_number,
            'credit_limit'                          => $credit_limit,
            'current_balance'                       => $current_balance,
            'available_balance'                     => $available_balance,
        );

        $this->db->insert('bf_users_credit_accounts', $accountData); 
        echo '<script>console.log("Credit Account Submitted. Database Submission Complete"</script>';
        $initial_value                              = $credit_limit - $current_balance;
        $walletData								    = array(
            'active'							    => $active,
            'beta'								    => $beta,
            'default_wallet'					    => $default_wallet,
            'exchange_wallet'					    => $exchange_wallet,
            'user_id'							    => $user_id,
            'username'							    => $username,
            'user_email'						    => $user_email,
            'broker'							    => $broker,
            'nickname'							    => $nickname,
            'purchase_type'                         => $purchase_type,
            'wallet_type'						    => $wallet_type,
            'amount'							    => $available_balance,
            'initial_value'						    => $initial_value,
        );
        return $this->db->insert('bf_users_wallet', $walletData);
        echo '<script>console.log("Wallet Submitted. Database Submission Complete"</script>';
    } elseif ($wallet_type === 'Investment') {

    }
} elseif ($formMode === 'Edit') {
    if ($wallet_type === 'Banking') {
        // Wallet Variable
        $account_id                                 = $orderForm['account_id'];
        $broker                                     = $orderForm['bank_name'];
        $nickname                                   = $orderForm['nickname'];
        $amount                                     = $orderForm['balance'];
        // Bank Account Information
        $bank_name                                  = $orderForm['bank_name'];
        $account_type                               = $orderForm['account_type'];
        // $bank_account_owner                         = $orderForm['bank_account_owner'];
        // $routing_number                             = $orderForm['routing_number'];
        $account_number                             = $orderForm['account_number'];        
        // $routing_number                             = $this->encryption->encrypt($orderForm['routing_number']);
        // $account_number                             = $this->encryption->encrypt($orderForm['account_number']);
        $nickname                                   = $orderForm['nickname'];
        $balance                                    = $orderForm['balance'];

        $accountData                                = array(
            'status'                                => 1,
            'beta'                                  => $beta,
            'date'                                  => $date,
            'time'                                  => $time,
            'user_id'                               => $user_id,
            'user_email'                            => $user_email,
            'username'                              => $username,
            'wallet_id'                             => $walletID,
            'bank_name'                             => $bank_name,
            'account_type'                          => $account_type,
            'bank_account_owner'                    => $bank_account_owner,
            // 'routing_number'                        => $routing_number,
            // 'account_number'                        => $account_number,
            'nickname'                              => $nickname,
            'balance'                               => $amount,
        );
        $this->db->where('id', $account_id);
        $this->db->update('bf_users_bank_accounts', $accountData); 
        echo '<script>console.log("Bank Account Submitted. Database Submission Complete"</script>';
        $walletData							        = array(
            'active'						        => $active,
            'beta'							        => $beta,
            'default_wallet'			            => $default_wallet,
            'exchange_wallet'				        => $exchange_wallet,
            'user_id'							    => $user_id,
            'username'							    => $username,
            'user_email'						    => $user_email,
            'broker'							    => $bank_name,
            'nickname'							    => $nickname,
            'purchase_type'                         => $purchase_type,
            'wallet_type'						    => $wallet_type,
            'amount'							    => $balance,
        );
        $this->db->where('id', $account_id);
        return $this->db->update('bf_users_wallet', $walletData);
        echo '<script>console.log("Wallet Updated. Database Submission Complete"</script>';
    } elseif ($wallet_type === 'Credit') {
        // Wallet Variable
        $credit_status                              = $orderForm['credit_status']; 
        if ($credit_status === 'Active') {
            $status                                 = 1;
        } elseif ($credit_status === 'Closed') {
            $status                                 = 2; 
        } else {
            $status                                 = 0; 
        }
        $account_id                                 = $orderForm['account_id'];
        $bank_name                                  = $orderForm['bank_name'];
        $nickname                                   = $orderForm['nickname'];
        // $amount                                 = $orderForm['balance'];
        // Credit Card Account Information
        $account_type                               = $orderForm['wallet_type'];
        $account_number                             = $orderForm['account_number'];
        // $account_number                             = $this->encryption->encrypt($orderForm['account_number']);
        $credit_limit                               = $orderForm['credit_limit'];
        $current_balance                            = $orderForm['current_balance'];
        $available_balance                          = $orderForm['available_balance'];

        $accountData                                = array(
            'status'                                => $status,
            'beta'                                  => $beta,
            'date'                                  => $date,
            'time'                                  => $time,
            'user_id'                               => $user_id,
            'user_email'                            => $user_email,
            'username'                              => $username,
            'wallet_id'                             => $walletID,
            'account_type'                          => $account_type,
            'bank_name'                             => $bank_name,
            'nickname'                              => $nickname,
            'account_number'                        => $account_number,
            'credit_limit'                          => $credit_limit,
            'current_balance'                       => $current_balance,
            'available_balance'                     => $available_balance,
        );
        $this->db->where('id', $account_id);
        $this->db->update('bf_users_credit_accounts', $accountData); 
        if ($status === 2) {
            $debtData                               = array(
                'status'                            => 1,
                'beta'                              => $beta,
                'date'                              => $date,
                'time'                              => $time,
                'user_id'                           => $user_id,
                'user_email'                        => $user_email,
                'username'                          => $username,
                'wallet_id'                         => $walletID,
                'account_type'                      => $account_type,
                'debtor'                            => $bank_name,
                'nickname'                          => $nickname,
                'account_number'                    => $account_number,
                'credit_limit'                      => $credit_limit,
                'current_balance'                   => $current_balance,
                'available_balance'                 => $available_balance,
            );
            $this->db->insert('bf_users_debt_accounts', $debtData); 
        }
        echo '<script>console.log("Credit Account Updated. Database Submission Complete"</script>';
        $initial_value                              = $credit_limit - $current_balance;
        $walletData								    = array(
            'active'							    => $active,
            'beta'								    => $beta,
            'default_wallet'					    => $default_wallet,
            'exchange_wallet'					    => $exchange_wallet,
            'user_id'							    => $user_id,
            'username'							    => $username,
            'user_email'						    => $user_email,
            'broker'							    => $bank_name,
            'nickname'							    => $nickname,
            'purchase_type'                         => $purchase_type,
            'wallet_type'						    => $wallet_type,
            'amount'							    => $available_balance,
        );
        echo '<script>console.log("Wallet Updated. Database Submission Complete"</script>';
        $this->db->where('id', $account_id);
        return $this->db->update('bf_users_wallet', $walletData);
    } elseif ($wallet_type === 'Debt') {
    } elseif ($wallet_type === 'Investment') {
    }
} elseif ($formMode === 'Purchase') {
} elseif ($formMode === 'Delete') {
    $active									        = 'No';
    $walletID                                       = $orderForm['wallet_id'];
    $accountInformation                             = array(
        'active'                                    => $active,
    );
    $this->db->where('id', $walletID); 
    return $this->db->update('bf_users_wallet', $accountInformation);
}
=======
$orderForm								    = trim(file_get_contents("php://input"));
$orderForm								    = json_decode($orderForm, true);

// GET Request Defined Variables
$active									    = 'No';
$beta									    = $orderForm['beta'];
$status						                = 'Incomplete';
$unix_timestamp				                = time();
$month						                = date("n");
$day						                = date("j");
$year						                = date("Y");
$time 						                = date("G:i:s");
$default_wallet							    = 'No';
$exchange_wallet						    = 'No';
$user_id								    = $orderForm['user_id'];
$username								    = $orderForm['username'];
$user_email								    = $orderForm['user_email'];
$walletID                                   = $orderForm['wallet_id'];
$coin                                       = 'MYMIG';			                // Define Coin Purchased
$initial_value				                = $orderForm['initial_value'];		// Define Initial Value of Coin Market Cap
$available_coins			                = $orderForm['available_coins'];	// Define Availability of Coins (if defined or required)
$initial_coin_value			                = $orderForm['initial_coin_value'];	// Define Initial Coin Value
$new_coin_value				                = $orderForm['initial_coin_value']; // Same Initial Coin Value
$coin_amount						        = $orderForm['total'];				// Define coin_amount of Funds Used to Purchase Coins
$current_value				                = $initial_value + $coin_amount;			// Define New Value of MyMI Gold by adding Initial Value + coin_amount Spent
$total						                = $orderForm['total'];				// Define Total coin_amount of Coins Being Purchased
$new_availability			                = $available_coins + $total;		// Define New Availabile Coins (Available Coins + Total)
$total_cost					                = $orderForm['total_cost'];			// Define Total Cost of Transaction
$total_fees					                = $orderForm['total_fees'];			// Define Total Fees
$gas_fee					                = $orderForm['gas_fee'];			// Define Total Gas Fees (Coins to Cover Transfer of Coins)
$trans_fee					                = $orderForm['trans_fee'];			// Define Single Transcation Fee
$trans_percent				                = $orderForm['trans_percent'];		// Define Percentage Fee of Single Transaction
$user_gas_fee				                = $orderForm['user_gas_fee'];		// Define User Gas Fee Total
$user_trans_fee			                    = $orderForm['user_trans_fee'];		// Define User Single Transaction Fee Total
$user_trans_percent			                = $orderForm['user_trans_percent'];	// Define User Single Transaction Percentage Fee Total
$purchase_type                              = $orderForm['purchase_type'];
$wallet_type                                = $orderForm['wallet_type'];
$broker                                     = $orderForm['broker'];
$nickname                                   = $orderForm['nickname'];
$funded                                     = $orderForm['funded'];
if ($funded === 'Yes') {
    $amount                                 = $orderForm['amount'];
} else {
    $amount                                 = 0;
}

if ($purchase_type === 'Free') {
    $walletData								= array(
        'active'							=> $active,
        'beta'								=> $beta,
        'default_wallet'					=> $default_wallet,
        'exchange_wallet'					=> $exchange_wallet,
        'user_id'							=> $user_id,
        'username'							=> $username,
        'user_email'						=> $user_email,
        'broker'							=> $broker,
        'nickname'							=> $nickname,
        'purchase_type'                     => $purchase_type,
        'wallet_type'						=> $wallet_type,
        'amount'							=> $amount,
        'initial_value'						=> $initial_value,
    );
    return $this->db->insert('bf_users_wallet', $walletData);
} elseif ($purchase_type === 'Premium') {
    $walletData								= array(
        'active'							=> $active,
        'beta'								=> $beta,
        'default_wallet'					=> $default_wallet,
        'exchange_wallet'					=> $exchange_wallet,
        'user_id'							=> $user_id,
        'username'							=> $username,
        'user_email'						=> $user_email,
        'broker'							=> $broker,
        'nickname'							=> $nickname,
        'purchase_type'                     => $purchase_type,
        'wallet_type'						=> $wallet_type,
        'amount'							=> $amount,
        'initial_value'						=> $initial_value,
    );
    $this->db->insert('bf_users_wallet', $walletData);
    $user 						= array(
        'unix_timestamp'		=> $unix_timestamp,
        'month'					=> $month,
        'day'					=> $day,
        'year'					=> $year,
        'time'					=> $time,
        'beta'					=> $beta,
        'wallet_id'				=> $wallet_id,
        'user_id'				=> $user_id,
        'user_email'			=> $user_email,
        'coin'					=> $coin,
        'initial_value'			=> $initial_value,
        'current_value'			=> $current_value,
        'available_coins'		=> $available_coins,
        'new_availability'		=> $new_availability,
        'initial_coin_value'	=> $initial_coin_value,
        'new_coin_value'		=> $new_coin_value,
        'coin_amount'			=> $coin_amount,
        'total'					=> $total,
        'total_cost'			=> $total_cost,
        'total_fees'			=> $total_fees,
        'gas_fee'				=> $gas_fee,
        'trans_fee'				=> $trans_fee,
        'trans_percent'			=> $trans_percent,
        'user_gas_fee'			=> $user_gas_fee,
        'user_trans_fee'		=> $user_trans_fee,
        'user_trans_percent'	=> $user_trans_percent,
    );
    $this->db->insert('bf_users_coin_purchases', $user);
    $insert_id 					= $this->db->insert_id();
    
    // Append Additional Data into $user Array to add to bf_mymigold_overview->adjust_value
    
    // Update User Coin Purchase
    $overviewData				= array(
        'trans_id'				=> $insert_id,
        'status'				=> 'Incomplete',
        'beta'					=> $beta,
        'wallet_id'				=> $wallet_id,
        'user_id'				=> $user_id,
        'user_email'			=> $user_email,
        'initial_value'			=> $initial_value,
        'current_value'			=> $current_value,
        'available_coins'		=> $available_coins,
        'new_availability'		=> $new_availability,
        'initial_coin_value'	=> $initial_coin_value,
        'coin_value'			=> $coin_value,
        'coin_amount'			=> $coin_amount,
        'total'					=> $total,
        'total_cost'			=> $total_cost,
        'total_fees'			=> $total_fees,
        'gas_fee'				=> $gas_fee,
        'trans_fee'				=> $trans_fee,
        'trans_percent'			=> $trans_percent,
        'user_gas_fee'			=> $user_gas_fee,
        'user_trans_fee'		=> $user_trans_fee,
        'user_trans_percent'	=> $user_trans_percent,
    );
            
    return $this->db->insert('bf_mymigold_overview', $overviewData);
}

>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
?>

