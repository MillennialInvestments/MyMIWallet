
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
<div id="smart-button-container">
    <div style="text-align: center"><label for="description">Amount </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>
      <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
    <div style="text-align: center"><label for="amount">Cost/Coin </label><input name="amountInput" type="number" id="amount" value="" ><span> USD</span></div>
      <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
      <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
  </div>
  <script src="https://www.paypal.com/sdk/js?client-id=AeNL90i_VizF7CId1oC3Buc7YlyPHJIO9BF3t0j1FwW7_RRLsTKfPyeFu30S_VRu6WydKw7ETUmtFp2n&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
  function initPayPalButton() {
    var description = document.querySelector('#smart-button-container #description');
    var amount = document.querySelector('#smart-button-container #amount');
    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [description, amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = "block";
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
    }

    paypal.Buttons({
      style: {
        color: 'gold',
        shape: 'rect',
        label: 'paypal',
        layout: 'vertical',
        
      },

      onInit: function (data, actions) {
        actions.disable();

        if(invoiceidDiv.style.display === "block") {
          elArr.push(invoiceid);
        }

        elArr.forEach(function (item) {
          item.addEventListener('keyup', function (event) {
            var result = elArr.every(validate);
            if (result) {
              actions.enable();
            } else {
              actions.disable();
            }
          });
        });
      },

      onClick: function () {
        if (description.value.length < 1) {
          descriptionError.style.visibility = "visible";
        } else {
          descriptionError.style.visibility = "hidden";
        }

        if (amount.value.length < 1) {
          priceError.style.visibility = "visible";
        } else {
          priceError.style.visibility = "hidden";
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
          invoiceidError.style.visibility = "visible";
        } else {
          invoiceidError.style.visibility = "hidden";
        }

        purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: purchase_units,
        });
      },

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>
