<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth');
        $this->CI->load->model('User/Exchange_model', 'User/Support_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->CI->auth->user_id();
        $today                              = date("m/d/Y"); 
    }
    
    public function reporting()
    {
        $pendingAssets                      = $this->get_pending_assets(); 
        $approvedAssets                     = $this->get_approved_assets(); 

        $reporting                          = array(
            'getPendingAssets'              => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'            => $pendingAssets['totalPendingAssets'],
            'getApprovedAssets'             => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'           => $approvedAssets['totalApprovedAssets'],
        );

        return $reporting;
    }

    public function get_pending_assets() {
        $getPendingAssets                   = $this->CI->exchange_model->get_pending_assets($today); 
        $totalPendingAssets                 = $getPendingAssets->num_rows(); 

        $pendingAssets                      = array(
            'getPendingAssets'              => $getPendingAssets,
            'totalPendingAssets'            => $totalPendingAssets,
        );

        return $pendingAssets;
    }

    public function get_approved_assets() {
        $getApprovedAssets                  = $this->CI->exchange_model->get_approved_assets(); 
        $totalApprovedAssets                = $getApprovedAssets->num_rows(); 

        $approvedAssets                     = array(
            'getApprovedAssets'             => $getApprovedAssets,
            'totalApprovedAsset'            => $totalApprovedAssets,
        );

        return $approvedAssets;
    }

    public function get_pending_support($department) {
        $getPendingSupport                  = $this->CI->support_model->get_pending_support();
        $totalPendingSupport                = $getPendingSupport->num_rows(); 

        $pendingSupport                     = array(
            'getPendingSupport'             => $
        );
    }
}
