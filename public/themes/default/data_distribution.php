<?php
<<<<<<< HEAD
    // $this->load->library('MyMIAnalytics'); 
    $reporting                      = $this->mymianalytics->reporting();
    // $marketing                      = $this->mymimarketing->marketing(); 
if (!empty($_SESSION['userAccount']['cuID'])) {
    // $this->load->library('MyMIAnalytics'); 
=======
    $this->load->library('MyMIAnalytics'); 
    $reporting                      = $this->mymianalytics->reporting();
if (!empty($_SESSION['userAccount']['cuID'])) {
    $this->load->library('MyMIAnalytics'); 
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    if (!empty($_SESSION['user_id'])) {
        $cuID 					    = $_SESSION['user_id'];
    } else {
        $cuID                       = $this->input->ip_address();
<<<<<<< HEAD
        $_SESSION['user_id']        = $cuID;
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }
    $betaStatus                     = $this->config->item('beta');
    if ($betaStatus === 0) {
        $beta                       = 'No';
    } else {
        $beta                       = 'Yes';
    }
    $thisController                 = $this->router->fetch_class();
    $thisMethod                     = $this->router->fetch_method();
    $thisURL                        = $this->uri->uri_string();
<<<<<<< HEAD
    $thisFullURL                    = current_url();
=======
    $thisFullURL                    = $this->uri->current_url();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    $thisComment                    = 'User (' . $cuID . ') successfully viewed the following page: ' . $thisURL;
    $this->mymilogger
        ->user($cuID) //Set UserID, who created this  Action
        ->beta($beta) //Set whether in Beta or nto
        ->type('Page Visit') //Entry type like, Post, Page, Entry
        ->controller($thisController)
        ->method($thisMethod)
        ->url($thisURL)
        ->full_url($thisFullURL)
        ->comment($thisComment) //Token identify Action
        ->log(); //Add Database Entry
<<<<<<< HEAD
    $userDefaultAccount             = $this->mymiuser->user_default_account_info(); 
=======
    $allSessionData                 = array();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    $userAccount	        		= $this->mymiuser->user_account_info($cuID);
    $walletID                       = $userAccount['walletID'];
    // print_r($userAccount);
    // Template::set('userAccountInfo', $userAccountInfo);
    // $userInfo               		= $this->mymiuser->get_user_information($cuID);
    // Template::set('userInfo', $userInfo);
    $userCoinData					= $this->mymicoin->get_user_coin_total($cuID);
    $userGoldData					= $this->mymigold->get_user_coin_total($cuID);
    $userDefaultWalletInfo			= $this->mymiwallet->get_default_wallet_info($cuID, $walletID);
    $userLastActivity				= $this->mymiwallet->get_last_activity($cuID, $walletID);
    $MyMICoinData					= $this->mymicoin->get_coin_info();
    $MyMIGoldData					= $this->mymigold->get_coin_info();
    $myMIWalletSummary				= $this->mymiwallet->get_wallet_totals($cuID);
    $userWalletOpenSummary			= $this->mymiwallet->get_total_open_value($cuID);
    $userWalletTotalSummary			= $this->mymiwallet->get_total_wallet_value($cuID);
    $getUserAssetCount              = $this->exchange_model->get_user_asset_count($cuID);
<<<<<<< HEAD
    $userFlashData                  = array(
        'cuID'                      => $cuID, 
        'beta'                      => $beta,
        'walletID'                  => $walletID,
        'date'                      => $date,
        'hostTime'                  => $hostTime,
        'time'                      => $time,
    ); 
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    if ($pageURIA === 'Exchange' and $pageURIB === 'Market') {
        $exchangeMarketData			= $this->mymiexchange->get_market_summaries($pageURIC, $pageURID);
    } else {
        $exchangeMarketData         = array();
    }
    if ($pageURIA === 'MyMI-Gold' || $pageURIB === 'Complete-Purchase') {
        $userLastOrder			    = $this->mymigold->get_user_last_order($cuID);
        $userLastCompletedOrder     = $this->mymigold->get_user_last_completed_order($cuID);
    } elseif ($pageURIA === 'MyMI-Gold' || $pageURIB === 'Purchase-Complete') {
        $userLastOrder			    = $this->mymigold->get_user_last_order($cuID);
        $userLastCompletedOrder     = $this->mymigold->get_user_last_completed_order($cuID);
    } elseif ($pageURIA === 'Dashboard' or $pageURIA === 'Wallets' or $pageURIA === 'Test-Page') {
        $userLastOrder			    = $this->mymigold->get_user_last_order($cuID);
        $userLastCompletedOrder     = $this->mymigold->get_user_last_completed_order($cuID);
    } else {
        $userLastOrder              = array();
        $userLastCompletedOrder     = array();
    }
    // $userExchangeInfo				= $this->mymiuser->get_user_exchange_info($cuID);
<<<<<<< HEAD
    $_SESSION['allSessionData']     = array();  
    $allSessionData					= array(
        'userFlashData'             => $userFlashData,
=======
    $allSessionData					= array(
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        'userAccount'				=> $userAccount,
        // 'userInfo'					=> $userInfo,
        'userCoinData'				=> $userCoinData,
        'userGoldData'				=> $userGoldData,
        'userDefaultWalletInfo'		=> $userDefaultWalletInfo,
        'userLastActivity'			=> $userLastActivity,
        'MyMICoinData'				=> $MyMICoinData,
        'MyMIGoldData'				=> $MyMIGoldData,
        'myMIWalletSummary'			=> $myMIWalletSummary,
        'userWalletOpenSummary'		=> $userWalletOpenSummary,
        'userWalletTotalSummary'	=> $userWalletTotalSummary,
        'exchangeMarketData'		=> $exchangeMarketData,
        'userLastOrder'			    => $userLastOrder,
        'userLastCompletedOrder'    => $userLastCompletedOrder,
        // 'userExchangeInfo'			=> $userExchangeInfo,
<<<<<<< HEAD
        'reporting'                 => $reporting
    );
    print_r($allSessionData);
    $_SESSION['allSessionData']	 	= $allSessionData;
    // $_SESSION['reporting']	 	    = $reporting;
}
?>
=======
        'reporting'                 => $reporting,
    );

    $_SESSION['allSessionData']	 	= $allSessionData;
    $_SESSION['reporting']	 	    = $reporting;
}
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
