<?php 
/*
curl -X 'GET' \
  'https://api.codat.io/companies?page=1&pageSize=100' \
  -H 'accept: application/json' \
  -H 'Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ=='
*/
echo '<h1>Create Account</h1>';
$testCompanyName                    = urlencode('My Test Company'); 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.codat.io/companies');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"name\": \"My Test Company\",\n}");

$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ==';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$result = json_decode($result, true);
print_r($result); 
?>