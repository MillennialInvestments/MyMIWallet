<?php 
/*
curl -X 'GET' \
  'https://api.codat.io/companies?page=1&pageSize=100' \
  -H 'accept: application/json' \
  -H 'Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ=='
*/
echo '<h1>Get List of Companies</h1>';
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.codat.io/companies?page=1&pageSize=100",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ==",
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
$response = json_decode($response, true);
print_r($response['results']);
foreach ($response['results'] as $company) {
    echo '<br>Company ID: ' . $company['id'] . '<br>'; 
    echo 'Company Name: ' . $company['name'] . '<br><br>'; 
}
echo '<br><br>'; 
print_r($response['results'][1]); 
?>