<?php
$today                              = date("m/d/Y"); 
$month                              = date("n"); 
$day                                = date("d");
$year                               = date("Y"); 
$last_month                         = strtotime($month . ' - 1 month');
$department                         = $this->uri->segment(2);
$reporting                          = $this->mymianalytics->reporting(); 
// Approved
$getApprovedAssets                  = $reporting['getApprovedAssets']; 
$totalApprovedAssets                = $reporting['totalApprovedAssets']; 

// Pending
$getPendingAssets                   = $reporting['getPendingAssets'];
$totalPendingAssets                 = $reporting['totalPendingAssets'];
$getPendingSupport                  = $reporting['getPendingSupport']; 
$totalPendingSupport                = $reporting['totalPendingSupport']; 

// Totals
$totalTransactions                  = $reporting['totalTransactions']; 
$totalTransTotals                   = $reporting['totalTransTotals'];
$totalTransTotalsPlain              = $reporting['totalTransTotalsPlain'];
$totalTransFees                     = $reporting['totalTransFees'];
$totalTransFeesPlain                = $reporting['totalTransFeesPlain'];
$totalLastTransTotals               = $reporting['totalLastTransTotals'];
$totalLastTransFees                 = $reporting['totalLastTransFees'];
$totalCompleteSupport               = $reporting['totalCompleteSupport']; 

// Percentages
$assetPercentage                    = $reporting['assetPercentage'];
$pendingAssetsPercentage            = $reporting['pendingAssetsPercentage'];
$transactionPercentage              = $reporting['transactionPercentage']; 
$transAmountPercentage              = $reporting['transAmountPercentage']; 
$transFeesPercentage                = $reporting['transFeesPercentage'];
// Targets
$targetAssets                       = $reporting['targetAssets'];
$targetTransactions                 = $reporting['targetTransactions'];
$targetTransAmount                  = $reporting['targetTransAmount'];
$targetTransFees                    = $reporting['targetTransFees']; 
$viewFileData                       = array(
    'getPendingAssets'              => $getPendingAssets,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title"><?php echo $pageURIB; ?> Management - Applications</h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<a href="<?php echo site_url('/Trade-Tracker'); ?>">Back to Dashboard</a>							
					</div>
				</div>
			</div>
			<div class="nk-block">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Action Center</h6>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-cc-alt-fill"></em>
                                            <div class="title">Pending Asset Applications</div>
                                            <p><strong><?php echo $totalPendingAssets; ?> Pending Assets</strong> and <strong><?php echo $totalApprovedAssets; ?> Asset Approvals</strong>, thats need to be reviewed.</p>
                                        </div>
                                        <a href="<?php echo site_url('/Management/Assets'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-help-fill"></em>
                                            <div class="title">Support Messages</div>
                                            <p>There is <strong><?php echo $totalPendingSupport; ?></strong> support messages and <strong><?php echo $totalCompleteSupport; ?></strong> completed request. </p>
                                        </div>
                                        <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-wallet-fill"></em>
                                            <div class="title">Transaction Totals</div>
                                            <p>We have reached <strong><?php echo $totalTransactions; ?> Total Transactions</strong>, <strong><?php echo $totalTransTotals; ?> Total Spend</strong>, and <strong><?php echo $totalTransFees; ?> Total</strong> in Transactional Fees.</p>
                                        </div>
                                        <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-lg-8">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Month-to-Month Overview</h6>
                                        <p>Last 12 Months of Total Monthly Spend &amp; Total Transaction Fees.</p>
                                    </div>
                                    <div class="card-tools mt-n1 me-n1">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                    <li><a href="#"><span>3 Months</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-title-group -->
                                <div class="nk-order-ovwg">
                                    <div class="row g-4 align-end">
                                        <div class="col-xxl-8">
                                            <div class="nk-order-ovwg-ck">
                                                <canvas class="order-overview-chart" id="orderOverview"></canvas>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-xxl-4">
                                            <div class="row g-4">
                                                <div class="col-sm-6 col-xxl-12">
                                                    <div class="nk-order-ovwg-data buy">
                                                        <div class="amount"><?php echo $totalApprovedAssets; ?> <small class="currenct currency-usd">USD</small></div>
                                                        <div class="info">Last month <strong><?php echo $totalLastApprovedAssets; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total Monthly Spend</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xxl-12">
                                                    <div class="nk-order-ovwg-data sell">
                                                        <div class="amount"><?php echo $totalPendingAssets; ?> <small class="currenct currency-usd">USD</small></div>
                                                        <div class="info">Last month <strong><?php echo 'Last Month\'s Numbers {"HER//$totalLastPendingAssets; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-up-left"></em> Monthly Transaction Fees</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                    </div>
                                </div><!-- .nk-order-ovwg -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div>
                </div>
			</div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Pending Applications</h6>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <div class="row">
                                                <span class="col">
                                                    <a class="link py-3" href="<?php echo site_url('Management/Assets/Create'); ?>"><i class="icon ni ni-plus-circle"></i> Add Asset</a>
                                                </span>
                                                <span class="col">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <?php $this->load->view('Management/Assets/Applications/Listing-Table', $viewFileData); ?>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
