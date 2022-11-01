<?php
$cuUserType							= $_SESSION['allSessionData']['userAccount']['cuUserType'];
// GET PAYPAL ACCESS TOKEN
if ($cuUserType	=== 'Beta') {
    // Sandbox PayPal API Key
    $client_id							= 'AffPMSjviq6Zkkpvn79YQnawbzP6bnG7J71vfbMu5eYp9qUe7OnoaKtEksenCvMkV3EU6D0M_927_PX_';
    echo '   	
	<div class="col-md-4"></div>
	<div class="col-md-4">   
		<p class="card-text blog-text text-center">
			<strong>BETA CREDIT CARD INFORMATION</strong><br>
            <strong>USE THIS CREDIT CARD FOR BETA USE ONLY</strong>
		</p>   
		<table class="table table-borderless">
			<tbody>
				<tr>
					<td>Credit Card Number</td>
					<td class="text-right">4032034114488086</td>
				</tr>
				<tr>
					<td>Expiration Date</td>
					<td class="text-right">07/2025</td>
				</tr>
				<tr>
					<td>Security Code</td>
					<td class="text-right">279</td>
				</tr>
			</tbody>
		</table>
		<hr>
	</div>   
	<div class="col-md-2"></div>
	';
} else {
    // Production PayPal API Key
    $client_id							= 'AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n';
}

echo '<script src="https://www.paypal.com/sdk/js?client-id=' . $client_id . '"></script>';
?>

<div class="col-md-4"></div>
<div class="col-md-4">
	<div id="paypal-button-container"></div>
</div>

<!-- Add the checkout buttons, set up the order and approve the order -->
<script>
  paypal.Buttons({
	createOrder: function(data, actions) {
	  return actions.order.create({
		purchase_units: [{
		  amount: {
			value: <?php echo '"' . $total_cost . '"'; ?>
		  }
		}]
	  });
	},
	onApprove: function(data, actions) {
	  return actions.order.capture().then(function(details) {
		window.location.href = <?php echo '\'/MyMI-Gold/Purchase-Complete/' . $orderID . '\'';?>;
	  });
	}
  }).render('#paypal-button-container'); 
</script>
