 <?php
$client                                     = new \GuzzleHttp\Client(); 

$this->load->library('MyMIGold');
$this->load->config('site_settings');
$getCoinValue							    = $this->mymigold->get_coin_value();
$featureForm							    = trim(file_get_contents("php://input"));
$featureForm							    = json_decode($featureForm, true);
$beta									    = $featureForm['beta']; // Set whether platform is in Beta
// GET Request Defined Variables
$feature_type                               = $featureForm['feature_type'];
if ($feature_type === 'Premium Wallet') {
    $status									= 'Complete';
    $unix_timestamp							= time(); // Unix Timestamp from submitted wallet transaction - Auto-generated
    $date									= date('d F y'); // Date of submitted wallet transaction - Auto-generated
    $time									= date('h:i A'); // Time of submitted wallet transaction - Auto-generated
    $month									= date("m"); // Month of submitted wallet transaction - Auto-generated
    $day									= date("j"); // Day of submitted wallet transaction - Auto-generated
    $year									= date("Y"); // Year of submitted wallet transaction - Auto-generated
    $coin									= 'MYMIG'; // Set Coin as MyMI Gold
    $user_id								= $featureForm['user_id']; // Set User ID
    $user_email								= $featureForm['user_email']; // Set User Email
    $wallet_id								= $featureForm['wallet_id']; // Set Wallet ID
    $wallet_type							= $featureForm['wallet_type']; // Set Wallet Type
    // $purchase_type							= 'Premium Wallet'; // Set Feature Purchase Type (ex: Premium Wallet, Trade Tracker, etc.)//
    $feature_cost							= $featureForm['feature_cost']; // Set Cost of Feature Purchase
    $initial_value							= $getCoinValue[0]['amount']; // Set Initial Value of Total MyMI Gold Purchases
    $initial_coin_value						= $featureForm['coin_value'];
    $gas_fee								= $this->config->item('gas_fee');
    $trans_fee								= $this->config->item('trans_fee');
    $trans_percent							= $this->config->item('trans_percent');
    $available_coins						= $featureForm['available_coins'];
    $new_coin_value							= $featureForm['coin_value'];
    $initial_balance						= $featureForm['initial_balance'];
    $orig_total								= '-' . $feature_cost / $initial_coin_value;
    $amount									= round(-$orig_total * $initial_coin_value, 2);
    $subtotal								= $amount / $initial_coin_value;
    $expenses								= ($amount * $trans_percent) + $trans_fee;
    $total_cost								= number_format($amount + $expenses, 2);
    $total_fees								= number_format($expenses, 2);
    $user_gas_fee							= number_format($amount * $gas_fee, 2);
    $user_trans_fee							= $trans_fee;
    $user_trans_percent						= number_format($amount * $trans_percent, 2);
    $current_value							= $initial_value + $total_cost;
    $new_availability						= $available_coins + $orig_total;
    // $new_coin_value							= round($current_value / $new_availability, 8);
    $remaining_balance						= $initial_balance + $orig_total;
    $fee_coins								= $expenses / $initial_coin_value;
    $total									= '-' . $amount;
    if ($wallet_type === 'Fiat') {
        $redirectURL						= 'Add-Fiat-Wallet';
        $feature    						= 'Premium Fiat Wallet';
    } elseif ($wallet_type === 'Digital') {
        $redirectURL						= 'Add-Digital-Wallet';
        $feature    						= 'Premium Crypto Wallet';
    }

    $userRequest							= array(
        'status'							=> $status,
        'beta'								=> $beta,
        'user_id'							=> $user_id,
        'user_email'						=> $user_email,
        'coin'								=> $coin,
        'wallet_id'							=> $wallet_id,
        'initial_value'						=> $initial_value,
        'current_value'						=> $current_value,
        'available_coins'					=> $available_coins,
        'new_availability'					=> $new_availability,
        'initial_coin_value'				=> $initial_coin_value,
        'new_coin_value'					=> $new_coin_value,
        'amount'							=> $amount,
        'total'								=> $total,
        'total_cost'						=> $total_cost,
        'total_fees'						=> $total_fees,
        'gas_fee'							=> $gas_fee,
        'trans_fee'							=> $trans_fee,
        'trans_percent'						=> $trans_percent,
        'user_gas_fee'						=> $user_gas_fee,
        'user_trans_fee'					=> $user_trans_fee,
        'user_trans_percent'				=> $user_trans_percent,
    );

    $this->db->insert('bf_users_coin_purchases', $userRequest);
    $purchase_id                            = $this->db->insert_id();

    $feature 								= array(
        'trans_id'							=> $purchase_id,
        'status'							=> $status,
        'beta'								=> $beta,
        'user_id'							=> $user_id,
        'user_email'						=> $user_email,
        'wallet_id'							=> $wallet_id,
        'feature_cost'						=> $feature_cost,
        'purchase_type'						=> $feature,
        'initial_balance'					=> $initial_balance,
        'amount'							=> $amount,
        'total'								=> $total,
        'remaining_balance'					=> $remaining_balance,
    );

    $this->db->insert('bf_users_purchases', $feature);

    $myMIGold								= array(
        'status'							=> $status,
        'trans_id'							=> $purchase_id,
        'beta'								=> $beta,
        'wallet_id'							=> $wallet_id,
        'user_id'							=> $user_id,
        'user_email'						=> $user_email,
        'initial_value'						=> $initial_value,
        'current_value'						=> $current_value,
        'available_coins'					=> $available_coins,
        'new_availability'					=> $new_availability,
        'initial_coin_value'				=> $initial_coin_value,
        'coin_value'						=> $new_coin_value,
        'amount'							=> $amount,
        'total'								=> $total,
        'total_cost'						=> $total_cost,
        'total_fees'						=> $total_fees,
        'gas_fee'							=> $gas_fee,
        'trans_fee'							=> $trans_fee,
        'trans_percent'						=> $trans_percent,
        'user_gas_fee'						=> $user_gas_fee,
        'user_trans_fee'					=> $user_trans_fee,
        'user_trans_percent'				=> $user_trans_percent,
    );

    return $this->db->insert('bf_mymigold_overview', $myMIGold);
}
?>

