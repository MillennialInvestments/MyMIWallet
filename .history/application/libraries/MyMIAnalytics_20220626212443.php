<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
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
    
    public function reporting()
    {
        $getCoinValue							= $this->CI->mymicoin_model->get_coin_value()->result_array();
        $mymic_coin_value						= $getCoinValue[0]['coin_value'];
        //~ $mymic_coin_value						= $getCoinValue[0]['coin_value'];
        return $mymic_coin_value;
    }

    public function pendingAssets() {
        $today                              = date("m/d/Y"); 
        $getPendingAssets                   = $this->exchange_model->get_pending_assets($today); 
        $totalPendingAssets                 = $getPendingAssets->num_rows(); 

        $pendingAssets                      = array(
            'getPendingAssets'              => $getPending
        );
    }
}
