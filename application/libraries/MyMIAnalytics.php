<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('users/auth', 'MyMIUser', 'Session');
        $this->CI->load->model(array('Management/analytical_model'));
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID                                           = $this->CI->auth->user_id();
    }
    
    public function reporting()
    {    
        $cuID                                           = $this->CI->auth->user_id();
        $pageURIB                                       = $this->CI->uri->segment(2); 
        $department                                     = $pageURIB;
        $target                                         = $this->targets();
        $pendingAssets                                  = $this->get_pending_assets(); 
        $approvedAssets                                 = $this->get_approved_assets();
        $totalAmounts                                   = $this->get_total_amount(); 
        $totalTransOrders                               = $this->get_total_transactions();
        $lastTotalAmounts                               = $this->get_last_total_amount();
        $pendingSupport                                 = $this->get_pending_support($department); 
        $completeSupport                                = $this->get_complete_support($department); 
        $trackedTrades                                  = $this->get_total_trades_tracked(); 
        $pendingUsers                                   = $this->get_pending_users(); 
        $activeUsers                                    = $this->get_active_users(); 
        $inactiveUsers                                  = $this->get_inactive_users(); 
        $inactivePartners                               = $this->get_inactive_partners(); 
        $activeServices                                 = $this->get_active_services(); 
        $activePartners                                 = $this->get_active_partners(); 
        $pendingPartnerAssets                           = $this->get_pending_partner_assets();
        $approvedPartnerAssets                          = $this->get_approved_partner_assets();

        // User Activity & Reporting
        $getUserActivity                                = $this->get_user_activity($cuID);

        // Reporting Percentages
        $assetPercentage                                = number_format((($approvedAssets['totalApprovedAssets'] / $target['targetAssets']) * 100),2) . '%'; 
        $pendingAssetsPercentage                        = number_format(((($approvedAssets['totalApprovedAssets'] + $pendingAssets['totalPendingAssets'])/ $target['targetAssets']) * 100),2) . '%'; 
        $subscriptionPercentage                         = number_format((($activeServices['totalActiveServices'] / $target['targetSubscriptions']) * 100), 2) . '%'; 
        $transactionPercentage                          = number_format((($totalTransOrders['totalTransactions'] / $target['targetTransactions']) * 100),2) . '%'; 
        $tradesPercentage                               = number_format((($trackedTrades['totalTradesTracked'] / $target['targetTrades']) * 100),2) . '%'; 
        $usersPercentage                                = number_format((($activeUsers['totalActiveUsers'] / $target['targetUsers']) * 100),2) . '%'; 
        $walletsPercentage                              = number_format((($activeWallets['totalWalletsCreated'] / $target['targetWallets']) * 100),2) . '%'; 
        $transAmountPercentage                          = number_format((($totalAmounts['totalTransTotalsPlain'] / $target['targetTransAmount']) * 100),2) . '%'; 
        $transFeesPercentage                            = number_format((($totalAmounts['totalTransFeesPlain'] / $target['targetTransFees']) * 100),2) . '%'; 
        // Partner Subset
        $partnerAssetPercentage                         = number_format((($approvedPartnerAssets['totalApprovedPartnerAssets'] / $target['targetPartnerAssets']) * 100),2) . '%'; 
        $partnerPercentage                              = number_format((($activePartners['totalActivePartners'] / $target['targetPartners']) * 100),2) . '%'; 
        // $partnerTransactionPercentage                    = number_format((($activePartners['totalPartnerTransactions'] / $target['targetPartnerTransactions']) * 100),2) . '%'; 
        $partnerTransAmountPercentage                   = number_format((($totalAmounts['totalPartnerTransTotalsPlain'] / $target['targetPartnerTransAmount']) * 100),2) . '%'; 
        $partnerTransFeesPercentage                     = number_format((($totalAmounts['totalPartnerTransFeesPlain'] / $target['targetPartnerTransFees']) * 100),2) . '%'; 
        if (!empty($pendingSupport['totalPendingPartnerSupport']) OR !empty($completeSupport['totalCompletePartnerSupport'])) {
            $partnerSupportPercentage                   = number_format((($pendingSupport['totalPendingPartnerSupport'] / $completeSupport['totalCompletePartnerSupport']) * 100),2) . '%'; 
        } else {
            
            $partnerSupportPercentage                   = '0.00%';
        }

        $reporting                                      = array(
            // Get Approved Reports
            'getApprovedAssets'                         => $approvedAssets['getApprovedAssets'],
            'totalApprovedAssets'                       => $approvedAssets['totalApprovedAssets'],
            'getPendingPartnerAssets'                   => $pendingPartnerAssets['getPendingPartnerAssets'],
            'totalPendingPartnerAssets'                 => $pendingPartnerAssets['totalPendingPartnerAssets'],
            'getApprovedPartnerAssets'                  => $approvedPartnerAssets['getApprovedPartnerAssets'],
            'totalApprovedPartnerAssets'                => $approvedPartnerAssets['totalApprovedPartnerAssets'],
            'getActiveUsers'                            => $activeUsers['getActiveUsers'],
            'totalActiveUsers'                          => $activeUsers['totalActiveUsers'],
            'getInactiveUsers'                          => $inactiveUsers['getInactiveUsers'],
            'totalInactiveUsers'                        => $inactiveUsers['totalInactiveUsers'],
            'getActivePartners'                         => $activePartners['getActivePartners'],
            'totalActivePartners'                       => $activePartners['totalActivePartners'],
            'getInactivePartners'                       => $inactivePartners['getInactivePartners'],
            'totalInactivePartners'                     => $inactivePartners['totalInactivePartners'],
            'getActiveServices'                         => $activeServices['getActiveServices'],
            'totalActiveServices'                       => $activeServices['totalActiveServices'],
            'getActiveSubscriptions'                    => $activeServices['getActiveSubscriptions'],
            'totalActiveSubscriptions'                  => $activeServices['totalActiveSubscriptions'],
            'getActiveSubscriptions'                    => $activeServices['getActiveSubscriptions'],
            'getCompleteSupport'                        => $completeSupport['getCompleteSupport'],
            'totalCompleteSupport'                      => $completeSupport['totalCompleteSupport'],
            'getCompletePartnerSupport'                 => $completeSupport['getCompletePartnerSupport'],
            'totalCompletePartnerSupport'               => $completeSupport['totalCompletePartnerSupport'],
           
            // Get Pending Reports
            'getPendingAssets'                          => $pendingAssets['getPendingAssets'],
            'totalPendingAssets'                        => $pendingAssets['totalPendingAssets'],
            'getPendingSupport'                         => $pendingSupport['getPendingSupport'],
            'totalPendingSupport'                       => $pendingSupport['totalPendingSupport'],
            'getPendingPartnerSupport'                  => $pendingSupport['getPendingPartnerSupport'],
            'totalPendingPartnerSupport'                => $pendingSupport['totalPendingPartnerSupport'],
            'getPendingUsers'                           => $pendingUsers['getPendingUsers'],
            'totalPendingUsers'                         => $pendingUsers['totalPendingUsers'],
            'getPendingPartners'                        => $pendingPartners['getPendingPartners'],
            'totalPendingPartners'                      => $pendingPartners['totalPendingPartners'],
            
            // Get Percentages               
            'assetPercentage'                           => $assetPercentage,
            'pendingAssetsPercentage'                   => $pendingAssetsPercentage,
            'subscriptionPercentage'                    => $subscriptionPercentage,
            'transactionPercentage'                     => $transactionPercentage,
            'partnerPercentage'                         => $partnerPercentage,
            'transAmountPercentage'                     => $transAmountPercentage,
            'transFeesPercentage'                       => $transFeesPercentage,
            // Partner Subset
            'partnerAssetPercentage'                    => $partnerAssetPercentage,
            // 'partnerTransationPercentage'               => $partnerTransactionPercentage,
            'partnerTransAmountPercentage'              => $partnerTransAmountPercentage,
            'partnerTransFeesPercentage'                => $partnerTransFeesPercentage,
            'partnerSupportPercentage'                  => $partnerSupportPercentage,

            // Get Targets
            'targetAssets'                              => $target['targetAssets'],
            'targetSubscriptions'                       => $target['targetSubscriptions'],
            'targetTransactions'                        => $target['targetTransactions'],
            'targetTransAmount'                         => $target['targetTransAmount'],
            'targetTransFees'                           => $target['targetTransFees'],
            'targetTrades'                              => $target['targetTrades'],
            'targetWallets'                             => $target['targetWallets'],
            'targetUsers'                               => $target['targetUsers'],
            'targetPartners'                            => $target['targetPartners'],
            'targetPartnerAssets'                       => $target['targetPartnerAssets'],
            'targetPartnerTransactions'                 => $target['targetPartnerTransactions'],
            'targetPartnerTransAmount'                  => $target['targetPartnerTransAmount'],
            'targetPartnerTransFees'                    => $target['targetPartnerTransFees'],

            // Get Totals            
            'getTotalTrans'                             => $totalTransOrders['getTotalTrans'],
            'totalTransactions'                         => $totalTransOrders['totalTransactions'],
            'getTotalAmounts'                           => $totalAmounts['getTotalAmounts'],
            'getTotalPartnerAmounts'                    => $totalAmounts['getPartnerAssetOrders'],
            'totalTransFees'                            => $totalAmounts['totalTransFees'],
            'totalTransTotals'                          => $totalAmounts['totalTransTotals'],
            'totalTransFeesPlain'                       => $totalAmounts['totalTransFeesPlain'],
            'totalTransTotalsPlain'                     => $totalAmounts['totalTransTotalsPlain'],
            'totalPartnerTransTotals'                   => $totalAmounts['totalPartnerTransTotals'],
            'totalPartnerTransTotalsPlain'              => $totalAmounts['totalPartnerTransTotalsPlain'],
            'totalPartnerTransFees'                     => $totalAmounts['totalPartnerTransFees'],
            'totalPartnerTransFeesPlain'                => $totalAmounts['totalPartnerTransFeesPlain'],
            'getLastTotalAmounts'                       => $lastTotalAmounts['getLastTotalAmounts'],
            'totalLastTransFees'                        => $lastTotalAmounts['totalLastTransFees'],
            'totalLastTransTotals'                      => $lastTotalAmounts['totalLastTransTotals'],
            'getTotalTradesTracked'                     => $trackedTrades['getTotalTradesTracked'],
            'totalTradesTracked'                        => $trackedTrades['totalTradesTracked'],  
            // 'totalMarketingTasks'                       => $departmentPendingTasks['totalMarketingTasks'],
            // 'getUserActivity'                           => $getUserActivity['getUserActivity']->result_array(),  

            // Get Wallet Information
            'getTotalActiveWallets'                     => $activeWallets['getTotalActiveWallets'],
            'totalWalletsCreated'                       => $activeWallets['totalWalletsCreated'],
            'totalDefaultWalletsCreated'                => $activeWallets['totalDefaultWalletsCreated'],
            'getTotalWalletTransactions'                => $activeWallets['getTotalWalletTransactions'],
            'totalWalletTransactions'                   => $activeWallets['totalWalletTransactions'],
            'averageWalletTransactions'                  => $activeWallets['averageWalletTransactions'],
        );

        $_SESSION['reporting']                          = $reporting;
        return $reporting;
    }

    public function get_user_activity($cuID) {
        $getUserActivity                                = $this->CI->analytical_model->get_users_activity($cuID); 
        return $getUserActivity;
    }

    public function get_users_activity() {
        $getUsersActivity                               = $this->CI->analytical_model->get_users_activity(); 
        return $getUsersActivity;
    }

    public function targets() {
        $activeUsers                                    = $this->get_active_users(); 
        $totalActiveUsers                               = $activeUsers['totalActiveUsers']; 
        if ($totalActiveUsers <= 500) {
            $targetUsers                                = 500;
        } elseif ($totalActiveUsers <= 1000) {
            $targetUsers                                = 1000;
        } elseif ($totalActiveUsers <= 2500) {
            $targetUsers                                = 2500;
        } elseif ($totalActiveUsers <= 5000) {
            $targetUsers                                = 5000;
        } elseif ($totalActiveUsers <= 10000) {
            $targetUsers                                = 10000;
        } elseif ($totalActiveUsers <= 25000) {
            $targetUsers                                = 25000;
        } elseif ($totalActiveUsers <= 50000) {
            $targetUsers                                = 50000;
        } elseif ($totalActiveUsers <= 100000) {
            $targetUsers                                = 100000;
        } elseif ($totalActiveUsers <= 250000) {
            $targetUsers                                = 250000;
        } elseif ($totalActiveUsers <= 500000) {
            $targetUsers                                = 500000;
        } elseif ($totalActiveUsers <= 1000000) {
            $targetUsers                                = 1000000;
        } elseif ($totalActiveUsers <= 2500000) {
            $targetUsers                                = 2500000;
        } elseif ($totalActiveUsers <= 5000000) {
            $targetUsers                                = 5000000;
        } elseif ($totalActiveUsers <= 10000000) {
            $targetUsers                                = 10000000;            
        }
        $approvedAssets                                 = $this->get_approved_assets(); 
        $totalApprovedAssets                            = $approvedAssets['totalApprovedAssets'];
        if ($totalApprovedAssets <= 100) {
            $targetAssets                               = 100;
        } elseif ($totalApprovedAssets <= 250) {
            $targetAssets                               = 250;
        } elseif ($totalApprovedAssets <= 500) {
            $targetAssets                               = 500;
        } elseif ($totalApprovedAssets <= 1000) {
            $targetAssets                               = 1000;
        } elseif ($totalApprovedAssets <= 2500) {
            $targetAssets                               = 2500;
        } elseif ($totalApprovedAssets <= 5000) {
            $targetAssets                               = 5000;
        } elseif ($totalApprovedAssets <= 10000) {
            $targetAssets                               = 10000;
        } elseif ($totalApprovedAssets <= 25000) {
            $targetAssets                               = 25000;
        } elseif ($totalApprovedAssets <= 50000) {
            $targetAssets                               = 50000;
        } elseif ($totalApprovedAssets <= 100000) {
            $targetAssets                               = 100000;
        } elseif ($totalApprovedAssets <= 250000) {
            $targetAssets                               = 250000;
        } elseif ($totalApprovedAssets <= 500000) {
            $targetAssets                               = 500000;
        } elseif ($totalApprovedAssets <= 1000000) {
            $targetAssets                               = 1000000;
        }
        $activeServices                                 = $this->get_active_services();
        $totalActiveSubscriptions                       = $activeServices['totalActiveSubscriptions'];
        if ($totalActiveSubscriptions <= 100) {
            $targetSubscriptions                        = 100;
        } elseif ($totalActiveSubscriptions <= 250) {
            $targetSubscriptions                        = 250;
        } elseif ($totalActiveSubscriptions <= 500) {
            $targetSubscriptions                        = 500;
        } elseif ($totalActiveSubscriptions <= 1000) {
            $targetSubscriptions                        = 1000;
        } elseif ($totalActiveSubscriptions <= 2500) {
            $targetSubscriptions                        = 2500;
        } elseif ($totalActiveSubscriptions <= 5000) {
            $targetSubscriptions                        = 5000;
        } elseif ($totalActiveSubscriptions <= 10000) {
            $targetSubscriptions                        = 10000;
        } elseif ($totalActiveSubscriptions <= 25000) {
            $targetSubscriptions                        = 25000;
        } elseif ($totalActiveSubscriptions <= 50000) {
            $targetSubscriptions                        = 50000;
        } elseif ($totalActiveSubscriptions <= 100000) {
            $targetSubscriptions                        = 100000;
        } elseif ($totalActiveSubscriptions <= 250000) {
            $targetSubscriptions                        = 250000;
        } elseif ($totalActiveSubscriptions <= 500000) {
            $targetSubscriptions                        = 500000;
        } elseif ($totalActiveSubscriptions <= 1000000) {
            $targetSubscriptions                        = 1000000;
        }
        $targetTransactions                             = 1000;
        $targetTransAmount                              = 100000;
        $targetTransFees                                = 10000;
        $targetTrades                                   = 25000;
        $targetWallets                                  = 1000; 
        $targetPartnerAssets                            = 10;
        $targetPartners                                 = 100;
        $targetPartnerTransactions                      = 10000;
        $targetPartnerTransAmount                       = 1000000;
        $targetPartnerTransFees                         = 100000;

        $target                                         = array(
            'targetAssets'                              => $targetAssets,
            'targetSubscriptions'                       => $targetSubscriptions,
            'targetTransAmount'                         => $targetTransAmount,
            'targetUsers'                               => $targetUsers,
            'targetWallets'                             => $targetWallets,
            'targetPartners'                            => $targetPartners,
            'targetPartnerAssets'                       => $targetPartnerAssets,            
            'targetPartnerTransactions'                 => $targetPartnerTransactions,            
            'targetPartnerTransAmount'                  => $targetPartnerTransAmount,            
            'targetPartnerTransFees'                    => $targetPartnerTransFees,            
        );

        return $target;
    }

    public function get_pending_assets() {
        $today                                          = date("m/d/Y");
        $getPendingAssets                               = $this->CI->analytical_model->get_pending_assets($today); 
        $totalPendingAssets                             = $getPendingAssets->num_rows(); 

        $pendingAssets                                  = array(
            'getPendingAssets'                          => $getPendingAssets,
            'totalPendingAssets'                        => $totalPendingAssets,
        );

        return $pendingAssets;
    }

    public function get_pending_asset_by_id($appID) {
        $getPendingAssetByID                            = $this->CI->analytical_model->get_pending_asset_by_id($appID); 
        foreach ($getPendingAssetByID->result_array() as $pendingAsset) {
            $userID                                     = $pendingAsset['user_id']; 
        };

        $getUserInfo                                    = $this->CI->mymiuser->user_account_info($userID); 

        $pendingAssetByID                               = array(
            'pendingAsset'                              => $getPendingAssetByID->result_array()[0],
            'getUserInfo'                               => $getUserInfo,
        );

        return $pendingAssetByID;
    }

    public function get_active_services() {
        $getActiveServices                              = $this->CI->analytical_model->get_active_services(); 
        $totalActiveServices                            = $getActiveServices->num_rows(); 
        $getActiveSubscriptions                         = $this->CI->analytical_model->get_active_services_subscriptions();
        if (!empty($getActiveSubscriptions)) {
            $totalActiveSubscriptions                   = $getActiveSubscriptions->num_rows(); 
        } else {
            $totalActiveSubscriptions                   = 0;
        }
        $activeServices                                 = array(
            'getActiveServices'                         => $getActiveServices,
            'totalActiveServices'                       => $totalActiveServices,
            'getActiveSubscriptions'                    => $getActiveSubscriptions,
            'totalActiveSubscriptions'                  => $totalActiveSubscriptions,
        ); 
        return $activeServices;
    }

    public function get_approved_assets() {
        $getApprovedAssets                              = $this->CI->analytical_model->get_approved_assets(); 
        $totalApprovedAssets                            = $getApprovedAssets->num_rows(); 

        $approvedAssets                                 = array(
            'getApprovedAssets'                         => $getApprovedAssets,
            'totalApprovedAssets'                       => $totalApprovedAssets,
        );

        return $approvedAssets;
    }

    public function get_pending_partner_assets() {
        $today                                          = date("m/d/Y");
        $getPendingPartnerAssets                        = $this->CI->analytical_model->get_pending_partner_assets($today); 
        $totalPendingPartnerAssets                      = $getPendingPartnerAssets->num_rows(); 

        $pendingPartnerAssets                           = array(
            'getPendingPartnerAssets'                   => $getPendingPartnerAssets,
            'totalPendingPartnerAssets'                 => $totalPendingPartnerAssets,
        );

        return $pendingPartnerAssets;
    }

    public function get_approved_partner_assets() {
        $getApprovedPartnerAssets                       = $this->CI->analytical_model->get_approved_partner_assets(); 
        $totalApprovedPartnerAssets                     = $getApprovedPartnerAssets->num_rows(); 

        $approvedPartnerAssets                          = array(
            'getApprovedPartnerAssets'                  => $getApprovedPartnerAssets,
            'totalApprovedPartnerAssets'                => $totalApprovedPartnerAssets,
        );

        return $approvedPartnerAssets;
    }

    public function migrate_asset_request_info($appID) {
        $assetRequestInfo                               = $this->CI->analytical_model->migrate_asset_request_info($appID);
        return $assetRequestInfo; 
    }

    public function get_total_transactions() {
        $getTotalTrans                                  = $this->CI->analytical_model->get_total_transactions(); 
        $totalOrderTrans                                = $getTotalTrans->num_rows();

        $totalTransOrders                               = array(
            'getTotalTrans'                             => $getTotalTrans,
            'totalTransactions'                         => $totalOrderTrans,
        );

        return $totalTransOrders;
    }

    public function get_total_amount() {
        // Query Database for Amount Totals (by User and by Partners)
        $getTotalAmounts                                = $this->CI->analytical_model->get_total_amounts(); 
        $getPartnerAssetOrders                          = $this->CI->analytical_model->get_total_partner_amounts(); 
        // Define Investor Total Amounts
        foreach($getTotalAmounts->result_array() as $totalAmounts) {
            if ($totalAmounts['fees'] > 0) {
                $totalTransFees                         = '<span>$' . number_format($totalAmounts['fees'],2) . '</span>';
            } elseif ($totalAmounts['fees'] < 0) {
                $totalTransFees                         = '<span class="statusRed">-$' . number_format($totalAmounts['fees'],2) . '</span>';
            }
            if ($totalAmounts['amount'] > 0) {
                $totalTransTotals                       = '<span>$' . number_format($totalAmounts['amount'],2) . '</span>';
            } elseif ($totalAmounts['amount'] < 0) {
                $totalTransTotals                       = '<span class="statusRed">-$' . number_format($totalAmounts['amount'],2) . '</span>';
            }
            $totalTransFeesPlain                        = number_format($totalAmounts['fees'], 2, '.', ''); 
            $totalTransTotalsPlain                      = number_format($totalAmounts['amount'], 2, '.', '');
        };
        // Define Partner Total Amounts
        if (!empty($getPartnerAssetOrders)) {
            foreach ($getPartnerAssetOrders->result_array() as $partnerAssets) {
                if ($partnerAssets['fees'] > 0) {
                    $totalPartnerTransFees              = '<span>$' . number_format($partnerAssets['fees'], 2) . '</span>';
                    $totalPartnerTransFeesPlain         = '0.00';
                } elseif ($partnerAssets['fees'] < 0) {
                    $totalPartnerTransFees              = '<span class="statusRed">-$' . number_format($partnerAssets['fees'], 2) . '</span>';
                    $totalPartnerTransFeesPlain         = '0.00';
                }
                if ($partnerAssets['amount'] > 0) {
                    $totalPartnerTransTotals            = '<span>$' . number_format($partnerAssets['amount'], 2) . '</span>';
                    $totalPartnerTransTotalsPlain       = '0.00';
                } elseif ($partnerAssets['amount'] < 0) {
                    $totalPartnerTransTotals            = '<span class="statusRed">-$' . number_format($partnerAssets['amount'], 2) . '</span>';
                    $totalPartnerTransTotalsPlain       = '0.00';
                }
            }
            $totalPartnerTransFeesPlain                 = '0.00';
            $totalPartnerTransTotalsPlain               = '0.00';
        }
        $totalAmounts                                   = array(
            'getTotalAmounts'                           => $getTotalAmounts,
            'getPartnerAssetOrders'                     => $getPartnerAssetOrders,
            'totalTransFees'                            => $totalTransFees,
            'totalTransTotals'                          => $totalTransTotals,
            'totalTransFeesPlain'                       => $totalTransFeesPlain,
            'totalTransTotalsPlain'                     => $totalTransTotalsPlain,
            'totalPartnerTransTotals'                   => $totalPartnerTransTotals,
            'totalPartnerTransTotalsPlain'              => $totalPartnerTransTotalsPlain,
            'totalPartnerTransFees'                     => $totalPartnerTransFees,
            'totalPartnerTransFeesPlain'                => $totalPartnerTransFeesPlain
        );

        return $totalAmounts;
    }
    
    public function get_last_total_amount() {
        
        $getLastTotalAmounts                            = $this->CI->analytical_model->get_last_total_amount();
        foreach($getLastTotalAmounts->result_array() as $lastTotalAmounts) {
            if ($lastTotalAmounts['fees'] > 0) {
                $totalLastTransFees                     = '<span>$' . number_format($lastTotalAmounts['fees'],2) . '</span>';
            } elseif ($lastTotalAmounts['fees'] < 0) {
                $totalLastTransFees                     = '<span class="statusRed">-$' . number_format($lastTotalAmounts['fees'],2) . '</span>';
            }
            if ($lastTotalAmounts['amount'] > 0) {
                $totalLastTransTotals                   = '<span>$' . number_format($lastTotalAmounts['amount'],2) . '</span>';
            } elseif ($lastTotalAmounts['amount'] < 0) {
                $totalLastTransTotals                   = '<span class="statusRed">-$' . number_format($lastTotalAmounts['amount'],2) . '</span>';
            }
        }

        $lastTotalAmounts                               = array(
            'getLastTotalAmounts'                       => $getLastTotalAmounts,
            'totalLastTransFees'                        => $totalLastTransFees,
            'totalLastTransTotals'                      => $totalLastTransTotals,
        );

        return $lastTotalAmounts;
    }

    public function get_pending_support() {
        $department                                     = $this->CI->uri->segment(2); 
        $getPendingSupport                              = $this->CI->analytical_model->get_pending_support($department);
        $totalPendingSupport                            = $getPendingSupport->num_rows(); 
        $getPendingPartnerSupport                       = $this->CI->analytical_model->get_pending_partner_support($department);
        $totalPendingPartnerSupport                     = $getPendingPartnerSupport->num_rows();

        $pendingSupport                                 = array(
            'getPendingSupport'                         => $getPendingSupport,
            'totalPendingSupport'                       => $totalPendingSupport,
            'getPendingPartnerSupport'                  => $getPendingPartnerSupport,
            'totalPendingPartnerSupport'                => $totalPendingPartnerSupport,
        );

        return $pendingSupport;
    }

    public function get_complete_support($department) {
        $getCompleteSupport                             = $this->CI->analytical_model->get_complete_support($department); 
        $totalCompleteSupport                           = $getCompleteSupport->num_rows();
        $getCompletePartnerSupport                      = $this->CI->analytical_model->get_complete_partner_support($department);
        $totalCompletePartnerSupport                    = $getCompletePartnerSupport->num_rows();
        
        $completeSupport                                = array(
            'getCompleteSupport'                        => $getCompleteSupport,
            'totalCompleteSupport'                      => $totalCompleteSupport,
            'getCompletePartnerSupport'                 => $getCompletePartnerSupport,
            'totalCompletePartnerSupport'               => $totalCompletePartnerSupport,
        );
        
        return $completeSupport;
    }

    public function get_total_active_wallets() {
        $getTotalActiveWallets                          = $this->CI->analytical_model->get_total_active_wallets();
        $totalWalletsCreated                            = $getTotalActiveWallets->num_rows();
        // !! FIX THIS!!! //
        // $getTotalActiveDefaultWallets                   = $this->CI->analytical_model->get_total_active_default_wallets();
        // $totalDefaultWalletsCreated                     = $getTotalActiveDefaultWallets; 
        $totalDefaultWalletsCreated                     = 0; 
        // !! FIX THIS!!! //
        // $getTotalWalletTransactions                     = $this->CI->analytical_model->get_total_wallet_transactions(); 
        // $totalWalletTransactions                        = $getTotalWalletTransactions->num_rows(); 
        $getTotalWalletTransactions                     = 0; 
        $totalWalletTransactions                        = 0; 
        // !! UNCOMMENT ONCE YOU FIX ISSUES ABOVE
        // $averageWalletTransactions                      = number_format($totalWalletTransactions / $totalWalletsCreated,2);
        $averageWalletTransactions                      = 0;
        if ($averageWalletTransactions > 0) {
            $averageWalletTransactions                  = $averageWalletTransactions;
        } else {
            $averageWalletTransactions                  = 0;
        }
        $activeWallets                                  = array(
            'getTotalActiveWallets'                     => $getTotalActiveWallets,
            'totalWalletsCreated'                       => $totalWalletsCreated,
            'totalDefaultWalletsCreated'                => $totalDefaultWalletsCreated,
            'getTotalWalletTransactions'                => $getTotalWalletTransactions,
            'totalWalletTransactions'                   => $totalWalletTransactions,
            'averageWalletTransactions'                 => $averageWalletTransactions, 
        );

        return $activeWallets;
    }

    // public function get_total_active_wallets() {
    //     $getTotalActiveWallets                          = $this->CI->analytical_model->get_total_active_wallets();
    //     $totalWalletsCreated                            = $getTotalActiveWallets->num_rows();
    //     $getTotalDefaultWalletsCreated                  = $this->CI->analytical_model->get_total_active_default_wallets();
    //     $totalDefaultWalletsCreated                     = $getTotalDefaultWalletsCreated->num_rows();
    //     $getTotalWalletTransactions                     = $this->CI->analytical_model->get_total_wallet_transactions(); 
    //     $totalWalletTransactions                        = $getTotalWalletTransactions->num_rows();
    //     $activeWallets                                  = array(
    //         'getTotalActiveWallets'                     => $getTotalActiveWallets,
    //         'totalWalletsCreated'                       => $totalWalletsCreated,
    //         'totalDefaultWalletsCreated'                => $totalDefaultWalletsCreated,
    //         'getTotalWalletTransactions'                => $getTotalWalletTransactions,
    //         'totalWalletTransactions'                   => $totalWalletTransactions,

    //     );

    //     return $activeWallets;
    // }

    public function get_total_trades_tracked() {
        $getTotalTradesTracked                          = $this->CI->analytical_model->get_total_trades_tracked();
        $totalTradesTracked                             = $getTotalTradesTracked->num_rows(); 

        $trackedTrades                                  = array(
            'getTotalTradesTracked'                     => $getTotalTradesTracked,
            'totalTradesTracked'                        => $totalTradesTracked,
        );

        return $trackedTrades; 
    }

    public function get_pending_users() {
        $getPendingUsers                                = $this->CI->analytical_model->get_pending_users();
        $totalPendingUsers                              = $getPendingUsers->num_rows(); 

        $pendingUsers                                   = array(
            'getPendingUsers'                           => $getPendingUsers,
            'totalPendingUsers'                         => $totalPendingUsers,
        );

        return $pendingUsers;
    }

    public function get_active_users() {
        $getActiveUsers                                 = $this->CI->analytical_model->get_active_users(); 
        $totalActiveUsers                               = $getActiveUsers->num_rows();

        $activeUsers                                    = array(
            'getActiveUsers'                            => $getActiveUsers,
            'totalActiveUsers'                          => $totalActiveUsers,
        );
        
        return $activeUsers;
    }

    public function get_inactive_users() {
        $getInactiveUsers                               = $this->CI->analytical_model->get_inactive_users(); 
        if (empty($getInactiveUsers)) {
            $this->db->from('bf_users');
            $this->db->where('active', 0); 
            $this->db->where('banned', 0); 
            $getInactiveUsers                           = $this->db->get(); 
            return $getInactiveUsers;
        }
        $totalInactiveUsers                             = $getInactiveUsers->num_rows();

        $inactiveUsers                                  = array(
            'getInactiveUsers'                          => $getInactiveUsers,
            'totalInactiveUsers'                        => $totalInactiveUsers,
        );
        
        return $inactiveUsers;
    }

    public function get_pending_partners() {
        $getPendingPartners                             = $this->CI->analytical_model->get_pending_partners();
        $totalPendingPartners                           = $getPendingPartners->num_rows();

        $pendingPartners                                = array(
            'getPendingPartners'                        => $getPendingPartners,
            'totalPendingPartners'                      => $totalPendingPartners,
        );

        return $pendingPartners;
    }

    public function get_active_partners() {
        $getActivePartners                              = $this->CI->analytical_model->get_active_partners();
        $totalActivePartners                            = $getActivePartners->num_rows(); 

        $activePartners                                 = array(
            'getActivePartners'                         => $getActivePartners,
            'totalActivePartners'                       => $totalActivePartners,
        );

        return $activePartners;
    }

    public function get_inactive_partners() {
        $getInactivePartners                            = $this->CI->analytical_model->get_inactive_partners(); 
        if (empty($getInactivePartners)) {
            $this->db->from('bf_users');
            $this->db->where('active', 0); 
            $this->db->where('banned', 0); 
            $this->db->where('partner', 1);
            $getInactivePartners                        = $this->db->get(); 
            return $getInactivePartners;
        }
        $totalInactivePartners                          = $getInactivePartners->num_rows();

        $inactivePartners                               = array(
            'getInactivePartners'                       => $getInactivePartners,
            'totalInactivePartners'                     => $totalInactivePartners,
        );
        
        return $inactivePartners;
    }

    public function get_department_tasks($department, $tasks) {
        $getTasksByDepartment                           = $this->CI->analytical_model->get_tasks_by_department($department); 
        $totalTasksByDepartment                         = $getTasksByDepartment->num_rows();

        // create an array to hold total tasks by type
        $totalTasksByTypeArr                            = [];
    
        // loop through each task type
        foreach ($tasks as $taskType) {
            // get tasks by type
            $getTasksByType                             = $this->CI->analytical_model->get_tasks_by_type($department, $taskType); 
            // count the tasks and store it in the array with the task type as the key
            $totalTasksByTypeArr[$taskType]             = $getTasksByType->num_rows();
        }
    
        $departmentPendingTasks                         = array(
            'getTasksByDepartment'                      => $getTasksByDepartment,
            'totalTasks'                                => $totalTasksByDepartment,
            'totalTasksByType'                          => $totalTasksByTypeArr,
        ); 

        return $departmentPendingTasks; 
    }
}
