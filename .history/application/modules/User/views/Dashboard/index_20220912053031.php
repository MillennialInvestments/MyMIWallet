<?php /* /users/views/user_fields.php */
$cuID									        = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRole									        = $_SESSION['allSessionData']['userAccount']['cuRole'];
$cuEmail								        = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuWalletID								        = $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuWalletCount							        = $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$cuTotalWalletCount						        = $_SESSION['allSessionData']['userAccount']['cuTotalWalletCount'];
$cuKYC                                          = $_SESSION['allSessionData']['userAccount']['cuKYC'];
$walletID								        = $_SESSION['allSessionData']['userAccount']['walletID'];
$walletTitle							        = $_SESSION['allSessionData']['userAccount']['walletTitle'];
$walletBroker							        = $_SESSION['allSessionData']['userAccount']['walletBroker'];
$walletNickname							        = $_SESSION['allSessionData']['userAccount']['walletNickname'];
$walletDefault							        = $_SESSION['allSessionData']['userAccount']['walletDefault'];
$walletExchange							        = $_SESSION['allSessionData']['userAccount']['walletExchange'];
$walletMarketPair						        = $_SESSION['allSessionData']['userAccount']['walletMarketPair'];
$walletMarket							        = $_SESSION['allSessionData']['userAccount']['walletMarket'];
$walletFunds							        = $_SESSION['allSessionData']['userAccount']['walletFunds'];
$walletInitialAmount					        = $_SESSION['allSessionData']['userAccount']['walletInitialAmount'];
$walletAmount							        = $_SESSION['allSessionData']['userAccount']['walletAmount'];
$walletPercentChange					        = $_SESSION['allSessionData']['userAccount']['walletPercentChange'];
$walletGains							        = $_SESSION['allSessionData']['userAccount']['walletGains'];
$depositAmount							        = $_SESSION['allSessionData']['userAccount']['depositAmount'];
$withdrawAmount							        = $_SESSION['allSessionData']['userAccount']['withdrawAmount'];
$MyMICoinValue							        = $_SESSION['allSessionData']['userAccount']['MyMICoinValue'];
$MyMICCurrentValue						        = $_SESSION['allSessionData']['userAccount']['MyMICCurrentValue'];
$MyMICCoinSum							        = $_SESSION['allSessionData']['userAccount']['MyMICCoinSum'];
$MyMIGoldValue							        = $_SESSION['allSessionData']['userAccount']['MyMIGoldValue'];
$MyMIGCurrentValue						        = $_SESSION['allSessionData']['userAccount']['MyMIGCurrentValue'];
$MyMIGCoinSum							        = $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$lastTradeActivity                              = $_SESSION['allSessionData']['userAccount']['lastTradeActivity'];
// $walletData							    	= $_SESSION['allSessionData']['userAccount']['walletData'];
$getWallets								        = $_SESSION['allSessionData']['userAccount']['getWallets'];
$walletSum                                      = $_SESSION['allSessionData']['myMIWalletSummary']['walletSum'];
$assetNetValue                                  = $_SESSION['allSessionData']['userAccount']['assetNetValue'];
$assetTotalCount                                = $_SESSION['allSessionData']['userAccount']['assetTotalCount'];
$assetTotalGains                                = $_SESSION['allSessionData']['userAccount']['assetTotalGains'];

