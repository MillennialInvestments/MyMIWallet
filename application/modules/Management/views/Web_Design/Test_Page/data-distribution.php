<?php

print_r($_SESSION['allSessionData']['userAccount']);
echo '<br><br>';

// $cuID                                   = $_SESSION['allSessionData']['userAccount']['cuID'];
// $this->db->from('bf_exchanges_listing_request');
// $this->db->where('user_id', $cuID);
// $getAppInfo                             = $this->db->get()->result_array();
// if (empty($getAppInfo[0]['id'])) {
//     $open_listing_app                   = 0;
// } else {
//     $open_listing_app                   = $getAppInfo[0]['id'];
// }
// $userExchangeInfo                       = array(
//     'open_listing_app'                  => $open_listing_app,
// );
// if (isset($getAppInfo)) {
//     foreach($getAppInfo->result_array() as $appInfo) {
//         $open_listing_app               = $appInfo['id'];
//         $userExchangeInfo                       = array(
//             'open_listing_app'                  => $open_listing_app,
//         );
//         return $userExchangeInfo;
//     }
// } else {
//     $open_listing_app                       = 0;
//     $userExchangeInfo                       = array(
//         'open_listing_app'                  => $open_listing_app,
//     );
// }
// echo $open_listing_app . '<br><br>';
// print_r($userExchangeInfo);
    // $getUserAssetNetWorth           = $this->exchange_model->get_user_asset_net_worth($cuID)->result_array();
    // print_r($getUserAssetNetWorth[0]);
    // $getUserAssetCount                  = $this->exchange_model->get_user_asset_count($cuID);
    // if (!isset($getUserAssetCount)) {
    //     $userAssetSummary               = array(
    //         'assetTotalCount'           => 0,
    //         'assetNetValue'             => 0,
    //         'assetTotalGains'           => 0,
    //     );
    // } else {
    //     $assetTotalCount                = $getUserAssetCount->num_rows();
    //     if (empty($getUserAssetNetWorth)) {
    //         $assetNetValue              = 0;
    //     } else {
    //         $assetNetValue              = $getUserAssetNetWorth['current_value'];
    //     }
    //     $getUserAssetInfo               = $this->exchange_model->get_user_asset_info($cuID)->result_array();
    //     if (empty($getUserAssetInfo)) {
    //         $assetTotalGains            = 0;
    //     } else {
    //         $assetTotalGains            = $getUserAssetInfo[0]['current_value'] - $getUserAssetInfo[0]['initial_value'];
    //     }
    //     $userAssetSummary               = array(
    //         'assetTotalCount'           => $assetTotalCount,
    //         'assetNetValue'             => $assetNetValue,
    //         'assetTotalGains'           => number_format($assetTotalGains,2),
    //     );
    // }
    // print_r($userAssetSummary);

