<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIWallet
{
    private $cuID;
    private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library(array('users/Auth', 'MyMICoin', 'MyMIGold'));
        $this->ci->load->model(array('User/Investor_model', 'User/Tracker_model', 'User/Wallet_model'));
        //~ $this->ci->load->library(array('Auth', 'MyMIWallets'));
        $cuID 								                        = $this->ci->auth->user_id();
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     */
    public function get_default_wallet_info($cuID)
    {

        // User Default Wallet Information (Model)
        $getUserDefaultWallet                   		                = $this->ci->wallet_model->get_user_default_wallet($cuID);
        if (!empty($getUserDefaultWallet)) {
            foreach($getUserDefaultWallet->result_array() as $defaultWallet) {
                $walletID                               		            = $defaultWallet['id'];
                $walletBroker                           		            = $defaultWallet['broker'];
                $walletNickname                         		            = $defaultWallet['nickname'];
                $walletDefault                          		            = $defaultWallet['default_wallet'];
                $walletExchange                        		 	            = $defaultWallet['exchange_wallet'];
                $walletMarketPair                       		            = $defaultWallet['market_pair'];
                $walletMarket                           		            = $defaultWallet['market'];
                if ($defaultWallet['nickname'] !== null) {
                    $walletTitle                    		                = $defaultWallet['nickname'];
                } else {
                    $walletTitle                    		                = $defaultWallet['broker'] . ' - ' . $defaultWallet['nickname'];
                };

                // MyMI Coin Information
                $userCoinData                            		            = $this->ci->mymicoin->get_user_coin_total($cuID);
                $MyMICoinValue                          		            = $this->ci->mymicoin->get_coin_value();
                $MyMICCoinSum                           		            = $userCoinData['coinSum'];
                $MyMICCurrentValue                      		            = $MyMICoinValue * $MyMICCoinSum;
                if (!empty($userCoinData['myMICPerChange'])) {
                    $MyMICPercentChange                     	            = $userCoinData['myMICPerChange'];
                } else {
                    $MyMICPercentChange                                     = 0;
                }
                $coinsExchanged                         		            = $userCoinData['coinsExchanged'];

                // MyMI Gold Information
                $userGoldData                            		            = $this->ci->mymigold->get_user_coin_total($cuID);
                $MyMIGCoinSum                           		            = $userGoldData['coinSum'];
                $getMyMIGoldValue                          		            = $this->ci->mymigold->get_coin_value();
                if (!empty($getMyMIGoldValue)) {
                    $MyMIGoldValue					                        = $getMyMIGoldValue[0]['amount'];
                    $MyMIGCurrentValue                      	            = $MyMIGCoinSum;
                    if (!empty($userGoldData['myMIGPerChange'])) {
                        $MyMIGPercentChange                                 = $userGoldData['myMIGPerChange'];
                    } else {
                        $MyMIGPercentChange                                 = 0;
                    }
                } else {
                    $MyMIGCurrentValue				                        = 0;
                    $MyMIGPercentChange                     	            = 0;
                }
                
                // Get All User Wallets
                $getWallets						                            = $this->ci->wallet_model->get_all_wallets($cuID);
                $walletDepositAmount                    		            = 0;
                $walletWithdrawAmount                   		            = 0;
                if (!empty($getWallets)) {
                    $getWalletTrans                                         = $this->ci->wallet_model->get_all_transactions($cuID);
                    if (!empty($getWalletTrans)) {
                        foreach ($getWalletTrans->result_array() as $walletTrans) {
                            $transWalletID                                  = $walletTrans['wallet_id'];
                            $walletTransType                                = $walletTrans['trans_type'];
                            if ($transWalletID !== $walletID) {
                                if (!empty($walletTrans['amount'])) {
                                    // Set Initial Variables for Transaction Type Sums
                                    if ($walletTransType === 'Deposit') {
                                        $walletDepositAmount                += $walletTrans['amount'];
                                    } elseif ($walletTransType === 'Withdraw') {
                                        $walletWithdrawAmount               += $walletTrans['amount'];
                                    } else {
                                        $walletDepositAmount                = '0.00';
                                        $walletWithdrawAmount               = '0.00';
                                    }
                                }
                            }
                        }
                    }
                    $getWalletDeposits                                      = $this->ci->wallet_model->get_wallet_deposits($cuID, $walletID);
                    if (!empty($getWalletDeposits)) {
                        foreach ($getWalletDeposits->result_array() as $walletDeposits) {
                            $depositAmount                                  = $walletDeposits['amount'];
                        }
                    } else {
                        $depositAmount                                      = '0.00';
                    }
                    $getWalletWithdrawals                                   = $this->ci->wallet_model->get_wallet_withdrawals($cuID, $walletID);
                    if (!empty($getWalletWithdrawals)) {
                        foreach ($getWalletWithdrawals->result_array() as $walletWithdrawals) {
                            $withdrawAmount                                 = $walletWithdrawals['amount'];
                        }
                    } else {
                        $withdrawAmount                                     = '0.00';
                    }
                    $walletFunds                                            = $depositAmount - $withdrawAmount;
                    $getWalletTrades                                        = $this->ci->tracker_model->get_wallet_trades_net_gains($walletID);
                    if (!empty($getWalletTrades)) {
                        foreach ($getWalletTrades->result_array() as $walletTrades) {
                            if (!empty($walletTrades['net_gains'])) {
                                $walletGains                                = $walletTrades['net_gains'];
                            } else {
                                $walletGains                                = '0.00';
                            }
                        }
                    }
                }
                $walletInitialAmount                                        = $defaultWallet['amount'] + $depositAmount - $withdrawAmount;
                $walletAmount						                        = $defaultWallet['amount'] + $depositAmount - $withdrawAmount + $MyMICCurrentValue + $MyMIGCurrentValue + $walletGains;
                if ($walletAmount > 0) {
                    $walletPercentChange			                        = (($walletInitialAmount - $walletAmount) / $walletAmount) + $MyMICPercentChange;
                } else {
                    $walletPercentChange			                        = $MyMICPercentChange;
                }
            }
            $walletInitialAmount                                        = 0;
            $walletAmount                                               = 0;
            $userDefaultWalletInfo				                        = array(
                'walletID'					    	                    => $walletID,
                'walletTitle'				    	                    => $walletTitle,
                'walletBroker'					                        => $walletBroker,
                'walletNickname'				                        => $walletNickname,
                'walletDefault'					                        => $walletDefault,
                'walletExchange'				                        => $walletExchange,
                'walletMarketPair'				                        => $walletMarketPair,
                'walletMarket'					                        => $walletMarket,
                'walletInitialAmount'			                        => $walletInitialAmount,
                'walletAmount'					                        => $walletAmount,
                'walletPercentChange'			                        => $walletPercentChange,
                'walletGains'					                        => $walletGains,
                'walletFunds'				    	                    => $walletFunds,
                'depositAmount'					                        => $depositAmount,
                'withdrawAmount'			    	                    => $withdrawAmount,
                'walletDepositAmount'			                        => $walletDepositAmount,
                'walletWithdrawAmount'		                            => $walletWithdrawAmount,
                'MyMICoinValue'				    	                    => $MyMICoinValue,
                'MyMICCurrentValue'			            	            => $MyMICCurrentValue,
                'MyMICCoinSum'				            	            => $MyMICCoinSum,
                'coinsExchanged'			            	            => $coinsExchanged,
                'MyMIGoldValue'				            	            => $MyMIGoldValue,
                'MyMIGCurrentValue'			            	            => $MyMIGCurrentValue,
                'MyMIGCoinSum'				    	                    => $MyMIGCoinSum,
                'getWallets'                                            => $getWallets,
            );
            return $userDefaultWalletInfo;
        } else {
            $userDefaultWalletInfo                                      = array(); 
            return $userDefaultWalletInfo;
        }
    }

    public function get_total_wallet_value($cuID)
    {
        $defWalletInfo				    	                        = $this->ci->mymiwallet->get_default_wallet_info($cuID);
        $defWalletID				    	                        = $defWalletInfo['walletID'];
        // $defWalletAmount			    	= $defWalletInfo['walletFunds'];
        // $defWalletDepositAmount			    = $defWalletInfo['depositAmount'];
        // $defWalletWithdrawAmount	    	= $defWalletInfo['withdrawAmount'];
        // $defWalletPercentChange			    = $defWalletInfo['walletPercentChange'];
    }

//     public function get_total_wallet_value_old($cuID) {
//             $defWalletInfo					= $this->ci->mymiwallet->get_default_wallet_info($cuID);
//             $defWalletAmount					= $defWalletInfo['walletAmountND'];
//             $defWalletDepositAmount				= $defWalletInfo['depositAmount'];
//             $defWalletWithdrawAmount				= $defWalletInfo['withdrawAmount'];
//             $defWalletPercentChange				= $defWalletInfo['walletPercentChange'];
//             $userWalletOpenSummary       	    		= $this->ci->mymiwallet->get_total_open_value($cuID);
//             $userCoinData		         	 	= $this->ci->mymigold->get_user_coin_total($cuID);
//             $walletInitialAmount				= $userWalletOpenSummary['walletInitialAmount'];
//             $walletTotalAmount					= $userWalletOpenSummary['walletAmount'];
//             $depositAmount					= $userWalletOpenSummary['depositAmount'] + $defWalletDepositAmount;
//             $withdrawAmount					= $userWalletOpenSummary['withdrawAmount'] + $defWalletWithdrawAmount;
//             $walletGains					= $userWalletOpenSummary['walletGains'] + $userCoinData['myMIGDifferential'];
//             $walletPerChange					= $userWalletOpenSummary['walletPercentChange'];
//             if (!empty($walletGains) AND !empty($walletInitialAmount)) {
    // 		$walletPercentChange				= round(($walletGains / $walletInitialAmount) * 100 + $myMIGPerChange, 2);
    // 		if ($walletPercentChange >= 0) {
    // 			$walletPercentChangeOutput		= '<span class="text-success">' . $walletPercentChange . '%</span>';
    // 		} else {
    // 			$walletPercentChangeOutput		= '<span class="text-danger">' . $walletPercentChange . '%</span>';
    // 		}
//             } else {
//                 $walletPercentChange				= $myMIGPerChangeOutput;
//             }
//             $walletSum 						= $walletTotalAmount + $tradeSum + $depositAmount - $withdrawAmount + $myMIGCurrentValue + $defWalletAmount;
//             $walletSumOutput					= '$' . number_format($walletSum, 2);
//             $userWalletTotalSummary 				= array(
//                     'walletSum'					=> $walletSum,
//                     'walletSumOutput'				=> $walletSumOutput,
//                     'walletTotalAmount'				=> $walletTotalAmount,
//                     'walletGains'				=> $walletGains,
//                     'walletPercentChange'			=> $walletPercentChange,
//                     'depositAmount'				=> $depositAmount,
//                     'withdrawAmount'				=> $withdrawAmount,
//                     'myMIGCurrentValue'				=> $myMIGCurrentValue,
//             );

//             return $userWalletTotalSummary;
//     }

    public function get_wallet_totals($cuID)
    {
        $this->ci->load->library('MyMIGold');
        // $getUserCoinTotal					    = $this->ci->mymigold->get_user_coin_total($cuID);
        $getUserCoinTotal                                           = $this->ci->mymiuser->user_account_info($cuID);
        $totalValue						                            = $getUserCoinTotal['MyMIGoldValue'];
        $myMICCurrentValue					                        = $getUserCoinTotal['MyMICCurrentValue'];
        $myMIGCurrentValue					                        = $getUserCoinTotal['MyMIGCurrentValue'];
        $walletTotals 					                            = $this->ci->wallet_model->get_wallet_totals($cuID);
        if (empty($walletTotals)) {
            $walletSum 					                            = '$0.00';
            echo $walletSum;
        } else {
            foreach ($walletTotals->result_array() as $walletTotal) {
                $walletSum 				                            = $walletTotal['amount'] + $myMIGCurrentValue;
                $walletSum				                            = '$' . number_format($walletSum, 2);
            }
        }
        $myMIWalletSummary					                        = array(
                    'walletSum'					                    => $walletSum,
                    'totalValue'				                    => $totalValue,
                    'myMIGCurrentValue'				                => $myMIGCurrentValue
            );
        return $myMIWalletSummary;
    }

    public function get_total_open_value($cuID)
    {
        $getNDWalletsTotals					                        = $this->ci->wallet_model->get_non_default_wallet_totals($cuID);
        if (!empty($getNDWalletsTotals)) {
            foreach ($getNDWalletsTotals->result_array() as $walletInfo) {
                if (!empty($walletInfo['id'])) {
                    $walletID					                    = $walletInfo['id'];
                    $walletAmount				                    = $walletInfo['amount'];
                    $walletInitialAmount		                    = $walletInfo['amount'] + $depositAmount - $withdrawAmount;
                    $walletTotalAmount			                    = $walletInfo['amount'] + $depositAmount - $withdrawAmount + $walletGains;
                    if (!empty($walletAmount)) {
                        $walletPercentChange	                    = ($walletTotalAmount - $walletAmount) / $walletAmount * 100;
                    } else {
                        $walletPercentChange	                    = 0.00;
                    }
                    $getWalletDeposits			                    = $this->ci->wallet_model->get_wallet_deposits($cuID, $walletID);
                    foreach ($getWalletDeposits->result_array() as $depositInfo) {
                        $depositAmount			                    = $depositInfo['amount'];
                    }
                    $getWalletWithdrawals		                    = $this->ci->wallet_model->get_wallet_withdrawals($cuID, $walletID);
                    foreach ($getWalletWithdrawals->result_array() as $withdrawInfo) {
                        $withdrawAmount			                    = $withdrawInfo['amount'];
                    }
                    $getWalletTrades			                    = $this->ci->tracker_model->get_wallet_trades_net_gains($walletID);
                    foreach ($getWalletTrades->result_array() as $walletTrades) {
                        //~ $walletGains				                = number_format($walletTrades['net_gains'], 2, '.', '');
                        $walletGains			                    = $walletTrades['net_gains'];
                    }
                    if (!empty($walletInfo['nickname'])) {
                        $walletTitle			                    = $walletInfo['nickname'];
                    } elseif (!empty($walletInfo['broker'])) {
                        $walletTitle			                    = $walletInfo['broker'] . 'Account';
                    } else {
                        $walletTitle                                = null;
                    }
                    $userWalletOpenSummary			    	        = array(
                                'walletInitialAmount'		        => $walletInitialAmount,
                                'walletAmount'				        => $walletAmount,
                                'depositAmount'				        => $depositAmount,
                                'withdrawAmount'			        => $withdrawAmount,
                                'walletGains'				        => $walletGains,
                                'walletTitle'				        => $walletTitle,
                                'walletPercentChange'		        => $walletPercentChange,
                        );
                    return $userWalletOpenSummary;
                }
            }
        }
    }

    public function get_wallet_info($cuID, $walletID)
    {
        $getWalletDeposits					    = $this->ci->wallet_model->get_wallet_deposits($cuID, $walletID);
        foreach ($getWalletDeposits->result_array() as $depositInfo) {
            $depositAmount				        = $depositInfo['amount'];
        }
        $getWalletWithdrawals				    = $this->ci->wallet_model->get_wallet_withdrawals($cuID, $walletID);
        foreach ($getWalletWithdrawals->result_array() as $withdrawInfo) {
            $withdrawAmount				        = $withdrawInfo['amount'];
        }
        $getWalletTrades					    = $this->ci->tracker_model->get_wallet_trades_net_gains($walletID);
        foreach ($getWalletTrades->result_array() as $walletTrades) {
            //~ $walletGains				= number_format($walletTrades['net_gains'], 2, '.', '');
            $walletGains				        = $walletTrades['net_gains'];
        }
        $getWalletsTotals					    = $this->ci->wallet_model->get_wallet_totals($cuID);
        foreach ($getWalletsTotals->result_array() as $walletTotals) {
            $walletInitialAmount		        = $walletTotals['amount'] + $depositAmount - $withdrawAmount;
            $walletTotalAmount			        = $walletTotals['amount'] + $depositAmount - $withdrawAmount + $walletGains;
        }
        $getWalletInfo						    = $this->ci->investor_model->get_wallet_info($walletID);
        foreach ($getWalletInfo->result_array() as $walletInfo) {
            $walletBroker				        = $walletInfo['broker'];
            $walletAccountID    		        = $walletInfo['account_id'];
            $walletAccessCode                   = $walletInfo['access_code'];
            $walletPremium                      = $walletInfo['premium_wallet']; 
            $walletNickname				        = $walletInfo['nickname'];
            $walletDefault				        = $walletInfo['default_wallet'];
            $walletExchange				        = $walletInfo['exchange_wallet'];
            $walletMarketPair			        = $walletInfo['market_pair'];
            $walletMarket				        = $walletInfo['market'];
            $walletAmount				        = $walletInfo['amount'];
            if (!empty($walletInfo['nickname'])) {
                $walletTitle		            = $walletInfo['nickname'];
            } else {
                $walletTitle		            = $walletInfo['broker'] . 'Account';
            };
        }
        $walletTotalAmount                      = 
        $userWalletInfo						        = array(
            'walletID'					        => $walletID,
            'walletBroker'                      => $walletBroker,
            'walletAccountID'   		        => $walletAccountID,
            'walletAccessCode'                  => $walletAccessCode,
            'walletPremium'                     => $walletPremium,
            'walletInitialAmount'		        => $walletInitialAmount,
            'walletTitle'				        => $walletTitle,
            'walletNickname'			        => $walletNickname,
            'walletDefault'				        => $walletDefault,
            'walletExchange'		    	    => $walletExchange,
            'walletMarketPair'		    	    => $walletMarketPair,
            'walletMarket'			    	    => $walletMarket,
            'walletTotalAmount'		    	    => $walletTotalAmount,
            'depositAmount'			    	    => $depositAmount,
            'withdrawAmount'			        => $withdrawAmount,
            'walletGains'				        => $walletGains,
        );
        return $userWalletInfo;
    }

    public function get_total_wallet_percentage($cuID)
    {
        $getAllWalletAmounts					        = $this->ci->wallet_model->get_all_wallet_amounts($cuID);
        $getAllWalletTransactions				        = $this->ci->wallet_model->get_all_wallet_transactions($cuID);
        $getAllExchangeTransactions				        = $this->ci->wallet_model->get_all_exchanges_transactions($cuID);
    }

   
    public function get_last_activity($cuID, $walletID)
    {
        $getLastTradeActivity					    = $this->ci->tracker_model->get_last_trade_info_by_user($cuID)->result_array();
        if (!empty($getLastTradeActivity)) {
            $lastTradeActivity				    	= $getLastTradeActivity[0]['open_date'] . ' - ' . $getLastTradeActivity[0]['open_time'];
        } else {
            $lastTradeActivity				    	= 'N/A';
        }
        // Get Last Deposit Activity
        $getLastDepositActivity					    = $this->ci->wallet_model->get_last_wallet_deposit($cuID, $walletID)->result_array();
        if (!empty($getLastDepositActivity)) {
            $depositDate							= $getLastDepositActivity[0]['submitted_date'];
            $convertedDepositDate					= strtotime($depositDate);
            $lastDepositActivity					= date('F jS, Y', $convertedDepositDate) . ' - ' . $getLastDepositActivity[0]['time'];
            if (!empty($getLastDepositActivity[0]['time'])) {
                $depositActivity					= $lastDepositActivity;
            } else {
                $depositActivity					= 'N/A';
            }
        } else {
            $depositActivity					    = 'N/A';
        }
        // Get Last Withdraw Activity
        $getLastWithdrawActivity				    = $this->ci->wallet_model->get_last_wallet_withdraw($cuID, $walletID)->result_array();
        if (!empty($getLastWithdrawActivity)) {
            $withdrawDate							= $getLastWithdrawActivity[0]['open_date'];
            $convertedWithdrawDate					= strtotime($withdrawDate);
            $lastWithdrawActivity					= date('F jS, Y', $convertedWithdrawDate) . ' - ' . $getLastWithdrawActivity[0]['time'];
            if (!empty($getLastWithdrawActivity[0]['time'])) {
                $withdrawActivity					= $lastWithdrawActivity;
            } else {
                $withdrawActivity					= 'N/A';
            }
        } else {
            $withdrawActivity					    = 'N/A';
        }
          
        $userLastActivity					    	= array(
            'lastTradeActivity'					    => $lastTradeActivity,
            'depositActivity'					    => $depositActivity,
            'withdrawActivity'					    => $withdrawActivity,
        );

        return $userLastActivity;
    }
    
    public function get_wallet_information($walletID)
    {
        $getWalletInformation              	 	= $this->ci->wallet_model->get_wallet_info($walletID);
        foreach ($getWalletInformation->result_array() as $walletInfo) {
            $walletData                     	= array(
                'type'                     		=> $walletInfo['type'],
                'broker'                   		=> $walletInfo['broker'],
                'nickname'                 		=> $walletInfo['nickname'],
                'amount'             	    	=> $walletInfo['amount'],
            );
            
            return $walletData;
        }
    }
}
