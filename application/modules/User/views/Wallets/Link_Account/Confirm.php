<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$client                                         = new \GuzzleHttp\Client();
$errorClass                                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                                   = empty($controlClass) ? 'span6' : $controlClass;
$walletType                                     = $this->uri->segment(2);
$fieldData = array(
    'errorClass'                                => $errorClass,
    'controlClass'                              => $controlClass,
    'walletType'	                            => $walletType,
);

$cuID 					                        = isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				                        = isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuUsername 			                        = isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$beta                                           = $this->config->item('beta');
if ($beta === 1) {
    $beta                                       = 'Yes';
} else {
    $beta                                       = 'No';
}
$cuRealizeID                                    = $_SESSION['allSessionData']['userAccount']['cuRealizeID']; 
// $cuBroker                                       = $_SESSION['allSessionData']['userAccount']['cuBroker'];
$response = $client->request('GET', 'https://www.realizefi.com/api/users/' . $cuRealizeID, [
    'headers' => [
      'Accept' => 'application/json',
      'Authorization' => 'Bearer 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',
    ],
  ]);
$userData                                       = array(); 
$userData                                       = json_decode($response->getBody(),true); 
// print_r($userData); 
// echo '<br><br>'; 
$institutionLinks                               = json_encode($userData['institutionLinks']);
$institutionLinks                               = json_decode($institutionLinks, true);
print_r($institutionLinks); 
foreach ($institutionLinks as $instituteInfo) {
    print_r($instituteInfo); 
    echo '<br><br>';
    echo '<h1>Account Info</h1>';
    $institute_id                               = $instituteInfo['id'];
    $institute                                  = $instituteInfo['institution']; 
    $institute_account                          = $instituteInfo['accountNumber'];  
    // echo '<br>' . $institute_id . '<br>'; 
    // echo $institute . '<br>'; 
    // echo $institute_account . '<br>'; 
    $this->db->from('bf_users_wallet');
    $this->db->where('account_id', $institute_account); 
    $getInstitutes                              = $this->db->get(); 
    print_r($getInstitutes->result_array()); 
    if (empty($getInstitutes->result_array())) {
        $userData                               = array(
            'premium_wallet'                    => 'Yes',
            'user_id'                           => $cuID,
            'user_email'                        => $cuEmail,
            'username'                          => $cuUsername,
            'broker_id'                         => $institute_id,
            'broker'                            => $institute,
            'account_id'                        => $institute_account,
        );
        return $this->db->insert('bf_users_wallet', $userData); 
    } 
    $tradeResponse                              = $client->request('GET', 'https://www.realizefi.com/api/institution_links/' . $institute_id . '/orders?status=ALL', [
        'headers'                               => [
          'Accept'                              => 'application/json',
          'Authorization'                       => 'Bearer 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',
        ],
    ]);
    $userTradeData                              = json_decode($tradeResponse->getBody(), true); 
    $userTradeCount                             = count($userTradeData['data']);
    // echo '<br>'; 
    // print_r($userTradeData['data']); 
    // echo '<br>';  
    // echo $userTradeCount; 
    // echo '<br>'; 
    $userTradeDataEnc                           = json_encode($userTradeData['data'], JSON_PRETTY_PRINT);
    // echo '<br>'; 
    // print_r($userTradeDataEnc); 
    // echo '<br>';  
    $userTradeData                              = json_decode($userTradeDataEnc, true); 
    foreach ($userTradeData as $tradeData) {
        print_r($tradeData['security']);
        // if ($tradeData['security']['type'] === 'DERIVATIVE') {

        // } elseif ($tradeData['security']['security'] === '')
        // if (!empty($tradeData['contractType'])) {
        //     if ($tradeData['contractType'] === 'CALL' OR 'PUT') {
        //         echo '<br><br>';
        //         echo '<strong>Trade ID</strong>: ' . $tradeData['id'] . '<br>';
        //         echo '<strong>Quantity</strong>: ' . $tradeData['filledQuantity'] . '<br>';
        //         echo '<strong>Strike</strong>: ' . $tradeData['strikePrice'] . '<br>';
        //         echo '<strong>Option Type</strong>: ' . $tradeData['contractType'] . '<br>';
        //         echo '<strong>Expiration</strong>: ' . $tradeData['expiration'] . '<br>';
        //         echo '<br><br>';
        //     }
        // } else {
        //     echo '<br><br>';
        //     echo '<strong>Trade ID</strong>: ' . $tradeData['id'] . '<br>';
        //     echo '<strong>Quantity</strong>: ' . $tradeData['filledQuantity'] . '<br>';
        //     echo '<br><br>';
        // }


        // /// WORKING CODE BELOW
        // echo '<br><br>';
        // echo '<strong>Trade ID</strong>: ' . $tradeData['id'] . '<br>';
        // echo '<strong>Quantity</strong>: ' . $tradeData['filledQuantity'] . '<br>';
        // echo '<strong>Trade Type</strong>: ' . $tradeData['type'] . '<br>';
        // echo '<strong>Side</strong>: ' . $tradeData['side'] . '<br>';
        // echo '<strong>Limit Price</strong>: ' . $tradeData['limitPrice'] . '<br>';
        // echo '<strong>Type</strong>: ' . $tradeData['security']['type'] . '<br>';
        // echo '<strong>Symbol</strong>: ' . $tradeData['security']['symbol'] . '<br>';
        // echo '<strong>Strike Price</strong>: ' . $tradeData['security']['strikePrice'] . '<br>';
        // echo '<strong>Expiration</strong>: ' . $tradeData['security']['expiration'] . '<br>';
        // echo '<strong>Contract Type</strong>: ' . $tradeData['security']['contractType'] . '<br>';
        // // echo '<strong>Strike</strong>: ' . $tradeData['strikePrice'] . '<br>';
        // // echo '<strong>Option Type</strong>: ' . $tradeData['contractType'] . '<br>';
        // // echo '<strong>Expiration</strong>: ' . $tradeData['expiration'] . '<br>';
        // echo '<br><br>';
    }

    // return $this->db->insert('bf_users_wallet', $userData);
}
// $id                         = $id;
echo '
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-12 mb-3">  
            <div class="nk-wgw-inner">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-12">
                        <div class="card card-full">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Account Details &amp; Overview</h6>
                                    </div>
                                    <!--
                                    <div class="card-tools">
                                        <ul class="card-tools-nav">
                                            <li class="active"><a href="#"><span>All</span></a></li>
                                        </ul>
                                    </div>
                                    -->
                                </div>
                            </div>
                            <ul class="nk-activity">';
                            foreach ($institutionLinks as $instituteInfo) {
                                $institute_id                               = $instituteInfo['id'];
                                $institute                                  = $instituteInfo['institution']; 
                                if ($institute === 'TD') {
                                    $institute_name                         = 'TD Ameritrade';
                                    $accountType                            = 'Fiat Wallet'; 
                                } else {
                                    $institute_name                         = $institute;
                                }
                                $institute_account                          = $instituteInfo['accountNumber'];  
                                $tradeResponse = $client->request('GET', 'https://www.realizefi.com/api/institution_links/' . $institute_id . '/orders?status=ALL', [
                                    'headers' => [
                                      'Accept' => 'application/json',
                                      'Authorization' => 'Bearer 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',
                                    ],
                                ]);
                                $userTradeData                              = json_decode($tradeResponse->getBody(), true); 
                                $userTradeCount                             = count($userTradeData['data']);
                                echo '         
                                <div class="kanban-item">
                                    <div class="kanban-item-title">
                                        <h6 class="title">' . $institute_name . ' - ' . $institute_account . '</h6>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <div class="user-avatar-group">
                                                    <a class="btn btn-primary btn-sm text-white" href="' . site_url('Wallets/Link-Account/Details/' . $institute_id) . '">Manage</a>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr p-3 g-2">
                                                    <li>
                                                        <div class="user-card">
                                                            <div class="user-avatar sm bg-danger">
                                                                <span>VL</span>                                
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Victoria Lynch</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kanban-item-text">
                                        <p><strong>Total Trades:</strong> ' . $userTradeCount . '</p>
                                    </div>
                                    <ul class="kanban-item-tags">
                                        <li><span class="badge badge-dark">' . $accountType . '</span></li>
                                        <li><span class="badge badge-success">' . $institute_name . '</span></li>
                                    </ul>
                                    <!--
                                    <div class="kanban-item-meta">
                                        <ul class="kanban-item-meta-list">
                                            <li><em class="icon ni ni-calendar"></em><span>02 Jan 2021</span></li>
                                            <li><em class="icon ni ni-notes"></em><span>Recharch</span></li>
                                        </ul>
                                        <ul class="kanban-item-meta-list">
                                            <li><em class="icon ni ni-clip"></em><span>31</span></li>
                                            <li><em class="icon ni ni-comments"></em><span>21</span></li>
                                        </ul>
                                    </div>
                                    -->        
                                </div>
                                ';                            
                                // return $this->db->insert('bf_users_wallet', $userData);
                            }
                            echo '
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
?>

