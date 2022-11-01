<?php
$redirect_url				        = $this->uri->uri_string();
$today						        = date('h:i A');
$cuID                               = $_SESSION['allSessionData']['userAccount']['cuID']; 
$cuEmail                            = $_SESSION['allSessionData']['userAccount']['cuEmail']; 
$cuUsername                         = $_SESSION['allSessionData']['userAccount']['cuUsername']; 
$pageAccountType                    = $this->uri->segment(1);
if ($pageAccountType === 'Bank-Account') {
    $accountID                      = $this->uri->segment(3);
    // $getBankAccountInfo             = $this->wallet_model->get_bank_account_information($accountID); 
    $this->db->from('bf_users_bank_accounts'); 
    $this->db->where('id', $accountID);
    $getBankAccountInfo             = $this->db->get();
    foreach ($getBankAccountInfo->result_array() as $bankInfo) {
        $accountType                = $bankInfo['account_type']; 
        $accountWalletID            = $bankInfo['wallet_id']; 
        $accountBankName            = $bankInfo['bank_name'];
        if (!empty($bankInfo['nickname'])) {
            $accountName            = $bankInfo['nickname'];
            $accountTitle           = $accountBankName . ' - ' . $accountName;
        } else {
            $accountName            = '';
            $accountTitle           = $accountName;
        }
        $accountRouting             = $bankInfo['routing_number'];
        $accountNumber              = $bankInfo['account_number']; 
        $accountBalance             = $bankInfo['balance']; 
    }
    $accountInformation             = array(
        'accountID'                 => $accountID,
        'accountType'               => $accountType,
        'accountWalletID'           => $accountWalletID,
        'accountBankName'           => $accountBankName,
        'accountName'               => $accountName,
        'accountTitle'              => $accountTitle,
        'accountRouting'            => $accountRouting,
        'accountNumber'             => $accountNumber,
        'accountBalance'            => $accountBalance,
    );
    $this->load->view('User/Wallets/Details/bank_accounts', $accountInformation);
} elseif ($pageAccountType === 'Wallet') {
    $walletID					    = $this->uri->segment(3);
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
    $this->load->view('User/Wallets/Details/wallets', $accountInformation); 
}

?>