// $this->db->from('bf_users_coin_purchases');
// $this->db->limit(1);
// $this->db->order_by('id', 'DESC');
// // $this->db->where('user_id', $cuID);
// $this->db->where('coin', 'MYMIG');
// $this->db->where('status', 'Incomplete');
// $getUserLastOrder						= $this->db->get();
// if (!empty($getUserLastOrder)) {
//     foreach($getUserLastOrder->result_array() as $lastOrder) {
//         $orderID							= $lastOrder['id'];
//         $unix_timestamp                     = $lastOrder['unix_timestamp'];
//         $current_date                       = $lastOrder['current_date'];
//         $month                              = $lastOrder['month'];
//         $day                                = $lastOrder['day'];
//         $year                               = $lastOrder['year'];
//         $time                               = $lastOrder['time'];
//         $status                             = $lastOrder['status'];
//         $beta                               = $lastOrder['beta'];
//         $wallet_id                          = $lastOrder['wallet_id'];
//         $user_id                            = $lastOrder['user_id'];
//         $user_email                         = $lastOrder['user_email'];
//         $reward                             = $lastOrder['reward'];
//         $reward_type                        = $lastOrder['reward_type'];
//         $coin                               = $lastOrder['coin'];
//         $initial_value                      = $lastOrder['initial_value'];
//         $current_value                      = $lastOrder['current_value'];
//         $available_coins                    = $lastOrder['available_coins'];
//         $new_availability                   = $lastOrder['new_availability'];
//         $minimum_coin_amount                = $lastOrder['minimum_coin_amount'];
//         $initial_coin_value                 = $lastOrder['initial_coin_value'];
//         $new_coin_value                     = $lastOrder['new_coin_value'];
//         $amount                             = $lastOrder['amount'];
//         $total                              = $lastOrder['total'];
//         $total_cost                         = $lastOrder['total_cost'];
//         $total_fees                         = $lastOrder['total_fees'];
//         $gas_fee                            = $lastOrder['gas_fee'];
//         $trans_fee                          = $lastOrder['trans_fee'];
//         $trans_percent                      = $lastOrder['trans_percent'];
//         $user_gas_fee                       = $lastOrder['user_gas_fee'];
//         $user_trans_fee                     = $lastOrder['user_trans_fee'];
//         $user_trans_percent                 = $lastOrder['user_trans_percent'];
//         $referral_id                        = $lastOrder['referral_id'];
//         $userLastOrder							= array(
//             'orderID'							=> $orderID,
//             'unix_timestamp'					=> $unix_timestamp,
//             'current_date'						=> $current_date,
//             'month'						    	=> $month,
//             'day'						    	=> $day,
//             'year'						    	=> $year,
//             'time'						    	=> $time,
//             'status'							=> $status,
//             'beta'						    	=> $beta,
//             'wallet_id'							=> $wallet_id,
//             'user_id'							=> $user_id,
//             'user_email'						=> $user_email,
//             'reward'							=> $reward,
//             'reward_type'						=> $reward_type,
//             'coin'							    => $coin,
//             'initial_value'						=> $initial_value,
//             'current_value'						=> $current_value,
//             'available_coins'					=> $available_coins,
//             'new_availability'					=> $new_availability,
//             'minimum_coin_amount'				=> $minimum_coin_amount,
//             'initial_coin_value'				=> $initial_coin_value,
//             'new_coin_value'					=> $new_coin_value,
//             'amount'							=> $amount,
//             'total'							    => $total,
//             'total_cost'						=> $total_cost,
//             'total_fees'						=> $total_fees,
//             'gas_fee'							=> $gas_fee,
//             'trans_fee'							=> $trans_fee,
//             'trans_percent'						=> $trans_percent,
//             'user_gas_fee'						=> $user_gas_fee,
//             'user_trans_fee'					=> $user_trans_fee,
//             'user_trans_percent'				=> $user_trans_percent,
//             'referral_id'						=> $referral_id,
//         );
//         print_r($userLastOrder);
//     };
// }
// ~ User Default Data
// echo '<h4>User Default Data ($userAccountInfo)</h4>';
// print_r($userAccountInfo);
// echo '<br><br>';
//~ //                 $getUserDefaultWallet                                   = $this->wallet_model->get_user_default_wallet($cuID)->result_array();
//~ //                 print_r($getUserDefaultWallet);
//~ echo '<h4>User Default Data ($userInfo)</h4>';
//~ print_r($userInfo);
//~ echo '<br><br>';

//~ User All Data
// echo '<h4>User All Data (userAllData)</h4>';
// print_r($userAllData);
// echo '<br><br>';

//~ User Ex.change Data
// echo '<h4>User Exchange Info (userExchangeInfo)</h4>';
// print_r($userExchangeInfo);
// echo '<br><br>';
        
//~ User Default Wallet Data
//~ echo '<h4>User Default Wallet (userDefaultWalletInfo)</h4>';
//~ print_r($userDefaultWalletInfo);
//~ echo '<br><br>';
                 
//~ User MyMI Coin Data
//~ echo '<h4>User Coin Data (userCoinData)</h4>';
//~ print_r($userCoinData);
//~ echo '<br><br>';
       
//~ User MyMI Gold Data
//~ echo '<h4>User Gold Data (userGoldData)</h4>';
//~ print_r($userGoldData);
//~ echo '<br><br>';
       
//~ User Wallet Data/Info
//~ echo '<h4>User Default Wallet Details/Info (userDefaultWalletInfo)</h4>';
//~ print_r($userDefaultWalletInfo);
//~ echo '<br><br>';
       
