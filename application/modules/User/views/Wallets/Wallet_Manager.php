<?php
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
?>

