<?php 
/*
Convert CURL to PHP https://codebeautify.org/curl-to-php-online
*/
// $this->load->view('Management/Web_Design/Content_Creator/Codat/Create_Company'); 
// $this->load->view('Management/Web_Design/Content_Creator/Codat/Get_Companies'); 
// $this->load->view('Management/Web_Design/Content_Creator/Codat/Integrations'); 

// echo '<br><br><hr><br><br>'; 

// $this->load->view('Management/Web_Design/Content_Creator/Codat/Create_Company'); 

// echo '<br><br><hr><br><br>'; 
// use GuzzleHttp\Client;

// $client = new Client();
// $apiKey             = 'Xtl2psdJQEU61NKKVy2ymmkV29RU98GzrRQyrbFy';
// $baseEncodeAPI      = base64_encode($apiKey);
// $response = $client->request('GET', 'https://api.codat.io/companies', [
//     'headers' => [
//         'Authorization' => 'Bearer ' . $baseEncodeAPI,
//         'Content-Type' => 'application/json',
//     ],
// ]);

// $companies = json_decode($response->getBody()->getContents());

// print_r($companies);

$apiKey             = 'Xtl2psdJQEU61NKKVy2ymmkV29RU98GzrRQyrbFy';
$baseEncodeAPI      = base64_encode($apiKey);
// echo $baseEncodeAPI;
$headers            = array(
    'accept: application/json',
    'Authorization: Basic ' . $baseEncodeAPI,
);
$companyID          = '9d6fefef-e70b-47d1-9eb4-1b0fd9170888'; 
$this->load->library('curl');
$url                = 'https://api.codat.io/companies/' . $companyID . '/connections?page=1&pageSize=100';
$result             = $this->curl->simple_get($url, array(), array(CURLOPT_HTTPHEADER => $headers));
$result             = json_decode($result, true); 
$result             = json_encode($result); 
print_r($result);
// foreach ($result['results'] as $company) {
//     echo $company . '<br>';
// }
// foreach ($result['results'] as $company) {
//     echo $company . '<br>'; 
// }
echo '<br><br>';

echo '<h1>Create Account</h1>';
$testCompanyName                    = urlencode('My Test Company'); 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.codat.io/companies/' . $companyID . '/connections?page=1&pageSize=100');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"name\": \"My Test Company\",\n}");

$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Authorization: Basic ' . $baseEncodeAPI;
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$result = json_decode($result, true);
print_r($result); 
// $headers            = array(
//     'accept: application/json',
//     'Authorization: Basic ' . $baseEncodeAPI . '',
// );
// $companyID          = '9d6fefef-e70b-47d1-9eb4-1b0fd9170888'; 
// $url                = 'https://api.codat.io/companies/' . $companyID . '/connections?page=1&pageSize=100';
// $options            = array(
//     'http'          => array(
//         'method'    => 'GET',
//         'header'    => implode("\r\n", $headers)
//     )
// );
// $context            = stream_context_create($options);
// $result             = file_get_contents($url, false, $context);
// $result             = json_encode($result); 
// print_r($result); 
?>
