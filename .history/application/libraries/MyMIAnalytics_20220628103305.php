<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth');
        $this->CI->load->model('Management/analytical_model');
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
        $totalAmounts                       = $this->get_total_amount(); 
        $totalTransOrders                   = $this->get_total_transactions();
        $lastTotalAmounts                   = $this->get_last_total_amount();
        $pendingSupport                     = $this->get_pending_support($department); 
        $completeSupport                    = $this->get_complete_support($department); 
        $trackedTrades                      = $this->get_total_trades_tracked(); 
        $activeWallets                      = $this->get_total_active_wallets();
        $pendingUsers                       = $this->get_pending_users(); 
        $activeUsers                        = $this->get_active_users(); 
        $pendingPartners                    = $this->get_pending_partners(); 
        $activePartners                     = $this->get_active_partners(); 

        $reporting                          = array(
            'getPendingAssets'              => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'            => $pendingAssets['totalPendingAssets'],
            'getApprovedAssets'             => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'           => $approvedAssets['totalApprovedAssets'],
            'getTotalTrans'                 => $totalTransOrders['getTotalTrans'],
            'totalTransactions'             => $totalTransOrders['totalTransactions'],
            'getTotalAmounts'               => $totalAmounts['getTotalAmounts'],
            'totalTransFees'                => $totalAmounts['totalTransFees'],
            'totalTransTotals'              => $totalAmounts['totalTransTotals'],
            'getLastTotalAmounts'           => $lastTotalAmounts['getLastTotalAmounts'],
            'totalLastTransFees'            => $lastTotalAmounts['totalLastTransFees'],
            'totalLastTransTotals'          => $lastTotalAmounts['totalLastTransTotals'],
            'getPendingSupport'             => $pendingSupport['getPendingSupport'],
            'totalPendingSupport'           => $pendingSupport['totalPendingSupport'],
            'getCompleteSupport'            => $completeSupport['getCompleteSupport'],
            'totalCompleteSupport'          => $completeSupport['totalCompleteSupport'],
            'getTotalTradesTracked'         => $trackedTrades['getTotalTradesTracked'],
            'totalTradesTracked'            => $trackedTrades['totalTradesTracked'],  
            'getTotalActiveWallets'         => $activeWallets['getTotalActiveWallets'],
            'totalWalletsCreated'           => $activeWallets['totalWalletsCreated'],
            'getPendingUsers'               => $pendingUsers['getPendingUsers'],
            'totalPendingUsers'             => $pendingUsers['totalPendingUsers'],
            'getActiveUsers'                => $activeUsers['getActiveUsers'],
            'totalActiveUsers'              => $activeUsers['totalActiveUsers'],
            'getPendingPartners'            => $pendingPartners['getPendingPartners'],
            'totalPendingPartners'          => $pendingPartners['totalPendingPartners'],
            'getActivePartners'             => $activePartner
        );

        return $reporting;
    }

    public function get_pending_assets() {
        $today                              = date("m/d/Y");
        $getPendingAssets                   = $this->CI->analytical_model->get_pending_assets($today); 
        $totalPendingAssets                 = $getPendingAssets->num_rows(); 

        $pendingAssets                      = array(
            'getPendingAssets'              => $getPendingAssets,
            'totalPendingAssets'            => $totalPendingAssets,
        );

        return $pendingAssets;
    }

    public function get_approved_assets() {
        $getApprovedAssets                  = $this->CI->analytical_model->get_approved_assets(); 
        $totalApprovedAssets                = $getApprovedAssets->num_rows(); 

        $approvedAssets                     = array(
            'getApprovedAssets'             => $getApprovedAssets,
            'totalApprovedAssets'           => $totalApprovedAssets,
        );

        return $approvedAssets;
    }

    public function get_total_transactions() {
        $getTotalTrans                      = $this->CI->analytical_model->get_total_transactions(); 
        $totalOrderTrans                    = $getTotalTrans->num_rows();

        $totalTransOrders                   = array(
            'getTotalTrans'                 => $getTotalTrans,
            'totalTransactions'             => $totalOrderTrans,
        );

        return $totalTransOrders;
    }

    public function get_total_amount() {
        $getTotalAmounts                    = $this->CI->analytical_model->get_total_amounts(); 
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
        $getLastTotalAmounts                = $this->CI->analytical_model->get_last_total_amount();
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

    public function get_pending_support() {
        $department                         = $this->CI->uri->segment(2); 
        $getPendingSupport                  = $this->CI->analytical_model->get_pending_support($department);
        $totalPendingSupport                = $getPendingSupport->num_rows(); 

        $pendingSupport                     = array(
            'getPendingSupport'             => $getPendingSupport,
            'totalPendingSupport'           => $totalPendingSupport,
        );

        return $pendingSupport;
    }

    public function get_complete_support($department) {
        $getCompleteSupport                 = $this->CI->analytical_model->get_complete_support($department); 
        $totalCompleteSupport               = $getCompleteSupport->num_rows();
        
        $completeSupport                    = array(
            'getCompleteSupport'            => $getCompleteSupport,
            'totalCompleteSupport'          => $totalCompleteSupport,
        );
        
        return $completeSupport;
    }

    public function get_total_active_wallets() {
        $getTotalActiveWallets              = $this->CI->analytical_model->get_total_active_wallets();
        $totalWalletsCreated                = $getTotalActiveWallets->num_rows();

        $activeWallets                      = array(
            'getTotalActiveWallets'         => $getTotalActiveWallets,
            'totalWalletsCreated'           => $totalWalletsCreated,
        );

        return $activeWallets;
    }

    public function get_total_trades_tracked() {
        $getTotalTradesTracked              = $this->CI->analytical_model->get_total_trades_tracked();
        $totalTradesTracked                 = $getTotalTradesTracked->num_rows(); 

        $trackedTrades                      = array(
            'getTotalTradesTracked'         => $getTotalTradesTracked,
            'totalTradesTracked'            => $totalTradesTracked,
        );

        return $trackedTrades; 
    }

    public function get_pending_users() {
        $getPendingUsers                    = $this->CI->analytical_model->get_pending_users();
        $totalPendingUsers                  = $getPendingUsers->num_rows(); 

        $pendingUsers                       = array(
            'getPendingUsers'               => $getPendingUsers,
            'totalPendingUsers'             => $totalPendingUsers,
        );

        return $pendingUsers;
    }

    public function get_active_users() {
        $getActiveUsers                     = $this->CI->analytical_model->get_active_users(); 
        $totalActiveUsers                   = $getActiveUsers->num_rows();

        $activeUsers                        = array(
            'getActiveUsers'                => $getActiveUsers,
            'totalActiveUsers'              => $totalActiveUsers,
        );
        
        return $activeUsers;
    }

    public function get_pending_partners() {
        $getPendingPartners                 = $this->CI->analytical_model->get_pending_partners();
        $totalPendingPartners               = $getPendingPartners->num_rows();

        $pendingPartners                    = array(
            'getPendingPartners'            => $getPendingPartners,
            'totalPendingPartners'          => $totalPendingPartners,
        );

        return $pendingPartners;
    }

    public function get_active_partners() {
        $getActivePartners                  = $this->CI->analytical_model->get_active_partners();
        $totalActivePartners                = $getActivePartners->num_rows(); 

        $activePartners                     = array(
            'getActivePartners'             => $getActivePartners,
            'totalActivePartners'           => $totalActivePartners,
        );

        return $activePartners;
    }
}
