<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth');
        $this->CI->load->model('User/Exchange_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->CI->auth->user_id();
    }
    
    public function reporting()
    {
        $pendingAssets                      = $this->get_pending_assets(); 

        $reportingData                      = array(
            'getPendingAssets'              => $pendingAssets['']
        );
    }

    public function get_pending_assets() {
        $today                              = date("m/d/Y"); 
        $getPendingAssets                   = $this->exchange_model->get_pending_assets($today); 
        $totalPendingAssets                 = $getPendingAssets->num_rows(); 

        $pendingAssets                      = array(
            'getPendingAssets'              => $getPendingAssets,
            'totalPendingAssets'            => $totalPendingAssets,
        );

        return $pendingAssets;
    }
}