$walletCost								        = $this->config->item('wallet_cost');  			 		// $5
$gas_fee								        = $this->config->item('gas_fee');
$trans_fee								        = $this->config->item('trans_fee');
$trans_percent							        = $this->config->item('trans_percent');
$expenses								        = ($walletCost * $trans_percent) + $trans_fee;			// Total Fees
$total_fees								        = number_format($expenses, 2);
$fee_coins								        = round(($MyMICoinValue), 8);
$walletCoins							        = ($walletCost / $MyMICoinValue) + $fee_coins;
$remainingCoins							        = $MyMICCoinSum - $walletCoins;
// New Dashboard Variables
$totalAccountBalance                            = '0.00';
$totalFinancialBalance                          = '0.00';
$lastAccountBalance                             = '0.00';
$totalInvestmentBalance                         = '0.00'; 
$totalMonthlyIncome                             = '0.00'; 
$totalAnnualIncome                              = '0.00'; 
$totalLastMonthIncome                           = '0.00'; 
$totalMonthlyExpenses                           = '0.00'; 
$totalAnnualExpenses                            = '0.00'; 
$totalLastMonthExpenses                         = '0.00'; 
$dashboardData							        = array(
    'getWallets'						        => $getWallets,
    'cuID'								        => $cuID,
    'cuWalletCount'						        => $cuWalletCount,
    'cuTotalWalletCount'				        => $cuTotalWalletCount,
    'walletID'							        => $walletID,
    'walletTitle'						        => $walletTitle,
    'walletAmount'						        => $walletAmount,
    'walletFunds'						        => $walletFunds,
    'walletGains'						        => $walletGains,
    'MyMICCoinSum'						        => $MyMICCoinSum,
    'MyMICCurrentValue'					        => $MyMICCurrentValue,
    'MyMIGCoinSum'						        => $MyMIGCoinSum,
    'MyMIGCurrentValue'					        => $MyMIGCurrentValue,
    'lastTradeActivity'					        => $lastTradeActivity,
    'walletCost'						        => $walletCost,
    'walletCoins'						        => $walletCoins,
    'walletSum'                                 => $walletSum,
    'assetNetValue'                             => $assetNetValue,
    'assetTotalCount'                           => $assetTotalCount,
    'assetTotalGains'                           => $assetTotalGains,
    'totalAccountBalance'                       => $totalAccountBalance,
    'lastAccountBalance'                        => $lastAccountBalance,
    'totalFinancialBalance'                     => $totalFinancialBalance,
    'totalInvestmentBalance'                    => $totalInvestmentBalance,  
    'totalMonthlyIncome'                        => $totalMonthlyIncome,  
    'totalAnnualIncome'                         => $totalAnnualIncome,  
    'totalLastMonthIncome'                      => $totalLastMonthIncome,  
    'totalMonthlyExpenses'                      => $totalMonthlyExpenses,  
    'totalAnnualExpenses'                       => $totalAnnualExpenses,  
    'totalLastMonthExpenses'                    => $totalLastMonthExpenses,  
);
?>   
<style>
.tranx-amount .number {
    font-size:0.87em; 
}
</style>

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Financial Dashboard</h3>
            <div class="nk-block-des text-soft">
                <p>Welcome to Your Financial Overview</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                        <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        <li class="nk-block-tools-opt">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><em class="icon ni ni-user-add-fill"></em><span>Add User</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-coin-alt-fill"></em><span>Add Order</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-note-add-fill-c"></em><span>Add Page</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .toggle-expand-content -->
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-md-4">
            <?php $this->load->view('User/Dashboard/index-new/total_finances', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-4">
            <?php $this->load->view('User/Dashboard/index-new/total_income', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-4">
            <?php $this->load->view('User/Dashboard/index-new/total_expenses', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Investment Overview</h6>
                            <p>The investment overview of your platform. <a href="<?php echo site_url('/Trade-Tracker'); ?>">View All Trades</a></p>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#thisyear">This Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#alltime">All Time</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active" id="overview">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount"><?php echo $activeInvestmentTotals; ?> <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Total Investment Value</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount"><?php echo $activeTotalTrades; ?></span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Total Trades</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount"><?php echo $activeInvestmentProfits; ?> <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Profits</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount"><?php echo $activeMonthlyInvestments; ?> <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Active Investments (MTD)</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount"><?php echo $activeMonthyTrades; </span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="thisyear">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">89,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">96</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">99,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Paid Profit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">83</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="alltime">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">556</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Paid Profit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">223</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner d-flex flex-column h-100">
                    <div class="card-title-group mb-3">
                        <div class="card-title">
                            <h6 class="title">Top Invested Plan</h6>
                            <p>In last 30 days top invested schemes.</p>
                        </div>
                        <div class="card-tools mt-n4 me-n1">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><span>15 Days</span></a></li>
                                        <li><a href="#" class="active"><span>30 Days</span></a></li>
                                        <li><a href="#"><span>3 Months</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-list gy-3">
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Initial Emergency Fund</div>
                                <div class="progress-amount">58%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar" data-progress="58"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Debt Snowball</div>
                                <div class="progress-amount">18.49%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-orange" data-progress="18.49"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Complete Emergency Fund</div>
                                <div class="progress-amount">16%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-teal" data-progress="16"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Retirement Funds</div>
                                <div class="progress-amount">29%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-pink" data-progress="29"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Traditional Investments</div>
                                <div class="progress-amount">33%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-azure" data-progress="33"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Alternative Investments</div>
                                <div class="progress-amount">33%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-azure" data-progress="33"></div>
                            </div>
                        </div>
                    </div>
                    <div class="invest-top-ck mt-auto">
                        <canvas class="iv-plan-purchase" id="planPurchase"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Recent Activities</h6>
                        </div>
                        <div class="card-tools">
                            <ul class="card-tools-nav">
                                <li><a href="#"><span>Cancel</span></a></li>
                                <li class="active"><a href="#"><span>All</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nk-activity">
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                        <div class="nk-activity-data">
                            <div class="label">Keith Jensen requested to Widthdrawl.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-warning">HS</div>
                        <div class="nk-activity-data">
                            <div class="label">Harry Simpson placed a Order.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-azure">SM</div>
                        <div class="nk-activity-data">
                            <div class="label">Stephanie Marshall got a huge bonus.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
                        <div class="nk-activity-data">
                            <div class="label">Nicholas Carr deposited funds.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-pink">TM</div>
                        <div class="nk-activity-data">
                            <div class="label">Timothy Moreno placed a Order.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                </ul>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered h-100">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Notifications</h6>
                        </div>
                        <div class="card-tools">
                            <a href="#" class="link">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-inner">
                    <div class="timeline">
                        <h6 class="timeline-head"><?php echo date("F"); ?>, <?php echo date("Y"); ?></h6>
                        <ul class="timeline-list">
                            <?php
                            $this->db->from('bf_announcements'); 
                            $this->db->order_by('id', 'DESC');
                            $this->db->where('month', date("F")); 
                            $this->db->where('year', date("Y")); 
                            $getAnnouncements       = $this->db->get(); 
                            foreach ($getAnnouncements->result_array() as $announcement) {
                                echo '
                            <li class="timeline-item">
                                <div class="timeline-status bg-primary is-outline"></div>
                                <div class="timeline-date">' . $announcement['day'] . ' ' . date("M ", strtotime($announcement['month'])) . ' <em class="icon ni ni-alarm-alt"></em></div>
                                <div class="timeline-data">
                                    <h6 class="timeline-title">' . $announcement['topic'] . '</h6>
                                    <div class="timeline-des">
                                        <p>' . $announcement['details'] . '</p>
                                        <span class="time">' . $announcement['time'] . '</span>
                                    </div>
                                </div>
                            </li>
                                ';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-xl-12 col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Recent Investment</h6>
                        </div>
                        <div class="card-tools">
                            <a href="#" class="link">View All</a>
                        </div>
                    </div>
                </div>
                <div class="nk-tb-list">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span>Plan</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>Who</span></div>
                        <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                        <div class="nk-tb-col"><span>Amount</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                        <div class="nk-tb-col"><span>&nbsp;</span></div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P1</span>
                                </div>
                                <span class="tb-sub ms-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-pink-dim">
                                    <span>JC</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Janice Carroll</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="progress progress-sm w-80px">
                                <div class="progress-bar" data-progress="75"></div>
                            </div>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P2</span>
                                </div>
                                <span class="tb-sub ms-2">Dimond <span class="d-none d-md-inline">- Daily 8.52% for 14 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-azure-dim">
                                    <span>VA</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Victoria Aguilar</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P3</span>
                                </div>
                                <span class="tb-sub ms-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-purple-dim">
                                    <span>EH</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Emma Henry</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P1</span>
                                </div>
                                <span class="tb-sub ms-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-teal-dim">
                                    <span>AF</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Alice Ford</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P3</span>
                                </div>
                                <span class="tb-sub ms-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-orange-dim">
                                    <span>HW</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Harold Walker</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
    </div>
</div>


