<?php
$orderForm								= trim(file_get_contents("php://input"));
$orderForm								= json_decode($orderForm, true);
$orderStatus							= 'Open';

// Custom-Defined Order Variables
$opp_trade_type							= 'Buy';

// GET Request Defined Variables
$trade_type								= $orderForm['trade_type'];
$market_pair							= $orderForm['market_pair'];
$market									= $orderForm['market'];
$trade_type								= $orderForm['trade_type'];
$current_coin_value						= $orderForm['current_coin_value'];
$total									= $orderForm['buy_total'];
$remaining_coins						= $total;
$current_value							= $orderForm['initial_value'] + $orderForm['sell_amount'];
$new_availability						= $orderForm['available_coins'];
$new_coin_value							= round($current_value / $new_availability, 8);

// Get Opposite Order Info Where price Equals current_coin_value Where market_pair And market Match
$this->db->from('bf_exchanges_orders');
$this->db->where('market_pair', $market_pair);
$this->db->where('market', $market);
$this->db->where('status', 'Open');
$this->db->where('trade_type', $opp_trade_type);
$this->db->where('initial_coin_value', $current_coin_value);
$this->db->order_by('id', 'ASC');
$getOppTradeInfo						= $this->db->get();
if ($getOppTradeInfo !== null) {
    $oppUserID							= $oppOrder['user_id'];
    
    $this->db->from('bf_users');
    $this->db->where('id', $oppUserID);
    $getOppUserInfo						= $this->db->get();
    if ($getOppUserInfo !== null) {
        foreach ($getOppUserInfo->result_array() as $oppUser) {
            $oppUserAcctType				= $oppUser['type'];
            if ($oppUserAcctType === 'Beta') {
                $oppUserBeta				= 'Yes';
            } else {
                $oppUserBeta				= 'No';
            }
        }
        // Retrieve Opposite Order Information
        foreach ($getOppTradeInfo->result_array() as $oppOrder) {
            $oppID							= $oppOrder['id'];
            $oppTotal						= $oppOrder['total'];
            $oppOrderTradeData				= array(
                'submitted_date'			=> date("F jS, Y"),
                'submitted_time'			=> date("g:i A"),
                'trade_date'				=> date("Y-m-d"),
                'trade_time'				=> date("g:i"),
                'user_type'					=> $oppUserAcctType,
                'user_id'					=> $oppOrder['user_id'],
                'email'						=> $oppOrder['user_email'],
                'trading_account'			=> $oppOrder['trading_account'],
                'trade_type'				=> 'Crypto Trade',
                'purchase_type'				=> $opp_trade_type,
                'symbol_type'				=> 'Crypto',
                'exchange'					=> $market_pair,
                'symbol'					=> $market,
                'company'					=> $market_pair . '-' . $market,
                'link'						=> 'Exchange/Market/' . $market_pair . '/' . $market,
                'total_trade_cost'			=> $oppOrder['total_cost'],
                'current_price'				=> $oppOrder['initial_coin_value'],
                'position_size'				=> $oppOrder['total'],
            );
        }
    }
          
    
    // Conduct Algorhithm for Trade Transaction
    // If greater than 0
    // S(100000) 	- 	B(20000)			= S(80000) | B(0);
    // If less than 0
    // S(20000) 	- 	B(100000)			= B(-80000) | S(0);
    $trans_remaining_coins				= $oppPosSize - $total;
    
    if ($trans_remaining_coins > 0) {
        $oppStatus						= 'Open';
        $oppRemainingCoins 				= $trans_remaining_coins;
        $status							= 'Closed';
        $remaining_coins				= 0;
    } elseif ($trans_remaining_coins < 0) {
        $oppStatus						= 'Closed';
        $oppRemainingCoins 				= 0;
        $status							= 'Open';
        $remaining_coins				*= -1;
    }
    
    // ------------------------------------ WORKING BELOW --------------------------------------- \\
    // Define Buy Order Submit Array
    $orderData 							= array(
        'unix_timestamp'				=> $orderForm['unix_timestamp'],
        'status'				 		=> $status,
        'trade_type'				 	=> $trade_type,
        'month'						 	=> $orderForm['month'],
        'day'						 	=> $orderForm['day'],
        'year'						 	=> $orderForm['year'],
        'time'						 	=> $orderForm['time'],
        'beta'						 	=> $orderForm['beta'],
        'user_id'					 	=> $orderForm['user_id'],
        'user_email'				 	=> $orderForm['user_email'],
        'trading_account'			 	=> $orderForm['trading_account'],
        'wallet_id'					 	=> $orderForm['wallet_id'],
        'market_pair'				 	=> $market_pair,
        'market'					 	=> $market,
        'initial_value'				 	=> $orderForm['initial_value'],
        'current_value'					=> $current_value,
        'available_coins'			 	=> $orderForm['available_coins'],
        'initial_coin_value'			=> $current_coin_value,
        'amount'					 	=> $orderForm['sell_amount'],
        'total'						 	=> $total,
        'remaining_coins'				=> $remaining_coins,
        'gas_fee'					 	=> $orderForm['sell_gas_fee'],
        'user_gas_fee'					=> $orderForm['sell_user_gas_fee'],
        'trans_percent'				 	=> $orderForm['sell_trans_percent'],
        'user_trans_percent'			=> $orderForm['sell_user_trans_percent'],
        'trans_fee'						=> $orderForm['sell_trans_fee'],
        'user_trans_fees'				=> $orderForm['sell_user_trans_fee'],
        'fees'						 	=> $orderForm['sell_fees'],
        'total_cost'					=> $orderForm['sell_total_cost'],
        'new_availability'				=> $new_availability,
        'new_coin_value'				=> $new_coin_value,
    );
    
    $this->db->insert('bf_exchanges_orders', $orderData);
    
    $orderTradeData						= array(
        'submitted_date'				=> date("F jS, Y"),
        'submitted_time'				=> date("g:i A"),
        'trade_date'					=> date("Y-m-d"),
        'trade_time'					=> date("g:i"),
        'user_type'						=> $oppUserAcctType,
        'user_id'						=> $orderForm['user_id'],
        'email'							=> $orderForm['user_email'],
        'trading_account'				=> $orderForm['trading_account'],
        'trade_type'					=> 'Crypto Trade',
        'purchase_type'					=> $opp_trade_type,
        'symbol_type'					=> 'Crypto',
        'exchange'						=> $market_pair,
        'symbol'						=> $market,
        'company'						=> $market_pair . '-' . $market,
        'link'							=> 'Exchange/Market/' . $market_pair . '/' . $market,
        'total_trade_cost'				=> $orderForm['sell_total_cost'],
        'current_price'					=> $orderForm['sell_amount'],
        'position_size'					=> $total,
    );
    
    $oppOrderData						= array(
        'status'						=> $oppStatus,
        'remaining_coins'				=> $oppRemainingCoins,
    );
    $this->db->where('id', $oppID);
    $this->db->update('bf_exchanges_orders', $oppOrderData);
    
    $this->db->insert('bf_users_trades', $orderTradeData);
    $this->db->insert('bf_users_trades', $oppOrderTradeData);
    
    $exchangeData						= array(
        'coins_available'				=> $new_availability,
        'current_value'					=> $current_value,
        'coin_value'					=> $new_coin_value,
    );
    $this->db->where('market', $market);
    $this->db->update('bf_exchanges', $exchangeData);
} else {
    log_message('error', 'Query was not submitted. Did not meet criteria');
    // Define Buy Order Submit Array
    $orderData 							= array(
        'unix_timestamp'				=> $orderForm['unix_timestamp'],
        'status'				 		=> $status,
        'trade_type'				 	=> $trade_type,
        'month'						 	=> $orderForm['month'],
        'day'						 	=> $orderForm['day'],
        'year'						 	=> $orderForm['year'],
        'time'						 	=> $orderForm['time'],
        'beta'						 	=> $orderForm['beta'],
        'user_id'					 	=> $orderForm['user_id'],
        'user_email'				 	=> $orderForm['user_email'],
        'trading_account'			 	=> $orderForm['trading_account'],
        'wallet_id'					 	=> $orderForm['wallet_id'],
        'market_pair'				 	=> $market_pair,
        'market'					 	=> $market,
        'initial_value'				 	=> $orderForm['initial_value'],
        'current_value'					=> $current_value,
        'available_coins'			 	=> $orderForm['available_coins'],
        'initial_coin_value'			=> $current_coin_value,
        'amount'					 	=> $orderForm['sell_amount'],
        'total'						 	=> $total,
        'remaining_coins'				=> $total,
        'gas_fee'					 	=> $orderForm['sell_gas_fee'],
        'user_gas_fee'					=> $orderForm['sell_user_gas_fee'],
        'trans_percent'				 	=> $orderForm['sell_trans_percent'],
        'user_trans_percent'			=> $orderForm['sell_user_trans_percent'],
        'trans_fee'						=> $orderForm['sell_trans_fee'],
        'user_trans_fees'				=> $orderForm['sell_user_trans_fee'],
        'fees'						 	=> $orderForm['sell_fees'],
        'total_cost'					=> $orderForm['sell_total_cost'],
        'new_availability'				=> $new_availability,
        'new_coin_value'				=> $new_coin_value,
    );
    return $this->db->insert('bf_exchanges_orders', $orderData);
}
?>

