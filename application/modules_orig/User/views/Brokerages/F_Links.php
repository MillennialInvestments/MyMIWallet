<?php
$userAccount                                    = $_SESSION['allSessionData']['userAccount'];
$cuID                                           = $userAccount['cuID'];
$cuEmail                                        = $userAccount['cuEmail'];
$cuUsername                                     = $userAccount['cuUsername'];
$cuWalletID                                     = $userAccount['cuWalletID'];
$betaConfig                                     = $this->config->item('beta');
if ($betaConfig === 1) {
    $beta                                       = 'Yes';
} else {
    $beta                                       = 'No'; 
};
// Set Brokerage
$broker                                         = 'F Links';
// Begin TD Ameritrade Process

// Capture ID (Most Likely "1") from URL
// $id                                             = $this->uri->segment(4);
// Pull "loginID" && "institution" from URL Query Parameters
$loginId                                        = $this->input->get('loginId');
$institution                                    = $this->input->get('institution');
echo $loginId . '<br><br>' . $institution; 

// Set New Wallet Account Configuration Array to Send to DB
$userAccountInfo                            = array(
    'date'                                  => date("m-d-Y"),
    'time'                                  => date("H:i:s a"),
    'user_id'                               => $cuID, 
    'user_email'                            => $cuEmail,
    'wallet_id'                             => $cuWalletID,
    'fl_loginId'                            => $loginId,
    'fl_institution_id'                     => $institution,
);
echo '<br><br>'; 
echo '$userAccountInfo';
echo '<br>';
print_r($userAccountInfo); 
echo '<br><br>'; 
// print_r($userAccountInfo); 

// Example URL: 
// https://www.mymiwallet.com/dev/public/index.php/Link-Account/F-Links/1?loginId=7fcf3af5-60f7-4bea-358e-08dad08e7aac&accountId=0c3e8b01-9ff1-4fcf-abfa-9f90f8787bb7%2C40fe334c-9333-4ad5-9fe4-bcd7ddbc4955%2Cef09758c-8557-45cf-a221-be3dfe7ea451%2C09b34ed4-f880-41ac-9d62-e0906e0188ee%2C43b04959-a41b-4c96-b195-fb33450eaf55&institution=175010

// Initial Session w/ Flinks API
// https://docs.flinks.com/docs/make-api-calls
/*
curl -X POST \
  https://toolbox-api.private.fin.ag/v3/43387ca6-0391-4c82-857d-70d95f087ecb/BankingServices/Authorize \
  -H 'Content-Type: application/json' \
  -d '{
    "LoginId":"5e115eac-1209-4f19-641c-08d6d484e2fe",
    "MostRecentCached":true
}'
{
    "Links": [...],
    "HttpStatusCode": 200,
    "Login": {
        "Username": "Greatday",
        "IsScheduledRefresh": false,
        "LastRefresh": "2019-05-09T13:47:46.5227901",
        "Type": "Personal",
        "Id": "5e115eac-1209-4f19-641c-08d6d484e2fe"
    },
    "Institution": "FlinksCapital",
    "RequestId": "1243c283-e0ca-4fda-a5e4-343068430190"
}
*/
// // Temporary Custom $loginId to test with when necessary or override automated $loginId pulled from URL
// $loginId                                        = '623dc52a-f654-48fa-bca5-f3e515564a3b';
$testEnv                                            = 'toolbox';
$prodEnv                                            = 'mymiwallet';
$thisEnv                                            = $testEnv;
if ($thisEnv === 'toolbox') {
    $loginId                                        = '80e42fa3-2a66-4300-1a6e-08d8f5f1ac9d';
}
$curl = curl_init();
$authorizeURL                                       = 'https://' . $thisEnv . '-api.private.fin.ag/v3/' . $loginId . '/BankingServices/Authorize';
curl_setopt_array($curl, [
  CURLOPT_URL => $authorizeURL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"MostRecentCached\":true,\"Save\":true,\"ScheduleRefresh\":false}",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "content-type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
print_r($response); 
//Requesting Ready-to-Deliver Data
/*
curl -X POST \
  https://toolbox-api.private.fin.ag/v3/43387ca6-0391-4c82-857d-70d95f087ecb/BankingServices/GetAccountsDetail \
  -H 'Content-Type: application/json' \
  -d '{
    "RequestId":"1243c283-e0ca-4fda-a5e4-343068430190"
}'
*/

// Request Pending-to-Deliver Data
/* 
curl -X GET \
  https://toolbox-api.private.fin.ag/v3/43387ca6-0391-4c82-857d-70d95f087ecb/BankingServices/GetAccountsDetailAsync/1243c283-e0ca-4fda-a5e4-343068430190 \
  -H 'Content-Type: application/json'
*/

// To go into production 
/*
https://docs.flinks.com/docs/go-to-production
*/

// Get User Bank Accounts to check if loginID exist
$this->db->from('bf_users_bank_accounts'); 
$this->db->where('user_id', $cuID); 
$getUserExistingAccounts                        = $this->db->get(); 
// print_r($getUserExistingAccounts->result_array()); 
if (empty($getUserExistingAccounts)) {
    return $this->db->insert('bf_users_bank_accounts', $userAccountInfo); 
    echo '<br><br>';
    echo '$getUser is Empty';
} else {
    foreach ($getUserExistingAccounts->result_array() as $userAccount) {
        if ($userAccount['fl_loginId'] === $loginId) {
            echo '<br><br>';
            echo '$loginId matches fl_loginId';
            $this->db->where('fl_loginId', $loginId); 
            return $this->db->update('bf_users_bank_accounts', $userAccountInfo); 
        } else {
            echo '<br><br>';
            echo '$loginId does not matches fl_loginId';
            return $this->db->insert('bf_users_bank_accounts', $userAccountInfo); 
        }
    }
    echo '<br><br>';
    echo '$getUser is Not Empty by the way...';
}
print_r($getUserExistingAccounts); 
echo '<br><br>'; 
print_r($userAccountInfo); 
?>