//~ User Last Activity
//~ echo '<h4>User Last Activity (userLastActivity)</h4>';
//~ print_r($userLastActivity);
//~ echo '<br><br>';
        
//~ MyMI Coin Data
//				echo '<h4>MyMI Coin Data (MyMICoinData)</h4>';
//				print_r($MyMICoinData);
//				echo '<br><br>';
        
//~ MyMI Gold Data
//~ echo '<h4>MyMI Gold Data (MyMIGoldData)</h4>';
//~ print_r($MyMIGoldData);
//~ echo '<br><br>';
        
//~ MyMI Wallet Data
//~ echo '<h4>MyMI Wallet Data (myMIWalletSummary)</h4>';
//~ print_r($myMIWalletSummary);
//~ echo '<br><br>';
        
//~ User-Defined Wallet Data
//~ echo '<h4>User-Defined Wallet Data (userWalletOpenSummary)</h4>';
//~ print_r($userWalletOpenSummary);
//~ echo '<br><br>';

//~ User-Defined Wallet Total Summary Data
//~ echo '<h4>User-Defined Wallet Total Summary (userWalletTotalSummary)</h4>';
//~ print_r($userWalletTotalSummary);
//~ echo '<br><br>';

//~ $date		= date("j M y");
//~ echo strtoupper($date) . '<br>';
//~ $newDate	= date("Y-m-d", strtotime($date));
//~ echo $newDate;

//~ $getWalletTotals	= $this->mymiwallet->get_wallet_totals($cuID);
//~ print_r($getWalletTotals);

//~ $getLastTradeActivity				= $this->CI->tracker_model->get_last_trade_info_by_user($cuID)->result_array();
//~ if (!empty($getLastTradeActivity)) {
    //~ $lastTradeActivity				= $getLastTradeActivity[0]['submitted_date'] . ' - ' . $getLastTradeActivity[0]['submitted_time'];
//~ } else {
    //~ $lastTradeActivity				= 'N/A';
//~ }
//~ // Get Last Deposit Activity
//~ $getLastDepositActivity				= $this->CI->wallet_model->get_last_wallet_deposit($cuID, $walletID)->result_array();
//~ $depositDate						= $getLastDepositActivity[0]['submitted_date'];
//~ $convertedDepositDate				= strtotime($depositDate);
//~ $lastDepositActivity				= date('F jS, Y', $convertedDepositDate) . ' - ' . $getLastDepositActivity[0]['time'];
//~ if (!empty($getLastDepositActivity[0]['time'])) {
    //~ $depositActivity				= $lastDepositActivity;
//~ } else {
    //~ $depositActivity				= 'N/A';
//~ }
//~ // Get Last Withdraw Activity
//~ $getlastWithdrawActivity			= $this->CI->wallet_model->get_last_wallet_withdraw($cuID, $walletID)->result_array();
//~ $withdrawDate						= $lastWithdrawActivity[0]['submitted_date'];
//~ $convertedWithdrawDate				= strtotime($withdrawDate);
//~ $lastWithdrawActivity				= date('F jS, Y', $convertedWithdrawDate) . ' - ' . $getLastWithdrawActivity[0]['time'];
//~ if (!empty($getLastWithdrawActivity[0]['time'])) {
    //~ $withdrawActivity				= $lastWithdrawActivity;
//~ } else {
    //~ $withdrawActivity				= 'N/A';
//~ }
//~ print_r($getLastTradeActivity);
//~ echo $lastTradeActivity;

//				echo '<h4>Exchange Orders</h4><br>';
//				$market_pair		= 'USD';
//				$market				= 'MYMI';
//				$getAllOpenOrders	= $this->exchange_model->get_all_open_orders($market_pair, $market);
//				$getOrdersJSON		= json_encode($getAllOpenOrders);
//				print_r($getOrdersJSON);
//
//				echo '<h4>User Default Wallet - Model Query</h4><br>';
//				$getUserDefaultWallet				= $this->wallet_model->get_user_default_wallet($cuID)->result_array();
//				print_r($getUserDefaultWallet);
