<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIMarketing
{
    public function __construct()
    {
        $this->CI =& get_instance();
        // $this->CI->load->library(array('Auth','MyMIGold','MyMICoin'));
        $this->CI->load->model(array('Management/Marketing_model'));
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

    public function get_page_headers()
    {
        $getTotalCoinAmount			= $this->CI->marketing_model->get_market_summary_amount($market_pair, $market);
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
}
