<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMMyMIICoin
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth');
        $this->CI->load->model('User/Mymicoin_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->CI->auth->user_id();
    }
    
    public function get_coin_value()
    {
        $getCoinValue							= $this->CI->mymicoin_model->get_coin_value()->result_array();
        $mymic_coin_value						= $getCoinValue[0]['coin_value'];
        //~ $mymic_coin_value						= $getCoinValue[0]['coin_value'];
        return $mymic_coin_value;
    }
    
    public function get_coin_info()
    {
        $getCoinInfo							= $this->CI->mymicoin_model->get_coin_value();
        foreach ($getCoinInfo->result_array() as $coinInfo) {
            $available_coins					= $coinInfo['coins_available'];
            $current_value						= $coinInfo['current_value'];
            $initial_value						= $coinInfo['initial_value'];
            $MyMIC_CoinValue					= $coinInfo['coin_value'];
            $minimum_purchase					= $this->CI->config->item('minimum_purchase');
            $minimum_coin_amount				= $this->CI->config->item('minimum_coin_amount');
            $gas_fee							= $coinInfo['gas_fee'];
            $trans_percent						= $coinInfo['trans_percent'];
            $trans_fee							= $coinInfo['trans_fee'];
        }
        $MyMICoinData							= array(
            'available_coins'					=> $available_coins,
            'current_value'						=> $current_value,
            'initial_value'						=> $initial_value,
            'mymic_coin_value'					=> $MyMIC_CoinValue,
            'minimum_purchase'					=> $minimum_purchase,
            'minimum_coin_value'				=> $minimum_coin_amount,
            'gas_fee'							=> $gas_fee,
            'trans_percent'						=> $trans_percent,
            'trans_fee'							=> $trans_fee,
        );
        return $MyMICoinData;
    }
    
    public function get_user_coin_total($cuID)
    {
        $MyMIC_CoinValue 						= $this->CI->mymicoin->get_coin_value();
        $MyMIC_Info                             = $this->CI->mymicoin->get_coin_info();
        $getUserCoinTotal 						= $this->CI->mymicoin_model->get_user_coin_total($cuID);
        foreach ($getUserCoinTotal->result_array() as $MyMICoins) {
            $getTotalCoinExchange				= $this->CI->mymicoin_model->get_total_coins_exchanged()->result_array();
            $coinsExchanged						= $getTotalCoinExchange[0]['total'];
            if (!empty($MyMICoins['id'])) {
                $MyMICoinsID						= $MyMICoins['id'];
                if ($MyMICoinsID !== null) {
                    $totalValue 					= '$0.00';
                    $coinSum						= 0;
                    $myMICPerChange 				= '0.00%';
                } else {
                    if ($cuID === 2) {
                        $coinSum 					= $MyMICoins['total'] - $coinsExchanged;
                    } else {
                        $coinSum 					= $MyMICoins['total'];
                    }
                    $myMICInitialValue				= number_format($coinSum * $MyMICoins['initial_coin_value'], 2);
                    $myMICCurrentValue				= number_format($coinSum * $MyMIC_CoinValue, 2);
                    $myMICDifferential				= number_format($myMICCurrentValue - $myMICInitialValue, 2);
                    if ($myMICDifferential !== '0.00') {
                        $myMICPerChange				= number_format(($myMICDifferential / $myMICCurrentValue), 2);
                        if ($myMICPerChange >= 0) {
                            $myMICPerChangeOutput	= '<span class="text-green">' . $myMICPerChange . '%</span>';
                        } else {
                            $myMICPerChangeOutput	= '<span class="text-red">' . $myMICPerChange . '%</span>';
                        }
                    } else {
                        $myMICPerChangeOutput		= '0.00%';
                    }
                    if ($myMICDifferential >= 0) {
                        $myMICDifferentialOutput	= '<span class="text-green">+$' . $myMICDifferential . '</span>';
                    } else {
                        $myMICDifferentialOutput	= '<span class="text-red">-$' . $myMICDifferential . '</span>';
                    }
                    $totalValue						= number_format($MyMIC_CoinValue * $coinSum, 2);
                }
            } else {
                $totalValue 				    	= '$0.00';
                $coinSum					    	= 0;
                $myMICPerChange 			    	= '0.00';
                $myMICPerChangeOutput		    	= '0.00%';
                $myMICInitialValue  		    	= '0.00';
                $myMICCurrentValue                  = '$0.00';
                $myMICDifferential                  = '0.00';
                $myMICDifferentialOutput            = '0.00';
            }
        }
        $userCoinData						    	= array(
            'mymic_coin_value'				    	=> $MyMIC_CoinValue,
            'totalValue'					    	=> $totalValue,
            'coinSum'						    	=> round($coinSum, 0),
            'coinsExchanged'				    	=> $coinsExchanged,
            'myMICPerChange'				    	=> $myMICPerChange,
            'myMICPerChangeOutput'				    => $myMICPerChangeOutput,
            'myMICInitialValue'					    => $myMICInitialValue,
            'myMICCurrentValue'				    	=> $myMICCurrentValue,
            'myMICDifferential'				    	=> $myMICDifferential,
            'myMICDifferentialOutput'			    => $myMICDifferentialOutput,
            'myMICAvailableCoins'                   => $MyMIC_Info['available_coins'],
        );
        return $userCoinData;
    }
}
