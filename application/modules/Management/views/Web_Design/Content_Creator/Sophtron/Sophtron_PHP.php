<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/enc-base64.min.js"></script>

<script>
    // function createAccessKeyAuthCode(userId, accessKey, url, httpMethod) {
    //     var authPath = url.substring(url.lastIndexOf('/')).toLowerCase();
    //     var decodedSecret = atob(accessKey);
    //     var plainKey = httpMethod.toUpperCase() + '\n' + authPath;
    //     var hash = CryptoJS.HmacSHA256(plainKey, decodedSecret);
    //     var b64Sig = CryptoJS.enc.Base64.stringify(hash); 
    //     var authString = 'FIApiAUTH:' + userId + ':' + b64Sig + ':' + authPath;
    //     return authString;
    //     console.log(authString);
    // }
</script>
<?php
// $headers                                        = array();
// $headers[]                                      = 'Content-Type: application/json';

// $curl 						                    = curl_init();
// $apiBaseURL                                     = 'https://api.sophtron.com/api/UserInstitution/CreateUserInstitution';

// curl_setopt_array($curl, array(
//   CURLOPT_URL 				=> $apiBaseURL,
//   CURLOPT_RETURNTRANSFER	=> true,
//   CURLOPT_TIMEOUT 			=> 30,
//   CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST 	=> "POST",
//   CURLOPT_HTTPHEADER 		=> array(
//     "cache-control: no-cache",
//     //~ "Authorization: Bearer qR3usBX+nmaKe1YpNAVem+rGx7itMd3v5TiuyiUTi6HseA6+LEC+lPhygGBm2cjNFutH/ElNRcXApLqRLqs+KS1zXD1B89rab6RjxDEd9Qmqey+8nhO/kMKbOoJUvFkGrJDbm1lD0uPxfpolIbTBqh7vE6qzhwe7Xs9XSdU4w75VzxYgIsn8VC6SrxfDjGM4cqlUslZbLFn3nVrV61/J8gk35G2RpL3LNHzdgulSiuAlkUIo8L9duEAJQyf5+6YO8eLQjAZwIglRVARZRW+PV3/OkatiEhplgFepTane81TY3uo0QW9G1ukRZIg8r2qSZ3Bt7KKjJVBNh46P9fT6GOPlWAx3uEcFmpCuchf0K0cmiCOMp8BLve6kHVVMBtHxBURhFQgSmCzn/pRgrqnfHxhZbDqmifNEVtN/pUm+u0iR6TFYgFKiTfFBqJBJmVvTGbVlzHhFOrX/JD9yEzES1rT1DrNEgK4Z0AyNbAjpGLZEi8+82PLGSmlviFUMJ6tSjsR+5Rj/b+KAqVlIbgTexwSVblLmEhhAU6qn8100MQuG4LYrgoVi/JHHvlw0vm7dIyDxuV7Nro4L4wZVqm8WSodlvqsu0Ko+XJSqmJzAVkO1lnPlRcFMVS8qeStqPKAkEWz3pX+DIlIxILWoUFe1IPEQ5G2X+E0xs2KcoPDCvWQAUdI4WbiX9lL5ivFaIhmX0Z9+LeYKM7roN9X5Xk+c/C5HfpabU2+HF11VqY85nlvNa1EVMmNZd65sxypTUNqs94RxV0T8yN3mqwhuCml3qos83JKa4eqeOXR2X328h2sRlpNABhgLbhKoqbiFBobX7zN3tGe/b1i6cbX0FXSET14+mHx6spbpzAAJObaYRrXLzlLs/guCRn5iqGOnlppqNMoDHvlkeSEZQ0g975o2nOWktkPXGOZ/9gXKe3GJXHMDgVoLJlBioLsM+CVYWqK1oWvUwo0t2hPidvSdEdyOPhNI7itJM6Q2pTWmBKOn0am1uEK9J1mZMNp0qz0TxYcQ5hsizsWW2cWzwqkXV2mR93uTxhp5Wq2GFAkFr5dRdo4+sd1mq8ItOaSSpvUMrIqM+cdhuIyUqlGzQ3L2rwZWcXxSFpIwIeta212FD3x19z9sWBHDJACbC00B75E"
//   ),
// ));

// $response 					= curl_exec($curl);
// $err 						= curl_error($curl);

// curl_close($curl);
// $response 					= json_decode($response, true); //because of true, it's in an array
// print_r($response);
?>
<!-- <script type="text/javascript" src="https://cdn.sophtron.com/sophtron-widget-loader-0.0.0.5.min.js" ></script>
<script type="text/javascript">
    sophtron.init('Add' // Actions are 'Add', 'Refresh', 'Demo', 'Mock', 'BankAuth'
        , { 
            env: 'preview', //choose an envrionment to connect to, valid options are 'prod', 'preview' 
            partner: 'default', //you can choose to provide your "Partner Name" or "default" so that we'll load your preference or default settings
            integration_key: 'd1be4b1a-4d35-4f11-8d42-0f5c60c52dc6', // retrieve your integration_key for this session and place here
            request_id: 'd1be4b1a-4d35-4f11-8d42-0f5c60c52dc6', // a unique string for you to identify your user session.
            inistitution_id: '', //optional, pre select a bank to skip the bank search step
            routing_number: '', //optional, pre select a bank to skip the bank search step
            userInistitution_id: '' //if action is Refresh, it's required as the id of the account being refreshed
        },
        true //optional paramter to force re-init if it's already initialized 
    );
    sophtron.show();
</script> -->