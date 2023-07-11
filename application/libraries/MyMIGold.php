<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIGold
{
    public function __construct()
    {
        $this->ci =& get_instance();
<<<<<<< HEAD
        $this->ci->load->library('users/Auth');
        $this->ci->load->model('User/Mymigold_model');
        //~ $this->ci->load->library(array('Auth', 'MyMIWallets'));
        $cuID                                       = $this->ci->auth->user_id();
=======
        $this->ci->load->library('Auth');
        $this->ci->load->model('User/Mymigold_model');
        //~ $this->ci->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->ci->auth->user_id();
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }
    
    public function get_order_information($orderID)
    {
        $getOrderInformation 					    = $this->ci->mymigold_model->get_order_information($orderID);
        foreach ($getOrderInformation->result_array() as $orderInformation) {
            $amount								    = $orderInformation['amount'];
            $total								    = $orderInformation['total'];
            $total_fees							    = $orderInformation['total_fees'];
        }

        $orderInfo								    = array(
            'amount'							    => $amount,
            'total'								    => $total,
            'total_fees'						    => $total_fees,
        );
        return $orderInfo;
    }
    
    public function get_coin_value()
    {
        $getCoinValue							    = $this->ci->mymigold_model->get_coin_value()->result_array();
        return $getCoinValue;
    }
    
    public function get_coin_info()
    {
        $cuID                                       = $this->ci->auth->user_id();
        $getCoinInfo							    = $this->ci->mymigold_model->get_coin_info();
        $getUserCoinTotal                           = $this->ci->mymigold_model->get_user_coin_total($cuID);
        $MyMIGoldData                               = array();
        if (empty($getCoinInfo)) {
            $current_value                          = 1;
            $initial_value                          = 1;
            $new_coin_value                         = 1;
            $gas_fee                                = 0.007457;
            $trans_fee                              = 0.60;
            $trans_percent                          = 1.058;

            $MyMIGoldData[]                         = array(
                'current_value'					    => $current_value,
                'initial_value'					    => $initial_value,
                'mymig_coin_value'				    => $new_coin_value,
                'gas_fee'						    => $gas_fee,
                'trans_percent'					    => $trans_percent,
                'trans_fee'						    => $trans_fee,
            );
        } else {
            foreach ($getCoinInfo->result_array() as $coinInfo) {
                $current_value					    = $coinInfo['current_value'];
                $initial_value					    = $coinInfo['initial_value'];
                $new_coin_value                     = $coinInfo['new_coin_value'];
                $gas_fee						    = $coinInfo['gas_fee'];
                $trans_percent					    = $coinInfo['trans_percent'];
                $trans_fee						    = $coinInfo['trans_fee'];
            }
            $MyMIGoldData[]                         = array(
                'current_value'					    => $current_value,
                'initial_value'					    => $initial_value,
                'mymig_coin_value'				    => $new_coin_value,
                'gas_fee'						    => $gas_fee,
                'trans_percent'					    => $trans_percent,
                'trans_fee'						    => $trans_fee,
            );
        }
        if (empty($getUserCoinTotal)) {
            $available_coins                        = 1000000000;

            $MyMIGoldData[]                         = array(
                'available_coins'   			    => $available_coins,
            );
        } else {
            foreach ($getUserCoinTotal->result_array() as $coinTotal) {
                $available_coins					= $coinTotal['total'];
            }

            $MyMIGoldData[]                         = array(
                'available_coins'   			    => $available_coins,
            );
        }
        return $MyMIGoldData;
    }
    
    public function get_user_coin_total($cuID)
    {
        $this->ci->load->config('site_settings');
        $MyMIGoldData 							    = $this->ci->mymigold->get_coin_info();
        $getUserCoinTotal 						    = $this->ci->mymigold_model->get_user_coin_total($cuID);
        $coin_value								    = $this->ci->config->item('mymig_coin_value');
        // Get MyMI Gold Current Information
        if (!empty($getUserCoinTotal)) {
            foreach ($getUserCoinTotal->result_array() as $userCoins) {
                $coinSum 						    = $userCoins['total'];
                $myMIGInitialValue				    = number_format($coinSum * $userCoins['initial_coin_value'], 2);
                $myMIGCurrentValue				    = number_format($coinSum, 2);
                $myMIGDifferential				    = number_format($myMIGCurrentValue - $myMIGInitialValue, 2);
                $myMIGPerChange		                = '0.00%';
                $myMIGPerChangeOutput		        = '0.00%';
                if ($myMIGDifferential >= 0) {
                    $myMIGDifferentialOutput	    = '<span class="text-green">+$' . $myMIGDifferential . '</span>';
                } else {
                    $myMIGDifferentialOutput	    = '<span class="text-red">-$' . $myMIGDifferential . '</span>';
                }
                $totalValue						    = number_format($coin_value * $coinSum, 2);
            }
        } else {
            $totalValue 					        = '$0.00';
            $coinSum					    	    = 0;
            $myMIGPerChange 			    	    = '0.00';
            $myMIGPerChangeOutput		     	    = '0.00%';
            $myMIGInitialValue  		     	    = '0.00';
            $myMIGCurrentValue                      = '$0.00';
            $myMIGDifferential                      = '0.00';
            $myMIGDifferentialOutput                = '0.00';
        }
        $userGoldData							    = array(
            'coin_value'						    => $coin_value,
            'totalValue'						    => $totalValue,
            'coinSum'							    => round($coinSum, 0),
            'myMIGPerChange'					    => $myMIGPerChange,
            'myMIGPerChangeOutput'				    => $myMIGPerChangeOutput,
            'myMIGInitialValue'					    => $myMIGInitialValue,
            'myMIGCurrentValue'					    => $myMIGCurrentValue,
            'myMIGDifferential'					    => $myMIGDifferential,
            'myMIGDifferentialOutput'			    => $myMIGDifferentialOutput,
        );
        return $userGoldData;
    }

    public function get_user_last_order($cuID)
    {
        $getUserLastOrder						    = $this->ci->mymigold_model->get_last_order_info($cuID);
        if (empty($getUserLastOrder)) {
            $userLastOrder                          = array();
            return $userLastOrder;
        } else {
            foreach ($getUserLastOrder->result_array() as $lastOrder) {
                $orderID						    = $lastOrder['id'];
                $unix_timestamp                     = $lastOrder['unix_timestamp'];
                $current_date                       = $lastOrder['current_date'];
                $month                              = $lastOrder['month'];
                $day                                = $lastOrder['day'];
                $year                               = $lastOrder['year'];
                $time                               = $lastOrder['time'];
                $status                             = $lastOrder['status'];
                $beta                               = $lastOrder['beta'];
                $wallet_id                          = $lastOrder['wallet_id'];
                $user_id                            = $lastOrder['user_id'];
                $user_email                         = $lastOrder['user_email'];
                $reward                             = $lastOrder['reward'];
                $reward_type                        = $lastOrder['reward_type'];
                $coin                               = $lastOrder['coin'];
                $initial_value                      = $lastOrder['initial_value'];
                $current_value                      = $lastOrder['current_value'];
                $available_coins                    = $lastOrder['available_coins'];
                $new_availability                   = $lastOrder['new_availability'];
                $minimum_coin_amount                = $lastOrder['minimum_coin_amount'];
                $initial_coin_value                 = $lastOrder['initial_coin_value'];
                $new_coin_value                     = $lastOrder['new_coin_value'];
                $amount                             = $lastOrder['amount'];
                $total                              = $lastOrder['total'];
                $total_cost                         = $lastOrder['total_cost'];
                $total_fees                         = $lastOrder['total_fees'];
                $gas_fee                            = $lastOrder['gas_fee'];
                $trans_fee                          = $lastOrder['trans_fee'];
                $trans_percent                      = $lastOrder['trans_percent'];
                $user_gas_fee                       = $lastOrder['user_gas_fee'];
                $user_trans_fee                     = $lastOrder['user_trans_fee'];
                $user_trans_percent                 = $lastOrder['user_trans_percent'];
                $referral_id                        = $lastOrder['referral_id'];
                $redirect_url                       = $lastOrder['redirect_url'];
                $userLastOrder                      = array(
                    'orderID'                       => $orderID,
                    'unix_timestamp'                => $unix_timestamp,
                    'current_date'                  => $current_date,
                    'month'                         => $month,
                    'day'                           => $day,
                    'year'                          => $year,
                    'time'                          => $time,
                    'status'                        => $status,
                    'beta'                          => $beta,
                    'wallet_id'                     => $wallet_id,
                    'user_id'                       => $user_id,
                    'user_email'                    => $user_email,
                    'reward'                        => $reward,
                    'reward_type'                   => $reward_type,
                    'coin'                          => $coin,
                    'initial_value'                 => $initial_value,
                    'current_value'                 => $current_value,
                    'available_coins'               => $available_coins,
                    'new_availability'              => $new_availability,
                    'minimum_coin_amount'           => $minimum_coin_amount,
                    'initial_coin_value'            => $initial_coin_value,
                    'new_coin_value'                => $new_coin_value,
                    'amount'                        => $amount,
                    'total'                         => $total,
                    'total_cost'                    => $total_cost,
                    'total_fees'                    => $total_fees,
                    'gas_fee'                       => $gas_fee,
                    'trans_fee'                     => $trans_fee,
                    'trans_percent'                 => $trans_percent,
                    'user_gas_fee'                  => $user_gas_fee,
                    'user_trans_fee'                => $user_trans_fee,
                    'user_trans_percent'            => $user_trans_percent,
                    'referral_id'                   => $referral_id,
                    'redirect_url'                  => $redirect_url,
                );
                return $userLastOrder;
            };
        }
    }

    public function get_user_last_completed_order($orderID)
    {
        $getUserLastOrder						    = $this->ci->mymigold_model->get_last_completed_order_info($orderID);
        if (!empty($getUserLastOrder)) {
            foreach ($getUserLastOrder->result_array() as $lastOrder) {
                $orderID						    = $lastOrder['id'];
                $unix_timestamp                     = $lastOrder['unix_timestamp'];
                $current_date                       = $lastOrder['current_date'];
                $month                              = $lastOrder['month'];
                $day                                = $lastOrder['day'];
                $year                               = $lastOrder['year'];
                $time                               = $lastOrder['time'];
                $status                             = $lastOrder['status'];
                $beta                               = $lastOrder['beta'];
                $wallet_id                          = $lastOrder['wallet_id'];
                $user_id                            = $lastOrder['user_id'];
                $user_email                         = $lastOrder['user_email'];
                $reward                             = $lastOrder['reward'];
                $reward_type                        = $lastOrder['reward_type'];
                $coin                               = $lastOrder['coin'];
                $initial_value                      = $lastOrder['initial_value'];
                $current_value                      = $lastOrder['current_value'];
                $available_coins                    = $lastOrder['available_coins'];
                $new_availability                   = $lastOrder['new_availability'];
                $minimum_coin_amount                = $lastOrder['minimum_coin_amount'];
                $initial_coin_value                 = $lastOrder['initial_coin_value'];
                $new_coin_value                     = $lastOrder['new_coin_value'];
                $amount                             = $lastOrder['amount'];
                $total                              = $lastOrder['total'];
                $total_cost                         = $lastOrder['total_cost'];
                $total_fees                         = $lastOrder['total_fees'];
                $gas_fee                            = $lastOrder['gas_fee'];
                $trans_fee                          = $lastOrder['trans_fee'];
                $trans_percent                      = $lastOrder['trans_percent'];
                $user_gas_fee                       = $lastOrder['user_gas_fee'];
                $user_trans_fee                     = $lastOrder['user_trans_fee'];
                $user_trans_percent                 = $lastOrder['user_trans_percent'];
                $feature                            = $lastOrder['feature'];
                $referral_id                        = $lastOrder['referral_id'];
                $redirect_url                       = $lastOrder['redirect_url'];
                $userLastCompletedOrder             = array(
                    'orderID'                       => $orderID,
                    'unix_timestamp'                => $unix_timestamp,
                    'current_date'                  => $current_date,
                    'month'                         => $month,
                    'day'                           => $day,
                    'year'                          => $year,
                    'time'                          => $time,
                    'status'                        => $status,
                    'beta'                          => $beta,
                    'wallet_id'                     => $wallet_id,
                    'user_id'                       => $user_id,
                    'user_email'                    => $user_email,
                    'reward'                        => $reward,
                    'reward_type'                   => $reward_type,
                    'coin'                          => $coin,
                    'initial_value'                 => $initial_value,
                    'current_value'                 => $current_value,
                    'available_coins'               => $available_coins,
                    'new_availability'              => $new_availability,
                    'minimum_coin_amount'           => $minimum_coin_amount,
                    'initial_coin_value'            => $initial_coin_value,
                    'new_coin_value'                => $new_coin_value,
                    'amount'                        => $amount,
                    'total'                         => $total,
                    'total_cost'                    => $total_cost,
                    'total_fees'                    => $total_fees,
                    'gas_fee'                       => $gas_fee,
                    'trans_fee'                     => $trans_fee,
                    'trans_percent'                 => $trans_percent,
                    'user_gas_fee'                  => $user_gas_fee,
                    'user_trans_fee'                => $user_trans_fee,
                    'user_trans_percent'            => $user_trans_percent,
                    'referral_id'                   => $referral_id,
                    'feature'                       => $feature,
                    'redirect_url'                  => $redirect_url,
                );
                return $userLastCompletedOrder;
            };
        } else {
            $userLastCompletedOrder                 = array();
            return $userLastCompletedOrder;
        }
    }
}
?>
