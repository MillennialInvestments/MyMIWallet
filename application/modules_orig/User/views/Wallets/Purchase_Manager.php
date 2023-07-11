<?php
$orderForm								= trim(file_get_contents("php://input"));
$orderForm								= json_decode($orderForm, true);

// GET Request Defined Variables
$status									= 'Complete';
$beta									= $orderForm['beta'];
$coin									= 'MYMIG';
$user_id								= $orderForm['user_id'];
$user_email								= $orderForm['user_email'];
$wallet_id								= $orderForm['wallet_id'];
$wallet_type							= $orderForm['wallet_type'];
$purchase_type							= 'Premium Wallet';
$feature_cost							= $orderForm['feature_cost'];
$initial_value							= $orderForm['initial_value'];
$available_coins						= $orderForm['available_coins'];
$initial_coin_value						= $orderForm['coin_value'];
$orig_total								= '-' . $feature_cost;
$amount									= round(-$orig_total, 2);
$gas_fee								= $gas_fee;
$trans_fee								= $trans_fee;
$trans_percent							= $trans_percent;
$subtotal								= $amount;
$expenses								= ($amount * $trans_percent) + $trans_fee;
$total_cost								= number_format($amount + $expenses, 2);
$total_fees								= number_format($expenses, 2);
$user_gas_fee							= number_format($amount * $gas_fee, 2);
$user_trans_fee							= $trans_fee;
$user_trans_percent						= number_format($amount * $trans_percent, 2);
$current_value							= $initial_value + $total_cost;
$new_availability						= $available_coins + $orig_total - $gas_fee;
$new_coin_value							= round($current_value / $new_availability, 8);
$initial_balance						= $orderForm['initial_balance'];
$remaining_balance						= $initial_balance + $orig_total;
$fee_coins								= $expenses / $initial_coin_value;
$total									= $orig_total - $fee_coins;
if ($wallet_type === 'Fiat') {
    $redirectURL						= 'Add-Fiat-Wallet';
    $purchase_type						= 'Premium Fiat Wallet';
} elseif ($wallet_type === 'Digital') {
    $redirectURL						= 'Add-Digital-Wallet';
    $purchase_type						= 'Premium Crypto Wallet';
}
$featureData							 = array(
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

$this->db->insert('bf_users_coin_purchases', $featureData);
$getPurchaseID							= $this->mymigold_model->get_last_purchase_id();
foreach ($getPurchaseID->result_array() as $purchase) {
    $purchase_id						= $purchase['id'];
}
$purchaseData 							= array(
    'trans_id'							=> $purchase_id,
    'status'							=> $status,
    'beta'								=> $beta,
    'user_id'							=> $user_id,
    'user_email'						=> $user_email,
    'wallet_id'							=> $wallet_id,
    'feature_cost'						=> $feature_cost,
    'purchase_type'						=> $purchase_type,
    'initial_balance'					=> $initial_balance,
    'amount'							=> $amount,
    'total'								=> $total,
    'remaining_balance'					=> $remaining_balance,
);
$this->db->insert('bf_users_purchases', $purchaseData);
$valueData 								= array(
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

$this->db->insert('bf_mymigold_overview', $valueData);
return Template::set_message('Premium Wallet Purchased Successfully', 'success');
?>

