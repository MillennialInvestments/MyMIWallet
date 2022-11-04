<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth', 'MyMIUser');
        $this->CI->load->model('Management/analytical_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID                               = $this->CI->auth->user_id();
    }
    
    public function reporting()
    {    
        $pageURIB                           = $this->CI->uri->segment(2); 
        $department                         = $pageURIB;
        $target                             = $this->targets();
        $pendingAssets                      = $this->get_pending_assets(); 
        $approvedAssets                     = $this->get_approved_assets();
        $totalAmounts                       = $this->get_total_amount(); 
        $totalTransOrders                   = $this->get_total_transactions();
        $lastTotalAmounts                   = $this->get_last_total_amount();
        $pendingSupport                     = $this->get_pending_support($department); 
        $completeSupport                    = $this->get_complete_support($department); 
        $trackedTrades                      = $this->get_total_trades_tracked(); 
        $pendingUsers                       = $this->get_pending_users(); 
        $activeUsers                        = $this->get_active_users(); 
        $activeWallets                      = $this->get_total_active_wallets();

        // Partner Functions
        $pendingPartners                    = $this->get_pending_partners(); 
        $activePartners                     = $this->get_active_partners(); 
        $pendingPartnerAssets               = $this->get_pending_partner_assets();
        $approvedPartnerAssets              = $this->get_approved_partner_assets();

        // Reporting Percentages
        $assetPercentage                    = number_format((($approvedAssets['totalApprovedAssets'] / $target['targetAssets']) * 100),2) . '%'; 
        $pendingAssetsPercentage            = number_format(((($approvedAssets['totalApprovedAssets'] + $pendingAssets['totalPendingAssets'])/ $target['targetAssets']) * 100),2) . '%'; 
        $partnerAssetPercentage             = number_format((($approvedPartnerAssets['totalApprovedPartnerAssets'] / $target['targetPartnerAssets']) * 100),2) . '%'; 
        $transactionPercentage              = number_format((($totalTransOrders['totalTransactions'] / $target['targetTransactions']) * 100),2) . '%'; 
        $tradesPercentage                   = number_format((($trackedTrades['totalTradesTracked'] / $target['targetTrades']) * 100),2) . '%'; 
        $partnerPercentage                  = number_format((($activePartners['totalActivePartners'] / $target['targetPartners']) * 100),2) . '%'; 
        $usersPercentage                    = number_format((($activeUsers['totalActiveUsers'] / $target['targetUsers']) * 100),2) . '%'; 
        $walletsPercentage                  = number_format((($activeWallets['totalWalletsCreated'] / $target['targetWallets']) * 100),2) . '%'; 
        $transAmountPercentage              = number_format((($totalAmounts['totalTransTotalsPlain'] / $target['targetTransAmount']) * 100),2) . '%'; 
        $transFeesPercentage                = number_format((($totalAmounts['totalTransFeesPlain'] / $target['targetTransFees']) * 100),2) . '%'; 
        if (!empty($pendingSupport['totalPendingPartnerSupport']) OR !empty($completeSupport['totalCompletePartnerSupport'])) {
            $partnerSupportPercentage       = number_format((($pendingSupport['totalPendingPartnerSupport'] / $completeSupport['totalCompletePartnerSupport']) * 100),2) . '%'; 
        } else {
            $partnerSupportPercentage       = '0.00%';
        }

        $reporting                          = array(
            // Get Approved Reports
            'getApprovedAssets'             => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'           => $approvedAssets['totalApprovedAssets'],
            'getPendingPartnerAssets'       => $pendingPartnerAssets['getPendingPartnerAssets'],
            'totalPendingPartnerAssets'     => $pendingPartnerAssets['totalPendingPartnerAssets'],
            'getApprovedPartnerAssets'      => $approvedPartnerAssets['getApprovedPartnerAssets'],
            'totalApprovedPartnerAssets'    => $approvedPartnerAssets['totalApprovedPartnerAssets'],
            'getActiveUsers'                => $activeUsers['getActiveUsers'],
            'totalActiveUsers'              => $activeUsers['totalActiveUsers'],
            'getActivePartners'             => $activePartners['getActivePartners'],
            'totalActivePartners'           => $activePartners['totalActivePartners'],
            'getCompleteSupport'            => $completeSupport['getCompleteSupport'],
            'totalCompleteSupport'          => $completeSupport['totalCompleteSupport'],
            'getCompletePartnerSupport'     => $completeSupport['getCompletePartnerSupport'],
            'totalCompletePartnerSupport'   => $completeSupport['totalCompletePartnerSupport'],
            'getTotalActiveWallets'         => $activeWallets['getTotalActiveWallets'],
            'totalWalletsCreated'           => $activeWallets['totalWalletsCreated'],
           
            // Get Pending Reports
            'getPendingAssets'              => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'            => $pendingAssets['totalPendingAssets'],
            'getPendingSupport'             => $pendingSupport['getPendingSupport'],
            'totalPendingSupport'           => $pendingSupport['totalPendingSupport'],
            'getPendingPartnerSupport'      => $pendingSupport['getPendingPartnerSupport'],
            'totalPendingPartnerSupport'    => $pendingSupport['totalPendingPartnerSupport'],
            'getPendingUsers'               => $pendingUsers['getPendingUsers'],
            'totalPendingUsers'             => $pendingUsers['totalPendingUsers'],
            'getPendingPartners'            => $pendingPartners['getPendingPartners'],
            'totalPendingPartners'          => $pendingPartners['totalPendingPartners'],
            
            // Get Percentages               
            'assetPercentage'               => $assetPercentage,
            'pendingAssetsPercentage'       => $pendingAssetsPercentage,
            'partnerAssetPercentage'        => $partnerAssetPercentage,
            'partnerAssetPercentage'        => $partnerAssetPercentage,
            'transactionPercentage'         => $transactionPercentage,
            'tradesPercentage'              => $tradesPercentage,
            'partnerPercentage'             => $partnerPercentage,
            'usersPercentage'               => $usersPercentage,
            'walletsPercentage'             => $walletsPercentage,
            'transAmountPercentage'         => $transAmountPercentage,
            'transFeesPercentage'           => $transFeesPercentage,
            'partnerSupportPercentage'      => $partnerSupportPercentage,

            // Get Targets
            'targetAssets'                  => $target['targetAssets'],
            'targetPartnerAssets'           => $target['targetPartnerAssets'],
            'targetTransactions'            => $target['targetTransactions'],
            'targetTransAmount'             => $target['targetTransAmount'],
            'targetTransFees'               => $target['targetTransFees'],
            'targetTrades'                  => $target['targetTrades'],
            'targetWallets'                 => $target['targetWallets'],
            'targetUsers'                   => $target['targetUsers'],
            'targetPartners'                => $target['targetPartners'],

            // Get Totals            
            'getTotalTrans'                 => $totalTransOrders['getTotalTrans'],
            'totalTransactions'             => $totalTransOrders['totalTransactions'],
            'getTotalAmounts'               => $totalAmounts['getTotalAmounts'],
            'totalTransFees'                => $totalAmounts['totalTransFees'],
            'totalTransTotals'              => $totalAmounts['totalTransTotals'],
            'totalTransFeesPlain'           => $totalAmounts['totalTransFeesPlain'],
            'totalTransTotalsPlain'         => $totalAmounts['totalTransTotalsPlain'],
            'getLastTotalAmounts'           => $lastTotalAmounts['getLastTotalAmounts'],
            'totalLastTransFees'            => $lastTotalAmounts['totalLastTransFees'],
            'totalLastTransTotals'          => $lastTotalAmounts['totalLastTransTotals'],
            'getTotalTradesTracked'         => $trackedTrades['getTotalTradesTracked'],
            'totalTradesTracked'            => $trackedTrades['totalTradesTracked'],  
        );

        return $reporting;
    }

    public function targets() {
        $targetAssets                       = 100;
        $targetPartnerAssets                = 10;
        $targetTransactions                 = 1000;
        $targetTransAmount                  = 100000;
        $targetTransFees                    = 10000;
        $targetTrades                       = 25000;
        $targetPartners                     = 100;
        $targetUsers                        = 1000;
        $targetWallets                      = 1000; 

        $target                             = array(
            'targetAssets'                  => $targetAssets,
            'targetPartnerAssets'           => $targetPartnerAssets,
            'targetTransactions'            => $targetTransactions,
            'targetTransAmount'             => $targetTransAmount,
            'targetTransFees'               => $targetTransFees,
            'targetTrades'                  => $targetTrades,
            'targetPartners'                => $targetPartners,
            'targetUsers'                   => $targetUsers,
            'targetWallets'                 => $targetWallets,
        );

        return $target;
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

    public function get_pending_asset_by_id($appID) {
        $getPendingAssetByID                = $this->CI->analytical_model->get_pending_asset_by_id($appID); 
        foreach ($getPendingAssetByID->result_array() as $pendingAsset) {
            $userID                         = $pendingAsset['user_id']; 
        };

        $getUserInfo                        = $this->CI->mymiuser->user_account_info($userID); 

        $pendingAssetByID                   = array(
            'pendingAsset'                  => $getPendingAssetByID->result_array()[0],
            'getUserInfo'                   => $getUserInfo,
        );

        return $pendingAssetByID;
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

    public function get_pending_partner_assets() {
        $today                              = date("m/d/Y");
        $getPendingPartnerAssets            = $this->CI->analytical_model->get_pending_partner_assets($today); 
        $totalPendingPartnerAssets          = $getPendingPartnerAssets->num_rows(); 

        $pendingPartnerAssets               = array(
            'getPendingPartnerAssets'       => $getPendingPartnerAssets,
            'totalPendingPartnerAssets'     => $totalPendingPartnerAssets,
        );

        return $pendingPartnerAssets;
    }

    public function get_approved_partner_assets() {
        $getApprovedPartnerAssets           = $this->CI->analytical_model->get_approved_partner_assets(); 
        $totalApprovedPartnerAssets         = $getApprovedPartnerAssets->num_rows(); 

        $approvedPartnerAssets              = array(
            'getApprovedPartnerAssets'      => $getApprovedPartnerAssets,
            'totalApprovedPartnerAssets'    => $totalApprovedPartnerAssets,
        );

        return $approvedPartnerAssets;
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
        $getTotalPartnerAmounts             = $this->CI
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
            $totalTransFeesPlain            = number_format($totalAmounts['fees'], 2, '.', ''); 
            $totalTransTotalsPlain          = number_format($totalAmounts['amount'], 2, '.', '');
        };

        $totalAmounts                       = array(
            'getTotalAmounts'               => $getTotalAmounts,
            'totalTransFees'                => $totalTransFees,
            'totalTransTotals'              => $totalTransTotals,
            'totalTransFeesPlain'           => $totalTransFeesPlain,
            'totalTransTotalsPlain'         => $totalTransTotalsPlain,
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
        $getPendingPartnerSupport           = $this->CI->analytical_model->get_pending_partner_support($department);
        $totalPendingPartnerSupport         = $getPendingPartnerSupport->num_rows();

        $pendingSupport                     = array(
            'getPendingSupport'             => $getPendingSupport,
            'totalPendingSupport'           => $totalPendingSupport,
            'getPendingPartnerSupport'      => $getPendingPartnerSupport,
            'totalPendingPartnerSupport'    => $totalPendingPartnerSupport,
        );

        return $pendingSupport;
    }

    public function get_complete_support($department) {
        $getCompleteSupport                 = $this->CI->analytical_model->get_complete_support($department); 
        $totalCompleteSupport               = $getCompleteSupport->num_rows();
        $getCompletePartnerSupport          = $this->CI->analytical_model->get_complete_partner_support($department);
        $totalCompletePartnerSupport        = $getCompletePartnerSupport->num_rows();
        
        $completeSupport                    = array(
            'getCompleteSupport'            => $getCompleteSupport,
            'totalCompleteSupport'          => $totalCompleteSupport,
            'getCompletePartnerSupport'     => $getCompletePartnerSupport,
            'totalCompletePartnerSupport'   => $totalCompletePartnerSupport,
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
