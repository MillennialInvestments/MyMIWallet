<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$client = new \GuzzleHttp\Client();
$cuID                                           = $_SESSION['allSessionData']['userAccount']['cuID']; 
$cuEmail                                        = $_SESSION['allSessionData']['userAccount']['cuEmail']; 
$cuUsername                                     = $_SESSION['allSessionData']['userAccount']['cuUsername']; 
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
print_r($userData); 
echo '<br><br>'; 
$institutionLinks                               = json_encode($userData['institutionLinks']);
$institutionLinks                               = json_decode($institutionLinks, true);
foreach ($institutionLinks as $institute) {
    $institute_id                               = $institute['id'];
    $institute                                  = $institute['institution']; 
    $institute_account                          = $institute['accountNumber'];  

    $userData                                   = array(
        'premium_wallet'                        => 'Yes',
        'user_id'                               => $cuID,
        'user_email'                            => $cuEmail,
        'uesrname'                              => $username,
        'broker_id'                             => $institute_id,
        'broker'                                => $institute,
        'account_id'                            => $institute_account,
    );

    // return $this->db->insert('bf_users_wallet', $userData);
}
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
$getInactiveWallets                             = $this->wallet_model->get_inactive_wallets($cuID);
$success_data                                   = array(
    'success_note'                              => 'New Premium Wallet Created',
    // 'success_note'                              => 'New Premium Wallet Created<br/> Total Trades Accounted For: <strong>' . $total_trades . ' Trades</strong>',
    'success_link'                              => site_url('/Wallets'),
    'success_btn'                               => 'View My Wallets',
);
// $id                         = $id;
$this->load->view('User/Dashboard/index/success-noto', $success_data); 
echo '
<div class="nk-block">
    <!--
    <div class="row justify-content-center gy-gs">
        <div class="col-12 mb-3 text-center">
            <div class="nk-wgw-inner">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head-sm">
                        <div class="nk-block-head-content"><h5 class="nk-block-title title">Back to Overview</h5></div>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col">
                        <a class="btn btn-primary btn-sm" href="' . site_url('Wallets') . '">My Wallets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    -->
    <div class="row gy-gs">
        <div class="col-md-4 col-12 mb-3">  
            <div class="card card-bordered dashed">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Asset Creator</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Create your Digital Asset to allow institutional and retail investors to invest in your next investment opportunity or project. Gain access to unlocking the value in real-world assets and exchanging them in real time.</p>
                            <a class="btn btn-primary btn-md mt-3" href="' . site_url('Assets') . '">Visit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="col-md-4 col-12 mb-3">
            <div class="card card-bordered dashed">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Due Diligence</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Access community-based due diligence reports containing information regarding news &amp; updates to evaluate company financial histories and more detailed information to determine your next investment target.</p>
                            <a class="btn btn-primary btn-md mt-3" href="' . site_url('Exchange') . '">Visit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mb-3">
            <div class="card card-bordered dashed">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">My Wallets</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Access and manage your Trading Accounts with MyMI Wallets to add/edit/remove existing and new trading accounts to analyze your financial growth.<br><br></p>
                            <a class="btn btn-primary btn-md mt-3" href="' . site_url('Asset-Creator') . '">Create Assets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="col-md-4 col-12 mb-3">
            <div class="card card-bordered dashed">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">MyMI Exchange</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Access our Crypto Exchange and Digital Asset Marketplace to buy and sell your cryptocurrencies and invest in a variety of projects created by Millennial Investments and other members of our community.</p>
                            <a class="btn btn-primary btn-md mt-3" href="' . site_url('/Exchange') . '">Visit Exchange</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mb-3">
            <div class="card card-bordered dashed">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Trade Tracker</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Analyze and track your investments and portfolio holdings to determine the best strategies for maximizing your trades and profits. Access in-depth analytics to assist in making better trade decisions.</p>
                            <a class="btn btn-primary btn-md mt-3" href="' . site_url('/Trade-Tracker') . '">Track Trades</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
?>

