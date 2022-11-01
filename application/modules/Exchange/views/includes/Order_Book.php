<?php
$getAllOpenOrders	= $this->exchange_model->get_all_open_orders($market_pair, $market);
$getOrdersJSON		= json_encode($getAllOpenOrders);
//~ print_r($getOrdersJSON);
?>
<style>
.table th, .table td {
    font-size: 0.6rem;
    font-weight: bold;
}
</style>
<span style="display:none;" id="orderBookFetch">
	[
		"<?= $market_pair . '/' . $market . '/'; ?>",
		<?= $getOrdersJSON; ?>
	]
</span>
<div class="col-12 col-md-3 border-left px-3">  	
	<div class="level-header">
		<h6>Buy Orders</h6>
	</div>     
	<table class="table table-default" id="exchangeBuyOrders">
		<thead>
			<tr>
				<th>Price</th>
				<th>Amount</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody id="buys" data-type="Buy">
		</tbody>
	</table>
	<hr>	
	<div class="level-header">
		<h6>Sell Orders</h6>
	</div>
	<table class="table table-default" id="exchangeSellOrders">
		<thead>
			<tr>
				<th class="font-inherit">Price</th>
				<th class="font-inherit">Amount</th>
				<th class="font-inherit">Total</th>
			</tr>
		</thead>
		<tbody id="sells" data-type="Sell">
		</tbody>  
	</table>
	<hr>	
	<div class="level-header">
		<h6>Trade History</h6>
	</div>
	<table class="table table-default" id="exchangeTradeHistory">
		<thead>
			<tr>
				<th class="d-none">Timestamp</th>
				<th class="font-inherit">Price</th>
				<th class="font-inherit">Amount</th>
				<th class="font-inherit">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
                $getAllClosedOrders	= $this->exchange_model->get_market_closed_orders($market_pair, $market);
                foreach ($getAllClosedOrders->result_array() as $closedOrders) {
                    $price 		= $closedOrders['amount'] / $closedOrders['total'];
                    echo '
					<tr>
						<td class="d-none">' . $closedOrders['unix_timestamp'] . '</td>
						<td>' . number_format($price, 8)  . '</td>
						<td>' . $closedOrders['amount'] . '</td>
						<td>' . $closedOrders['total'] . '</td>
					</tr>
					';
                }
            ?>
		</tbody>  
	</table>
</div>

