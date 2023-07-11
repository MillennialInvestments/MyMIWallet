<?php

// Set your API credentials
$client_id = 'your_client_id';
$secret = 'your_secret';
$public_token = 'your_public_token';

// Set the endpoint URL
$endpoint = 'https://sandbox.plaid.com/item/public_token/exchange';

// Set the request parameters
$params = array(
    'client_id' => $client_id,
    'secret' => $secret,
    'public_token' => $public_token
);

// Initialize cURL
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

// Execute the cURL request
$response = curl_exec($ch);

// Close the cURL handle
curl_close($ch);

// Parse the JSON response
$data = json_decode($response, true);

// Get the access token
$access_token = $data['access_token'];

// Print the access token
echo $access_token;

?>