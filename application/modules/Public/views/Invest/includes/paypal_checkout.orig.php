<?php
// GET PAYPAL ACCESS TOKEN

$client_id						= 'AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n';
$secret							= 'EOmjg41zTjK7Wi8sDZAFlcXYO4hzINqFihp9DyaMcMRvF87ZzBXNWBW0ka9_5PJIZw_erBcfgOoMO9zT';
$curl 							= curl_init();
$curlURL						= 'https://api-m.paypal.com/v1/oauth2/token';
curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL 			=> $curlURL,
        CURLOPT_RETURNTRANSFER	=> true,
        CURLOPT_TIMEOUT 		=> 30,
        CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST 	=> "POST",
        CURLOPT_USERPWD 		=> $client_id.":".$secret,
        CURLOPT_HTTPHEADER		=> array(
            "Accept: application/json",
            "Accept-Language: en_US",
        ),
        CURLOPT_POSTFIELDS		=> "grant_type=client_credentials",
    )
);

$getAccessToken 					= curl_exec($curl);
$err 						= curl_error($curl);

curl_close($curl);
$getAccessToken 				= json_decode($getAccessToken, true); //because of true, it's in an array
//~ print_r($getAccessToken);

//~ // ACCESS TOKENT
//~ // A21AAJhFANRgv5ApGO7bKY9hsyKkQMU5WZXq84YZ_psRcHGvneufAqeJ3ZHaYeb9sGm1EQA7rzo9T9CsQ36jjKvIoYb-R8w2A
$accessToken					= $getAccessToken['access_token'];
$curl 							= curl_init();
$curlURL						= 'https://api-m.paypal.com/v1/identity/generate-token';
curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL 			=> $curlURL,
        CURLOPT_RETURNTRANSFER	=> true,
        CURLOPT_TIMEOUT 		=> 30,
        CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST 	=> "POST",
        CURLOPT_HTTPHEADER		=> array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken,
            'Accept-Language: en_US',
        ),
    )
);

$getClientToken 				= curl_exec($curl);
$err 							= curl_error($curl);

curl_close($curl);
$getClientToken 				= json_decode($getClientToken, true); //because of true, it's in an array
$client_token					= $getClientToken['client_token'];
?>
<?php echo '<script src="https://www.paypal.com/sdk/js?client-id=' . $client_id . '"> // Replace YOUR_CLIENT_ID with your sandbox client ID
</script>'; ?>

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
		window.location.href = '/success.html';
		alert('Transaction completed by ' + details.payer.name.given_name);
	  });
	}
  }).render('#paypal-button-container'); 
</script>
