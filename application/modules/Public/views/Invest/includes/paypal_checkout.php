<?php
$pageURIC							= $this->uri->segment(3);
$transID							= $pageURIC;
// GET PAYPAL ACCESS TOKEN

//~ Production Client Key
//~ $client_id						= 'AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n';
//~ $secret							= 'EOmjg41zTjK7Wi8sDZAFlcXYO4hzINqFihp9DyaMcMRvF87ZzBXNWBW0ka9_5PJIZw_erBcfgOoMO9zT';

//~ Sandbox Client Key
$client_id							= 'AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n';
//~ $secret							= 'EOmjg41zTjK7Wi8sDZAFlcXYO4hzINqFihp9DyaMcMRvF87ZzBXNWBW0ka9_5PJIZw_erBcfgOoMO9zT';

echo '<script src="https://www.paypal.com/sdk/js?client-id=' . $client_id . '"></script>';
?>

<div id="paypal-button-container"></div>

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
		window.location.href = <?php echo '\'/Invest/Purchase_Complete/' . $transID . '\'';?>;
	  });
	}
  }).render('#paypal-button-container'); 
</script>
