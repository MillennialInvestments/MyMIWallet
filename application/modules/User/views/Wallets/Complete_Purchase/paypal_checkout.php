<?php
$cuUserType							= $_SESSION['allSessionData']['userAccount']['cuUserType'];
// GET PAYPAL ACCESS TOKEN
if ($cuUserType	=== 'Beta') {
    // Sandbox PayPal API Key
    $client_id							= 'AffPMSjviq6Zkkpvn79YQnawbzP6bnG7J71vfbMu5eYp9qUe7OnoaKtEksenCvMkV3EU6D0M_927_PX_';
} else {
    // Production PayPal API Key
    $client_id							= 'AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n';
}

echo '<script src="https://www.paypal.com/sdk/js?client-id=' . $client_id . '"></script>';
?>

<div class="col-12">
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
        <?php
        $url        = site_url('MyMI-Gold/Purchase-Complete/' . $orderID);
        ?>
		window.location.href = <?php echo '\'' . $url . '\'';?>;
	  });
	}
  }).render('#paypal-button-container'); 
</script>
