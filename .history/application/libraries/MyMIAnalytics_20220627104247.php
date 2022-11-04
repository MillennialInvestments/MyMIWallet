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
    }
    
    public function reporting()
    {    
        $pageURIB                           = $this->CI->uri->segment(2); 
        $department                         = $pageURIB;
        $pendingAssets                      = $this->get_pending_assets(); 
        $approvedAssets                     = $this->get_approved_assets();
        $pendingSupport                     = $this->get_pending_support($department); 
        $totalTransOrders                   = $this->get_total_transactions();
        $lastTotalAmounts                   = $this->get_last_total_amounts();

        $reporting                          = array(
            'getPendingAssets'              => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'            => $pendingAssets['totalPendingAssets'],
            'getApprovedAssets'             => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'           => $approvedAssets['totalApprovedAssets'],
            'getPendingSupport'             => $pendingSupport['getPendingSupport'],
            'totalPendingSupport'           => $pendingSupport['totalPendingSupport'],
            'getTotalTrans'                 => $totalTransOrders['getTotalTrans'],
            'totalTransactions'             => $totalTransOrders['totalTransactions'],
            'getLastTotalAmounts'           => $lastTotalAmounts['getLastT']
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
            'totalCompleteSupport'          => $totalCompleteSupport,
        );
        
        return $completeSupport;
    }

    public function get_total_transactions() {
        $getTotalTrans                      = $this->CI->exchange_model->get_total_trans(); 
        $totalOrderTrans                    = $getTotalTrans->num_rows();

        $totalTransOrders                   = array(
            'getTotalTrans'                 => $getTotalTrans,
            'totalTransactions'             => $totalOrderTrans,
        );

        return $totalTransOrders;
    }

    public function get_total_amount() {
        $getTotalAmounts                    = $this->CI->exchange_model->get_total_amounts(); 
        foreach($getTotalAmounts->result_array() as $totalAmounts) {
            if ($totalAmounts['fees'] > 0) {
                $totalTransFees             = '<strong>$' . number_format($totalAmounts['fees'],2) . '</strong>';
            } elseif ($totalAmounts['fees'] < 0) {
                $totalTransFees             = '<strong class="statusRed">-$' . number_format($totalAmounts['fees'],2) . '</strong>';
            }
            if ($totalAmounts['amount'] > 0) {
                $totalTransTotals           = '<strong>$' . number_format($totalAmounts['amount'],2) . '</strong>';
            } elseif ($totalAmounts['amount'] < 0) {
                $totalTransTotals           = '<strong class="statusRed">-$' . number_format($totalAmounts['amount'],2) . '</strong>';
            }
        };

        $totalAmounts                       = array(
            'getTotalAmounts'               => $getTotalAmounts,
            'totalTransFees'                => $totalTransFees,
            'totalTransTotals'              => $totalTransTotals,
        );

        return $totalAmounts;
    }

    public function get_last_total_amount() {
        $getLastTotalAmounts                = $this->CI->exchange_model->get_last_total_amount();
        foreach($getLastTotalAmounts->result_array() as $lastTotalAmounts) {
            if ($lastTotalAmounts['fees'] > 0) {
                $totalLastTransFees         = '<strong>$' . number_format($lastTotalAmounts['fees'],2) . '</strong>';
            } elseif ($lastTotalAmounts['fees'] < 0) {
                $totalLastTransFees         = '<strong class="statusRed">-$' . number_format($lastTotalAmounts['fees'],2) . '</strong>';
            }
            if ($lastTotalAmounts['amount'] > 0) {
                $totalLastTransTotals       = '<strong>$' . number_format($lastTotalAmounts['amount'],2) . '</strong>';
            } elseif ($lastTotalAmounts['amount'] < 0) {
                $totalLastTransTotals       = '<strong class="statusRed">-$' . number_format($lastTotalAmounts['amount'],2) . '</strong>';
            }
        }

        $lastTotalAmounts                   = array(
            'getLastTotalAmounts'           => $getLastTotalAmounts,
            'totalLastTransFees'            => $totalLastTransFees,
            'totalLastTransTotals'          => $totalLastTransTotals,
        );

        return $lastTotalAmounts;
    }
}
