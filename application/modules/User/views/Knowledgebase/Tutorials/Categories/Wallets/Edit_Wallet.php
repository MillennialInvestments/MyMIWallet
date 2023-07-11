<?php
$beta                           = $this->config->item('beta');
$walletID					    = $this->uri->segment(3);
// $userAccount                    = $_SESSION['allSessionData']['userAccount'];
// $cuID                           = $userAccount['cuID'];
$getWalletInfo				    = $this->mymiwallet->get_wallet_info($cuID, $walletID);
$walletInitial				    = isset($getWalletInfo['walletInitial']) && ! empty($getWalletInfo['walletInitial']) ? $getWalletInfo['walletInitial'] : '';
// Wallet Details
if (!empty($getWalletInfo['walletInitial'])) {
    $walletInitial			    = $getWalletInfo['walletInitial'];
} else {
    $walletInitial			    = '0.00';
}
if (!empty($getWalletInfo['walletInitialAmount'])) {
    $walletInitialAmount	    = number_format($getWalletInfo['walletInitialAmount'],2);
} else {
    $walletInitialAmount	    = '0.00';
}
if (!empty($getWalletInfo['depositAmount'])) {
    $depositAmount	            = number_format($getWalletInfo['depositAmount'],2);
} else {
    $depositAmount	            = '0.00';
}
if (!empty($getWalletInfo['withdrawAmount'])) {
    $withdrawAmount	            = number_format($getWalletInfo['withdrawAmount'],2);
} else {
    $withdrawAmount             = '0.00';
}
if (!empty($getWalletInfo['walletGains'])) {
    $walletGains	            = number_format($getWalletInfo['walletGains'],2);
} else {
    $walletGains	            = '0.00';
}
if (!empty($getWalletInfo['walletTotalAmount'])) {
    $accountBalance	            = number_format($getWalletInfo['walletTotalAmount'],2);
} else {
    $accountBalance	            = '0.00';
}


$getAllPercentChange		    = $this->tracker_model->get_all_percent_change($walletID);
foreach ($getAllPercentChange->result_array() as $walletTrades) {
    $percent_change			    = $walletTrades['closed_perc'];
    if ($percent_change === null) {
        $percentChange			= '<span">0%</span>';
    } elseif ($percent_change >= 0) {
        $percentChange			= '<span class="text-success">' . $percent_change . '%</span>';
    } else {
        $percentChange			= '<span class="text-danger">' . $percent_change . '%</span>';
    }
}

$getLastTradeByUser				= $this->tracker_model->get_last_trade_info_by_user($cuID);
foreach ($getLastTradeByUser->result_array() as $lastTradeByUser) {
    $lastTradeActivityDate		= $lastTradeByUser['submitted_date'];
}
// Get User Trades
$getTrades		                = $this->tracker_model->get_all_wallet_trades($walletID);

$getSymbols                     = $this->tracker_model->get_wallet_trades_openings($walletID);
$totalTrades                    = $getSymbols->num_rows();

$walletBroker                   = $getWalletInfo['walletBroker'];
$walletAccountID                = $getWalletInfo['walletAccountID'];
$walletAccessCode               = $getWalletInfo['walletAccessCode'];
$walletPremium                  = $getWalletInfo['walletPremium'];
$walletTitle		            = $getWalletInfo['walletTitle'];
$walletNickname 	            = $getWalletInfo['walletNickname'];
$walletDefault	                = $getWalletInfo['walletDefault'];
$walletExchange 		        = $getWalletInfo['walletExchange'];
$walletMarketPair               = $getWalletInfo['walletMarketPair'];
$walletMarket		            = $getWalletInfo['walletMarket'];
$accountInformation             = array(
    'walletID'                  => $walletID,
    'walletBroker'              => $walletBroker,
    'walletAccountID'           => $walletAccountID,
    'walletAccessCode'          => $walletAccessCode,
    'walletPremium'             => $walletPremium,
    'walletTitle'			    => $walletTitle,
    'walletNickname'		    => $walletNickname,
    'walletDefault'		        => $walletDefault,
    'walletExchange'			=> $walletExchange,
    'walletMarketPair'  	    => $walletMarketPair,
    'walletMarket'			    => $walletMarket,
    'walletGains'   		    => $walletGains,
    'accountBalance'		    => $accountBalance,
    'percentChange'             => $percentChange,
    'totalTrades'               => $totalTrades,
    'depositAmount'             => $depositAmount,
    'withdrawAmount'            => $withdrawAmount,
);
?>
<div class="nk-block">
    <div class="row g-gs">
        <?php $this->load->view('User/Wallets/Details/wallets', $accountInformation); ?>
        <?php 
        if ($beta === 1) {
        } else {
            
        }
        ?>
    </div>
</div>