<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIWallets
{
    private $cuID;
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(array('users/Auth', 'MyMICoin', 'MyMIGold'));
        $this->CI->load->model(array('User/Investor_model', 'User/Tracker_model', 'User/Wallet_model'));
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID 								                                = $this->CI->auth->user_id();
    }

    public function get_user_wallet_information($cuID) {
        $getUserWallets                                                     = $this->get_user_wallets($cuID); 

        $userWallets                                                        = array(
            'getUserWallets'                                                => $getUserWallets,
        );
        return $userWallets;
    }

    public function get_default_wallet_info($cuID)
    {

        // User Default Wallet Information (Model)
        $getUserDefaultWallet                   		                    = $this->CI->wallet_model->get_user_default_wallet($cuID);
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
                $userCoinData                            		            = $this->CI->mymicoin->get_user_coin_total($cuID);
                $MyMICoinValue                          		            = $this->CI->mymicoin->get_coin_value();
                $MyMICCoinSum                           		            = $userCoinData['coinSum'];
                $MyMICCurrentValue                      		            = $MyMICoinValue * $MyMICCoinSum;
                if (!empty($userCoinData['myMICPerChange'])) {
                    $MyMICPercentChange                     	            = $userCoinData['myMICPerChange'];
                } else {
                    $MyMICPercentChange                                     = 0;
                }
                $coinsExchanged                         		            = $userCoinData['coinsExchanged'];

                // MyMI Gold Information
                $userGoldData                            		            = $this->CI->mymigold->get_user_coin_total($cuID);
                $MyMIGCoinSum                           		            = $userGoldData['coinSum'];
                $getMyMIGoldValue                          		            = $this->CI->mymigold->get_coin_value();
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
                $getWallets						                            = $this->CI->wallet_model->get_all_wallets($cuID);
                $walletDepositAmount                    		            = 0;
                $walletWithdrawAmount                   		            = 0;
                if (!empty($getWallets)) {
                    $getWalletTrans                                         = $this->CI->wallet_model->get_all_transactions($cuID);
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
                    $getWalletDeposits                                      = $this->CI->wallet_model->get_wallet_deposits($cuID, $walletID);
                    if (!empty($getWalletDeposits)) {
                        foreach ($getWalletDeposits->result_array() as $walletDeposits) {
                            $depositAmount                                  = $walletDeposits['amount'];
                        }
                    } else {
                        $depositAmount                                      = '0.00';
                    }
                    $getWalletWithdrawals                                   = $this->CI->wallet_model->get_wallet_withdrawals($cuID, $walletID);
                    if (!empty($getWalletWithdrawals)) {
                        foreach ($getWalletWithdrawals->result_array() as $walletWithdrawals) {
                            $withdrawAmount                                 = $walletWithdrawals['amount'];
                        }
                    } else {
                        $withdrawAmount                                     = '0.00';
                    }
                    $walletFunds                                            = $depositAmount - $withdrawAmount;
                    $getWalletTrades                                        = $this->CI->tracker_model->get_wallet_trades_net_gains($walletID);
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
            }
        } else {
            $userDefaultWalletInfo                                      = array(); 
            return $userDefaultWalletInfo;
        }
    }

    public function get_total_wallet_value($cuID)
    {
        $defWalletInfo				    	                        = $this->CI->mymiwallet->get_default_wallet_info($cuID);
        $defWalletID				    	                        = $defWalletInfo['walletID'];
        // $defWalletAmount			    	= $defWalletInfo['walletFunds'];
        // $defWalletDepositAmount			    = $defWalletInfo['depositAmount'];
        // $defWalletWithdrawAmount	    	= $defWalletInfo['withdrawAmount'];
        // $defWalletPercentChange			    = $defWalletInfo['walletPercentChange'];
    }

    public function get_user_wallets($cuID) {
        $getUserBankingWallets                                      = $this->CI->wallet_model->get_checking_wallets($cuID); 
        $getUserCreditWallets                                       = $this->CI->wallet_model->get_credit_wallets($cuID); 
        $getUserDebtWallets                                         = $this->CI->wallet_model->get_debt_wallets($cuID); 
        $getUserInvestmentWallets                                   = $this->CI->wallet_model->get_investment_wallets($cuID); 
        $getUserSavingsWallets                                      = $this->CI->wallet_model->get_savings_wallets($cuID); 
        $getUserWallets                                             = array(
            'getUserBankingWallets'                                 => $getUserBankingWallets,
            'totalUserBankingWallets'                               => $getUserBankingWallets->num_rows(),  
            'getUserCreditWallets'                                  => $getUserCreditWallets, 
            'totalUserCreditWallets'                                => $getUserCreditWallets->num_rows(), 
            'getUserDebtWallets'                                    => $getUserDebtWallets, 
            'totalUserDebtWallets'                                  => $getUserDebtWallets->num_rows(), 
            'getUserInvestmentWallets'                              => $getUserInvestmentWallets, 
            // 'totalUserInvestmentWallets'                            => $getUserInvestmentWallets->num_rows(), 
            'getUserSavingsWallets'                                 => $getUserSavingsWallets, 
            'totalUserSavingsWallets'                               => $getUserSavingsWallets->num_rows(), 
        ); 
        
        return $getUserWallets; 
    }

    public function get_wallet_totals($cuID)
    {
        $this->CI->load->library('MyMIGold');
        // $getUserCoinTotal					    = $this->CI->mymigold->get_user_coin_total($cuID);
        $getUserCoinTotal                                           = $this->CI->mymiuser->user_account_info($cuID);
        $totalValue						                            = $getUserCoinTotal['MyMIGoldValue'];
        $myMICCurrentValue					                        = $getUserCoinTotal['MyMICCurrentValue'];
        $myMIGCurrentValue					                        = $getUserCoinTotal['MyMIGCurrentValue'];
        $walletTotals 					                            = $this->CI->wallet_model->get_wallet_totals($cuID);
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
        $getNDWalletsTotals					                        = $this->CI->wallet_model->get_non_default_wallet_totals($cuID);
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
                    $getWalletDeposits			                    = $this->CI->wallet_model->get_wallet_deposits($cuID, $walletID);
                    foreach ($getWalletDeposits->result_array() as $depositInfo) {
                        $depositAmount			                    = $depositInfo['amount'];
                    }
                    $getWalletWithdrawals		                    = $this->CI->wallet_model->get_wallet_withdrawals($cuID, $walletID);
                    foreach ($getWalletWithdrawals->result_array() as $withdrawInfo) {
                        $withdrawAmount			                    = $withdrawInfo['amount'];
                    }
                    $getWalletTrades			                    = $this->CI->tracker_model->get_wallet_trades_net_gains($walletID);
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
        $getWalletDeposits					    = $this->CI->wallet_model->get_wallet_deposits($cuID, $walletID);
        foreach ($getWalletDeposits->result_array() as $depositInfo) {
            $depositAmount				        = $depositInfo['amount'];
        }
        $getWalletWithdrawals				    = $this->CI->wallet_model->get_wallet_withdrawals($cuID, $walletID);
        foreach ($getWalletWithdrawals->result_array() as $withdrawInfo) {
            $withdrawAmount				        = $withdrawInfo['amount'];
        }
        $getWalletTradesNetGain 			    = $this->CI->tracker_model->get_wallet_trades_net_gains($walletID);
        foreach ($getWalletTradesNetGain->result_array() as $walletNetGains) {
            //~ $walletGains				= number_format($walletNetGains['net_gains'], 2, '.', '');
            $walletGains				        = $walletNetGains['net_gains'];
        }
        $getWalletsTotals					    = $this->CI->wallet_model->get_wallet_totals($cuID);
        foreach ($getWalletsTotals->result_array() as $walletTotals) {
            $walletInitialAmount		        = $walletTotals['amount'] + $depositAmount - $withdrawAmount;
            $walletTotalAmount			        = $walletTotals['amount'] + $depositAmount - $withdrawAmount + $walletGains;
        }
        $getWalletInfo						    = $this->CI->wallet_model->get_wallet_info($walletID);
        if (!empty($getWalletInfo)) {
            foreach ($getWalletInfo->result_array() as $walletInfo) {
                $walletType                         = $walletInfo['wallet_type'];
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
        } else { 
            $this->db->from('bf_users_wallet');
            $this->db->where('id', $walletID); 
            $getWalletInfo                      = $this->db->get(); 
            log_message('custom', $getWalletInfo->result_array()); 
            foreach ($getWalletInfo->result_array() as $walletInfo) {
                $walletType                         = $walletInfo['wallet_type'];
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
        }
        $getAllPercentChange		            = $this->CI->tracker_model->get_all_percent_change($walletID);
        foreach ($getAllPercentChange->result_array() as $walletPercentChange) {
            $percent_change			            = $walletPercentChange['closed_perc'];
            if ($percent_change === null) {
                $percentChange			        = '<span">0%</span>';
            } elseif ($percent_change >= 0) {
                $percentChange			        = '<span class="text-success">' . $percent_change . '%</span>';
            } else {
                $percentChange			        = '<span class="text-danger">' . $percent_change . '%</span>';
            }
        }
        $getUserWalletTrades                    = $this->CI->tracker_model->get_wallet_trades($walletID);
        $totalTrades                            = $getUserWalletTrades->num_rows();
        $userWalletInfo						    = array(
            'walletType'                        => $walletType,
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
            'walletAmount'                      => $walletAmount,
            'walletTotalAmount'		    	    => $walletTotalAmount,
            'depositAmount'			    	    => $depositAmount,
            'withdrawAmount'			        => $withdrawAmount,
            'walletGains'				        => $walletGains,
            'percentChange'                     => $percentChange,
            'totalTrades'                       => $totalTrades,
            'getUserWalletTrades'               => $getUserWalletTrades,
        );
        return $userWalletInfo;
    }    
    
    public function get_wallet_information($walletID)
    {
        $getWalletInformation              	 	= $this->CI->wallet_model->get_wallet_info($walletID);
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

    public function get_total_wallet_percentage($cuID)
    {
        $getAllWalletAmounts					        = $this->CI->wallet_model->get_all_wallet_amounts($cuID);
        $getAllWalletTransactions				        = $this->CI->wallet_model->get_all_wallet_transactions($cuID);
        $getAllExchangeTransactions				        = $this->CI->wallet_model->get_all_exchanges_transactions($cuID);
    }
   
    public function get_last_activity($cuID, $walletID)
    {
        $getLastTradeActivity					    = $this->CI->tracker_model->get_last_trade_info_by_user($cuID)->result_array();
        if (!empty($getLastTradeActivity)) {
            $lastTradeActivity				    	= $getLastTradeActivity[0]['open_date'] . ' - ' . $getLastTradeActivity[0]['open_time'];
        } else {
            $lastTradeActivity				    	= 'N/A';
        }
        // Get Last Deposit Activity
        $getLastDepositActivity					    = $this->CI->wallet_model->get_last_wallet_deposit($cuID, $walletID)->result_array();
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
        $getLastWithdrawActivity				    = $this->CI->wallet_model->get_last_wallet_withdraw($cuID, $walletID)->result_array();
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

    public function get_wallets_by_user($userID) {
        $getUserWallets                         = $this->CI->analytical_model->get_total_active_wallets_by_user($userID); 
        return $getUserWallets;
    }

    public function get_trades_by_user($userID) {
        $getTradesByUser                        = $this->CI->analytical_model->get_trades_by_user($userID);
        return $getTradesByUser;
    }

    public function update_asset_approval_status($appID, $assetStatus) {
        $userData                               = array(
            'status'                            => $assetStatus,
        ); 
        $this->db->where('id', $appID); 
        $this->db->update('bf_exchanges_assets'); 
        
    }
}