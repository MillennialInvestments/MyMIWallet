<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIExchange
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(array('Auth','MyMIGold','MyMICoin'));
        $this->CI->load->model(array('User/Exchange_model'));
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID 								= $this->CI->auth->user_id();
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     */

    public function get_market_summaries($market_pair, $market)
    {
        $getTotalCoinAmount			= $this->CI->exchange_model->get_market_summary_amount($market_pair, $market);
        foreach ($getTotalCoinAmount->result_array() as $totalCoins) {
            $marketValue			= '<strong>Total Cash Volume:</strong><br>$' . number_format($totalCoins['amount'], 2);
        }

        $getTotalCoinCount			= $this->CI->exchange_model->get_market_summary_total_coins($market_pair, $market);
        foreach ($getTotalCoinCount->result_array() as $totalCoinsCount) {
            $totalCoinsExchanged	= '<strong>Total Coin Volume:</strong><br>' . number_format($totalCoinsCount['total'], 0) . ' <strong>' . $market . '</strong>';
        }

        $getTotalOpenCoins			= $this->CI->exchange_model->get_market_summary_open_coins($market_pair, $market);
        foreach ($getTotalOpenCoins->result_array() as $totalOpenCoins) {
            $openCoinsExchanged		= '<strong>Open Coin Volume:</strong><br>' . number_format($totalOpenCoins['total'], 0) . ' <strong>' . $market . '</strong>';
        }

        $exchangeMarketData				= array(
            'marketValue'			=> $marketValue,
            'totalCoinsExchanged'	=> $totalCoinsExchanged,
            'openCoinsExchanged'	=> $openCoinsExchanged,
        );

        return $exchangeMarketData;
    }

    public function get_user_exchange_info($cuID)
    {
        $getUserAssetInfo			= $this->CI->exchange_model->get_user_asset_info($cuID);
        $getUserAssetCount			= $this->CI->exchange_model->get_user_asset_count($cuID);
        $getUserAssetNetWorth		= $this->CI->exchange_model->get_user_asset_net_worth($cuID);
        foreach ($getUserAssetNetWorth->result_array() as $userAssetNetWorth) {
            $cuAssetNetWorth		= $userAssetNetWorth['current_value'];
        }
        $getUserAssetVolume			= $this->CI->exchange_model->get_user_asset_volume($cuID);
        foreach ($getUserAssetVolume->result_array() as $userAssetVolume) {
            $cuAssetVolume			= $userAssetVolume['total_volume'];
        }
        
        // $cuID = 2;
        // $this->db->select_sum('current_value');
        // $this->db->from('bf_exchanges');
        // $this->db->where('market_pair', 'USD');
        // $this->db->where('creator', $cuID);
        // $getUserAssets						= $this->db->get();
        // foreach($getUserAssets->result_array() as $userAssets) {
        // 	$cuAssetNetWorth = $userAssets['current_value'];
        // }
        
        // foreach ($getUserAssetNetWorth->result_array() as $userAssetNetWorth) {
        // 	$cuAssetNetWorth		= $userAssetNetWorth['current_value'];
        // }
        $cuAssetCount				= $getUserAssetCount->num_rows();
        
        // foreach($getUserAssetInfo->result_array() as $userAssetInfo) {
            
        // }

        $userExchangeInfo			= array(
            'cuAssetCount'			=> $cuAssetCount,
            'cuAssetNetWorth'		=> $cuAssetNetWorth,
            'cuAssetVolume'			=> $cuAssetVolume,
        );

        return $userExchangeInfo;
    }

    public function get_user_asset_summary($cuID)
    {
        $userAssetSummary           = array();
        $getUserAssetCount          = $this->CI->exchange_model->get_user_asset_count($cuID);
        if (!empty($getUserAssetCount)) {
            $assetTotalCount        = $getUserAssetCount->num_rows();
            $userAssetSummary[]     = $assetTotalCount;
            $getUserAssetNetWorth       = $this->CI->exchange_model->get_user_asset_net_worth($cuID);
            if (!empty($getUserAssetNetWorth)) {
                foreach ($getUserAssetNetWorth->result_array() as $userAssetSum) {
                    $assetNetValue      = $userAssetSum['current_value'];
                }
                $userAssetSummary[]     = $assetNetValue;
            }
            $getUserAssetInfo           = $this->CI->exchange_model->get_user_asset_info($cuID);
            if (!empty($getUserAssetInfo)) {
                foreach ($getUserAssetInfo->result_array() as $userAssetInfo) {
                    $assetTotalGains    = number_format($userAssetInfo['current_value'] - $userAssetInfo['initial_value'], 2);
                }
                $userAssetSummary[]     = $assetTotalGains;
            } else {
                $assetTotalGains        = 0;
                $userAssetSummary[]     = $assetTotalGains;
            }
        }
        
        return $userAssetSummary;
    }
}
