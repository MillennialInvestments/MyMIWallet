<script type="text/javascript" src="https://cdn.sophtron.com/sophtron-widget-loader-0.0.0.5.min.js" ></script>
<script>
    sophtron.init('Add' // Actions are 'Add', 'Refresh', 'Demo', 'Mock', 'BankAuth'
        , { 
            env: 'preview', //choose an envrionment to connect to, valid options are 'prod', 'preview' 
            partner: 'default', //you can choose to provide your "Partner Name" or "default" so that we'll load your preference or default settings
            integration_key: 'YWYzNDU3MTgtYzc2Zi00ZjJhLTkyODAtN2E2OTIzMmIzZTYz', // retrieve your integration_key for this session and place here
            request_id: 'd1be4b1a-4d35-4f11-8d42-0f5c60c52dc6', // a unique string for you to identify your user session.
            inistitution_id: '', //optional, pre select a bank to skip the bank search step
            routing_number: '', //optional, pre select a bank to skip the bank search step
            userInistitution_id: '' //if action is Refresh, it's required as the id of the account being refreshed
        },
        true //optional paramter to force re-init if it's already initialized 
    );

    sophtron.show();
</script>
<!-- <script>
const axios = require('axios');

const sophtronApiKey = 'YOUR_API_KEY_HERE';

axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${sophtronApiKey}`;
    return config;
});

axios.get('https://api.sophtron.com/user')
  .then(response => {
    console.log(response.data);
  })
  .catch(error => {
    console.log(error);
  });
</script> -->
<?php

// $credentials = base64_encode("d1be4b1a-4d35-4f11-8d42-0f5c60c52dc6:YWYzNDU3MTgtYzc2Zi00ZjJhLTkyODAtN2E2OTIzMmIzZTYz");

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.sophtron.com/v1/authenticate",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_HTTPHEADER => array(
//     "Authorization: Basic {$credentials}"
//   ),
// ));

// $response = curl_exec($curl);
// curl_close($curl);

// $responseData   = json_decode($response);
// // print_r($responseData);
// $bearerToken    = $responseData->access_token;

// // Now you can use the $bearerToken variable to make authorized requests to the API
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.sophtron.com/v1/api/UserInstitution/CreateUserInstitution",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => array(
//     "Authorization: Bearer " . $bearerToken,
//   ),
// ));

// $response = curl_exec($curl);
// curl_close($curl);
// echo $response;

?>