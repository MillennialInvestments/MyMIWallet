<?php
$coinPurchaseForm			= trim(file_get_contents("php://input"));
$coinPurchaseForm			= json_decode($coinPurchaseForm, true);
$isBeta						= $this->config->item('beta');
if ($isBeta === 1) {
    $beta					= 'Yes';
} else {
    $beta					= 'No';
}
$status						= 'Incomplete';
$unix_timestamp				= time();
$month						= date("n");
$day						= date("j");
$year						= date("Y");
$time 						= date("G:i:s");
$wallet_id					= $coinPurchaseForm['wallet_id']; 			// ID of Wallet Selected from Transaction
$user_id					= $coinPurchaseForm['user_id'];				// Define User ID
$user_email					= $coinPurchaseForm['user_email'];			// Define User Email
$coin						= $coinPurchaseForm['coin'];				// Define Coin Purchased
$initial_value				= $coinPurchaseForm['initial_value'];		// Define Initial Value of Coin Market Cap
$available_coins			= $coinPurchaseForm['available_coins'];		// Define Availability of Coins (if defined or required)
$initial_coin_value			= $coinPurchaseForm['initial_coin_value'];	// Define Initial Coin Value
$new_coin_value				= $coinPurchaseForm['initial_coin_value']; 	// Same Initial Coin Value
$amount						= $coinPurchaseForm['total'];				// Define Amount of Funds Used to Purchase Coins
$current_value				= $initial_value + $amount;					// Define New Value of MyMI Gold by adding Initial Value + Amount Spent
$total						= $coinPurchaseForm['total'];				// Define Total Amount of Coins Being Purchased
$new_availability			= $available_coins + $total;				// Define New Availabile Coins (Available Coins + Total)
$total_cost					= $coinPurchaseForm['total_cost'];			// Define Total Cost of Transaction
$total_fees					= $coinPurchaseForm['total_fees'];			// Define Total Fees
$gas_fee					= $coinPurchaseForm['gas_fee'];				// Define Total Gas Fees (Coins to Cover Transfer of Coins)
$trans_fee					= $coinPurchaseForm['trans_fee'];			// Define Single Transcation Fee
$trans_percent				= $coinPurchaseForm['trans_percent'];		// Define Percentage Fee of Single Transaction
$user_gas_fee				= $coinPurchaseForm['user_gas_fee'];		// Define User Gas Fee Total
$user_trans_fee			    = 0.6;										// Define User Single Transaction Fee Total
$user_trans_percent			= $coinPurchaseForm['user_trans_percent'];	// Define User Single Transaction Percentage Fee Total
$feature                    = $coinPurchaseForm['feature']; 
$redirect_url               = $coinPurchaseForm['redirect_url'];        // Define Redirect URL

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
    'amount'				=> $amount,
    'total'					=> $total,
    'total_cost'			=> $total_cost,
    'total_fees'			=> $total_fees,
    'gas_fee'				=> $gas_fee,
    'trans_fee'				=> $trans_fee,
    'trans_percent'			=> $trans_percent,
    'user_gas_fee'			=> $user_gas_fee,
    'user_trans_fee'		=> $user_trans_fee,
    'user_trans_percent'	=> $user_trans_percent,
    'feature'               => $feature,
    'redirect_url'          => $redirect_url,
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
    'amount'				=> $amount,
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
