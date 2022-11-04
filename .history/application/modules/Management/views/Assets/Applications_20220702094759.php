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
    'getApprovedAssets'             => $getApprovedAssets,
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
                                                        <div class="amount"><?php echo $totalTransTotals; ?> <small class="currenct currency-usd">USD</small></div>
                                                        <div class="info">Last month <strong><?php echo $totalLastTransTotals; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total Monthly Spend</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xxl-12">
                                                    <div class="nk-order-ovwg-data sell">
                                                        <div class="amount"><?php echo $totalTransFees; ?> <small class="currenct currency-usd">USD</small></div>
                                                        <div class="info">Last month <strong><?php echo $totalLastTransFees; ?> <span class="currenct currency-usd">USD</span></strong></div>
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
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Assets Created</h6>
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
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                        <i class="icon icon-md ni ni-coins"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                        <h6>
                                            <?php echo number_format($totalApprovedAssets,0); ?>
                                            <small class="fs-14px"> / <?php echo $targetAssets . ' (' . $assetPercentage . ')'; ?></small>
                                            <br>
                                            <small class="fs-16px">Total Assets</small>
                                        </h6>
                                        <!-- <p class="mb-0">Total Assets</p> -->
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Manage Assets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Pending Applications</h6>
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
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-users"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalPendingAssets,0); ?>
                                                <small class="fs-14px"> / <?php echo $targetAssets . ' (' . $pendingAssetsPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Pending Applications</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Manage Applications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Asset Transactions</h6>
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
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-tranx"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalTransactions,0); ?>
                                                <small class="fs-14px"> / <?php echo $targetTransactions . ' (' . $transactionPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Total Transactions</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> View Transactions</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Tranasctional Value</h6>
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
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-reports"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo $totalTransTotals; //number_format($totalTransTotals,0); ?>
                                                <small class="fs-14px"> / <?php echo $targetTransAmount . ' (' . $transAmountPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Total Trades</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> View Transactions</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Transactional Fees</h6>
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
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-users"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo $totalTransFees; ?>
                                                <small class="fs-14px"> / <?php echo $targetTransFees . ' (' . $transFeesPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Total Users</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Manage Fees</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Support Tickets</h6>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="<?php echo site_url('Management/Assets'); ?>"><em class="icon ni ni-setting"></em><span>View Existing Assets</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-notify"></em><span>View Pending Assets</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="d-flex py-md-5">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-wallet"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalPendingSupport,0); ?>
                                                <small class="fs-16px"> Pending Tickets</small>
                                                <br
                                                ><small class="fs-14px"><?php echo $totalCompleteSupport; ?> Tickets Resolved</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="<?php echo site_url('Management/Assets'); ?>" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Manage Tickets</a>
                                </div>
                            </div>
                        </div>
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
                                    <?php $this->load->view('Management/Assets/AppListing-Table', $viewFileData); ?>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
