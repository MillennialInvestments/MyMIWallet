<?php 
// Default Settings
// Default Wallet Information
$status                         = 1;
$active				            = 'Yes';
$beta                           = $this->config->item('beta');
$default_wallet		            = 'Yes';
$exchange_wallet	            = 'Yes';
$market_pair		            = 'USD';
$market				            = 'MYMI';
$broker				            = 'Default';
$nickname			            = 'MyMI Funds';
$wallet_type		            = 'Fiat';
$amount				            = '0.00';
$reporting                      = $_SESSION['reporting'];
$getActiveUsers                 = $this->analytical_model->get_active_users()->result_array();
// // Get Active User Accounts
// $this->db->from('bf_users');
// $this->db->where('active', 1);
// $getActiveUsers                 = $this->db->get()->result_array(); 
?>
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3 class="title">List of Users</h3>
            <table class="table table-default contentCreator">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Username</th>
                        <th>First/Last Name</th>
                        <th>Last Wallet ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                   
                        // Create Wallets for Users without a Default Wallet Assigned 
                        // print_r($getActiveUsers);
                        foreach ($getActiveUsers as $user) {
                            $userID                     = $user['id'];
                            $userEmail                  = $user['email'];
                            $userUsername               = $user['username'];
                            $userName                   = $user['display_name'];
                            $userDefaultWallet          = $user['default_wallet'];
                            if (empty($userDefaultWallet)) {
                                $lastWalletID           = $this->user_model->add_default_wallet_for_existing($userID, $status, $active, $beta, $default_wallet, $exchange_wallet, $market_pair, $market, $userUsername, $userEmail, $broker, $wallet_type, $amount, $nickname);
                                if (!empty($lastWalletID)) {                                    
                                    if ($this->user_model->add_default_wallet_to_user($userID, $userEmail, $userUsername, $lastWalletID)) {
                                        echo '
                                            <tr>
                                                <td>' . $userID . '</td>
                                                <td>' . $userEmail . '</td>
                                                <td>' . $userUsername . '</td>
                                                <td>' . $userName . '</td>
                                                <td>' . $lastWalletID . '</td>
                                            </tr>
                                        ';
                                    }
                                }
                            }
                        }        
                        // Check if default wallet has a status of one 
                        // print_r($getActiveUsers);
                        foreach ($getActiveUsers as $user) {
                            $userID                     = $user['id'];
                            $userEmail                  = $user['email'];
                            $userUsername               = $user['username'];
                            $userName                   = $user['display_name'];
                            $userDefaultWallet          = $user['default_wallet'];
                            $this->db->from('bf_users_wallet');
                            $this->db->where('id', $userDefaultWallet); 
                            $this->db->where('status', 0);
                            $getAllWallets              = $this->db->get()->result_array();
                            if(!empty($getAllWallets)) {
                                foreach($getAllWallets as $walletInfo) {
                                    $walletData         = array(
                                        'status'        => 1,
                                    ); 
                                    $this->db->where('id', $userDefaultWallet);
                                    if ($this->db->update('bf_users_wallet', $walletData)) {
                                        echo '
                                            <tr>
                                                <td>' . $userID . '</td>
                                                <td>' . $userEmail . '</td>
                                                <td>' . $userUsername . '</td>
                                                <td>' . $userName . '</td>
                                                <td>' . $userDefaultWallet . '</td>
                                            </tr>
                                        ';         
                                    }
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>