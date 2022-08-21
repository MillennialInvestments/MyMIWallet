<?php
$market_pair							= 'USD';
$market									= 'MYMI';
$getLastOrder							= $this->exchange_model->get_last_order($market_pair, $market)->result_array();
foreach ($getLastOrder as $lastOrder) {
    $redirectURL							= $lastOrder['redirectURL'];
    $month									= $lastOrder['month'];
    $day									= $lastOrder['day'];
    $year									= $lastOrder['year'];
    $time									= $lastOrder['time'];
    $status									= $lastOrder['status'];
    $trade_type								= $lastOrder['trade_type'];
    $beta									= $lastOrder['beta'];
    $user_id								= $lastOrder['user_id'];
    $user_email								= $lastOrder['user_email'];
    $wallet_id								= $lastOrder['wallet_id'];
    $market_pair							= $lastOrder['market_pair'];
    $market									= $lastOrder['market'];
    $initial_value							= $lastOrder['initial_value'];
    $coin_value								= $lastOrder['coin_value'];
    $available_coins						= $lastOrder['available_coins'];
    $amount									= $lastOrder['buy_amount'];
    $minimum_purchase						= $lastOrder['minimum_purchase'];
    $total									= $lastOrder['buy_total'];
    $gas_fee								= $lastOrder['buy_user_gas_fee'];
    $fees									= $lastOrder['buy_fees'];
    $trans_percent							= $lastOrder['buy_trans_percent'];
    $trans_fee								= $lastOrder['buy_trans_fee'];
    $total_cost								= $lastOrder['buy_total_cost'];
    $current_value							= $initial_value + $amount;
    $initial_coin_value						= number_format($lastOrder['initial_coin_value'], 8);
    $new_availability						= $available_coins - $total;
    $new_coin_value							= $current_value / $new_availability;
    if ($trade_type === 'Buy') {
        $opp_status							= 'Open';
        $opp_trade_type						= 'Sell';
        $opp_coin_value						= $current_coin_value;
    } elseif ($trade_type === 'Sell') {
        $opp_status							= 'Open';
        $opp_trade_type						= 'Buy';
        $opp_coin_value						= $current_coin_value;
    }
}
// Opposite Order Fields
$this->db->from('bf_exchanges_orders');
$this->db->where('status', $opp_status);
$this->db->where('trade_type', $opp_trade_type);
$this->db->where('initial_coin_value', $initial_coin_value);
$getOppositeOrder						= $this->db->get()->result_array();
//~ print_r($getOppositeOrder);
foreach ($getOppositeOrder as $oppOrder) {
    $opp_month									= $oppOrder['month'];
    $opp_day									= $oppOrder['day'];
    $opp_year									= $oppOrder['year'];
    $opp_time									= $oppOrder['time'];
    $opp_status									= $oppOrder['status'];
    $opp_trade_type								= $oppOrder['trade_type'];
    $opp_beta									= $oppOrder['beta'];
    $opp_user_id								= $oppOrder['user_id'];
    $opp_user_email								= $oppOrder['user_email'];
    $opp_wallet_id								= $oppOrder['wallet_id'];
    $opp_market_pair							= $oppOrder['market_pair'];
    $opp_market									= $oppOrder['market'];
    $opp_initial_value							= $oppOrder['initial_value'];
    $opp_coin_value								= $oppOrder['coin_value'];
    $opp_available_coins						= $oppOrder['available_coins'];
    $opp_amount									= $oppOrder['buy_amount'];
    $opp_minimum_purchase						= $oppOrder['minimum_purchase'];
    $opp_total									= $oppOrder['buy_total'];
    $opp_gas_fee								= $oppOrder['buy_user_gas_fee'];
    $opp_fees									= $oppOrder['buy_fees'];
    $opp_trans_percent							= $oppOrder['buy_trans_percent'];
    $opp_trans_fee								= $oppOrder['buy_trans_fee'];
    $opp_total_cost								= $oppOrder['buy_total_cost'];
    $opp_current_value							= $opp_initial_value + $opp_amount;
    $opp_initial_coin_value						= number_format($oppOrder['initial_coin_value'], 8);
    $opp_new_availability						= $opp_available_coins - $opp_total;
    $opp_new_coin_value							= $opp_current_value / $opp_new_availability;
}
?>
<div class="row">
	<div class="col-6">
		<h5>Initial Order Information</h5>  
		<table class="table">
			<tbody>
			<?php
            
                echo '
				<tr>
					<th>Status:</th>
					<td>' . $status . '</td>
				</tr>
				<tr>
					<th>Trade Type:</th>
					<td>' . $trade_type . '</td>
				</tr>
				<tr>
					<th>Coin Value:</th>
					<td>' . $initial_coin_value . '</td>
				</tr>
				';
            ?>	
			</tbody>
		</table> 
	</div>
	<div class="col-6">
		<h5>Initial Order Information</h5>  
		<table class="table">
			<tbody>
			<?php
            
                echo '
				<tr>
					<th>Status:</th>
					<td>' . $opp_status . '</td>
				</tr>
				<tr>
					<th>Trade Type:</th>
					<td>' . $opp_trade_type . '</td>
				</tr>
				<tr>
					<th>Coin Value:</th>
					<td>' . $opp_initial_coin_value . '</td>
				</tr>
				';
            ?>	
			</tbody>
		</table>
	</div>
</div>    

