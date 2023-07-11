<?php
use GuzzleHttp\Client; 

// Codat API
$api_key    = 'YOUR_API_KEY';
$url        = "https://api.codat.io/v1/companies?limit=100&offset=0";

$client     = new Client();
$reponse    = $client->get($url); 
$data       = json_decode($response->getBody(), true); 

print_r($data); 