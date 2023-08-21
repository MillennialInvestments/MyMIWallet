<?php
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

?>

