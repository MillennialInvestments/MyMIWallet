<?php
$getExchangeOrders							= $this->api_model->get_recent_orders($market_pair, $market, $cuID);
?>
<table class="table table-default table-borderless" id="user-most-recent-orders">
	<thead>
		<tr>
			<th class="text-center" style="font-size: 0.85rem;">Total (<?php echo $market_pair; ?>)</th>
			<th class="text-center" style="font-size: 0.85rem;">Quantity (<?php echo $market; ?>)</th>
			<th class="text-center" style="font-size: 0.85rem;">Price (<?php echo $market_pair; ?>)</th>
		</tr>
	</thead>
	<tbody>
		<?php
        if ($getExchangeOrders !== null) {
            foreach ($getExchangeOrders->result_array() as $order) {
                $amount							= $order['amount'];
                $quantity						= $order['total'];
                $price							= $amount / $quantity;
                echo '<tr>';
                if ($market_pair === 'USD') {
                    echo'
					<td class="text-center">$' . number_format($amount, 2) . '</td>
					<td class="text-center">' . number_format($quantity, 0) . '</td>
					<td class="text-center">$' . number_format($price, 8) . '</td>
					';
                } else {
                    echo'
					<td class="text-center">' . number_format($amount, 2) . '</td>
					<td class="text-center">' . number_format($quantity, 0) . '</td>  
					<td class="text-center">' . number_format($price, 8) . '</td>
					';
                }
                echo '</tr>';
            }
        }
        ?>
	</tbody>
</table>
