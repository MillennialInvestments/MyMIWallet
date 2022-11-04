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
        $cuID                               = $this->CI->auth->user_id();
        $today                              = date("m/d/Y");
    }
    
    public function reporting()
    {    
        $pageURIB                           = $this->uri->segment(2); 
        $department                         = $pageURIB;
        $pendingAssets                      = $this->get_pending_assets(); 
        $approvedAssets                     = $this->get_approved_assets();
        $pendingSupport                     = $this->get_pending_support($department); 

        $reporting                          = array(
            'getPendingAssets'              => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'            => $pendingAssets['totalPendingAssets'],
            'getApprovedAssets'             => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'           => $approvedAssets['totalApprovedAssets'],
            'getPendingSupport'             => $pendingSupport['getPendingSupport'],
            'totalPendingSupport'           => $pendingSupport['totalPendingSupport'],
            
        );

        return $reporting;
    }

    public function get_pending_assets() {
        $today                              = date("m/d/Y");
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
        $getPendingSupport                  = $this->CI->support_model->get_pending_support($department);
        $totalPendingSupport                = $getPendingSupport->num_rows(); 

        $pendingSupport                     = array(
            'getPendingSupport'             => $getPendingSupport,
            'totalPendingSupport'           => $totalPendingSupport,
        );

        return $pendingSupport;
    }

    public function get_complete_supprt($department) {
        $getCompleteSupport                 = $this->CI->support_model->get_complete_support($department); 
        $totalCompleteSupport               = $getCompleteSupport->num_rows();
        
        $completeSupport                    = array(
            'getCompleteSupport'            => $getCompleteSupport,
            ''
        )           
    }
}
