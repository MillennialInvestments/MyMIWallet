<?php
// Get Page Info
$pageType 						= Template::get('pageType');
$pageName 						= Template::get('pageName');
// $this->load->model('Management/Marketing_model'); 
// $pageSEOData                    = $this->marketing_model->get_marketing_page_seo_by_name($pageName); 
// Get User Info
$cuID 							= $_SESSION['user_id'];
$thisController                 = $this->router->fetch_class();
$thisMethod                     = $this->router->fetch_method();
$thisURL                        = $this->uri->uri_string();
$thisComment                    = 'User (' . $cuID . ') successfully viewed the following page: ' . $thisURL;
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //S
     ->type('Page Visit') //Entry type like, Post, Page, Entry
     ->controller($thisController)
     ->method($thisMethod)
     ->url($thisURL)
     ->comment($thisComment) //Token identify Action
     ->log(); //Add Database Entry
$allSessionData                 = array();
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
$allSessionData					= array(
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
    // 'pageSEOData'               => $pageSEOData,
    // 'userExchangeInfo'			=> $userExchangeInfo,
);

$_SESSION['allSessionData']	 	= $allSessionData;
