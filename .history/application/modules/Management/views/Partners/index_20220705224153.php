<?php
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems'); 
$today                              = date("m/d/Y"); 
$month                              = date("n"); 
$day                                = date("d");
$year                               = date("Y"); 
$last_month                         = strtotime($month . ' - 1 month');
$department                         = $this->uri->segment(2);
$reporting                          = $this->mymianalytics->reporting(); 
$getPendingPartners                 = $reporting['getPendingPartners'];
$totalPendingPartners               = $reporting['totalPendingPartners'];
$getActivePartners                  = $reporting['getActivePartners'];
$totalActivePartners                = $reporting['totalActivePartners'];
$targetPartners                     = $reporting['targetPartners'];
$getPendingPartnerAssets            = $reporting['getPendingPartnerAssets'];
$totalPendingPartnerAssets          = $reporting['totalPendingPartnerAssets'];
$getApprovedPartnerAssets           = $reporting['getApprovedPartnerAssets'];
$totalApprovedPartnerAssets         = $reporting['totalApprovedPartnerAssets'];
$targetPartnerAssets                = $reporting['targetPartnerAssets'];
$partnerAssetPercentage             = $reporting['partnerAssetPercentage'];
$partnerPercentage                  = $reporting['partnerPercentage'];
$totalPendingSupport                = $reporting['totalPendingSupport'];
$totalCompleteSupport               = $reporting['totalCompleteSupport'];
$totalPendingPartnerSupport         = $reporting['totalPendingPartnerSupport'];
$totalCompletePartnerSupport        = $reporting['totalCompletePartnerSupport'];
$partnerSupportPercentage           = $reporting['partnerSupportPercentage'];
$getTotalPartnerAmounts             = $reporting['getTotalPartnerAMounts'];
$totalPartnerTransFees              = $reporting['totalPartnerTransFees'];
$totalPartnerTransFeesPlain         = $reporting['totalPartnerTransFeesPlain'];
$totalPartnerTransTotalsPlain       = $reporting['totalPartnerTransTotalsPlain']

$viewFileData                       = array(
    'getActivePartners'             => $getActivePartners,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">MyMI Management - <?php echo $pageURIB; ?></h1>
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
                                            <div class="title">Pending Asset Request</div>
                                            <p><strong><?php echo $totalPendingPartners; ?> Pending Applications</strong> and <strong><?php echo $totalActivePartners; ?> Total Partners</strong>, thats need to be reviewed.</p>
                                        </div>
                                        <a href="<?php echo site_url('/Management/Partners/Listing'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
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
                                            <div class="title">Partner Assets</div>
                                            <p>We have reached <strong><?php //echo $totalTransactions; ?> Total Transactions</strong>, <strong><?php //echo $totalTransTotals; ?> Total Spend</strong>, and <strong><?php //echo $totalTransFees; ?> Total</strong> in Transactional Fees.</p>
                                        </div>
                                        <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div>
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
                                                        <div class="amount"><?php echo $totalActivePartners; ?> <small class="currenct currency-usd">Active Partners</small></div>
                                                        <div class="info">Last month <strong><?php echo 'Last Months Number {HERE}' //$totalLastActicePartners; ?> <span class="currenct currency-usd">Active Partners</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total Active Partners</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xxl-12">
                                                    <div class="nk-order-ovwg-data sell">
                                                        <div class="amount"><?php echo $totalPendingPartners; ?> <small class="currenct currency-usd">Pending Applications</small></div>
                                                        <div class="info">Last month <strong><?php echo 'Last Months Pending Parter {HERE}'; //$totalPendingPartners; ?> <span class="currenct currency-usd">Pending Applications</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-up-left"></em> Pending Partner Applications</div>
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
                    <div class="<?php echo $managementActionItems; ?>">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Partner Accounts</h6>
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-users"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalActivePartners,0); ?>
                                                <small class="fs-14px"> / <?php echo $targetPartners . ' (' . $partnerPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Total Partners</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $managementActionItems; ?>">
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                        <i class="icon icon-md ni ni-coins"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                        <h6>
                                            <?php echo number_format($totalApprovedPartnerAssets,0); ?>
                                            <small class="fs-14px"> / <?php echo $targetPartnerAssets . ' (' . $partnerAssetPercentage . ')'; ?></small>
                                            <br>
                                            <small class="fs-16px">Total Assets</small>
                                        </h6>
                                        <!-- <p class="mb-0">Total Assets</p> -->
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $managementActionItems; ?>">
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-tranx"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalPendingPartners,0); ?>
                                                <small class="fs-14px"> / <?php echo $targetPartners . ' (' . $partnerPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Pending Applications</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $managementActionItems; ?>">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Partner Support</h6>
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-reports"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php echo number_format($totalPendingPartnerSupport,0); ?>
                                                <small class="fs-14px"> / <?php echo $totalCompletePartnerSupport . ' (' . $partnerSupportPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Support Tickets</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $managementActionItems; ?>">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Transactions Fees</h6>
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-users"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php //echo number_format($totalActiveUsers,0); ?>
                                                <small class="fs-14px"> / <?php //echo $targetUsers . ' (' . $usersPercentage . ')'; ?></small>
                                                <br>
                                                <small class="fs-16px">Total Fees</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo $managementActionItems; ?>">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Referrals</h6>
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
                                    <div class="d-flex pb-md-4">
                                        <div class="align-self-center pr-2">
                                            <i class="icon icon-md ni ni-wallet"></i>
                                        </div>
                                        <div class="align-self-center text-end">
                                            <h6>
                                                <?php //echo number_format($totalWalletsCreated,0); ?>
                                                <small class="fs-14px"> / <?php //echo $targetWallets . ' (' . $walletsPercentage . ')'; ?></small>
                                                <br
                                                ><small class="fs-16px">Total Wallets</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <a href="<?php echo site_url('Management/Assets'); ?>" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Manage Assets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="project">
                                    <div class="project-head">
                                        <a href="<?php echo site_url('Management/Assets/Create'); ?>" class="project-title">
                                            <div class="user-avatar sq bg-purple"><span>CA</span></div>
                                            <div class="project-info">
                                                <h6 class="title">Partner Directory</h6>
                                                <!-- <span class="sub-text">Softnio</span> -->
                                            </div>
                                        </a>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="html/apps-kanban.html"><em class="icon ni ni-eye"></em><span>View Project</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Project</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Mark As Done</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-details">
                                        <p>View &amp; Manage the Partnership Directory.</p>
                                    </div>
                                    <div class="project-progress">
                                        <div class="project-progress-details">
                                            <div class="project-progress-task"><em class="icon ni ni-users"></em><span><?php echo $totalActivePartners . ' / ' . $targetPartners; ?></span></div>
                                            <div class="project-progress-percent"><?php echo $partnerPercentage; ?></div>
                                        </div>
                                        <div class="progress progress-pill progress-md bg-light">
                                            <div class="progress-bar" data-progress="<?php echo $partnerPercentage; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="project-met">
                                        <ul class="project-users g-1">
                                            <li>
                                                <a class="btn btn-primary btn-md text-white" href="<?php echo site_url('Management/Partners/Listing'); ?>">View Partners</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <div class="project-meta">
                                        <ul class="project-users g-1">
                                            <li>
                                                <div class="user-avatar sm bg-primary"><span>A</span></div>
                                            </li>
                                            <li>
                                                <div class="user-avatar sm bg-blue"><img src="./images/avatar/b-sm.jpg" alt=""></div>
                                            </li>
                                            <li>
                                                <div class="user-avatar bg-light sm"><span>+12</span></div>
                                            </li>
                                        </ul>
                                        <span class="badge badge-dim bg-warning"><em class="icon ni ni-clock"></em><span>5 Days Left</span></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="project">
                                    <div class="project-head">
                                        <a href="<?php echo site_url('Management/Partners/Assets'); ?>" class="project-title">
                                            <div class="user-avatar sq bg-warning"><span>DA</span></div>
                                            <div class="project-info">
                                                <h6 class="title">Partner Assets</h6>
                                                <!-- <span class="sub-text">Runnergy</span> -->
                                            </div>
                                        </a>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="html/apps-kanban.html"><em class="icon ni ni-eye"></em><span>View Project</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Project</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Mark As Done</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-details">
                                        <p>View and Manage the Partner Asset Directory.</p>
                                    </div>
                                    <div class="project-progress">
                                        <div class="project-progress-details">
                                            <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span>25 Tasks</span></div>
                                            <div class="project-progress-percent">23%</div>
                                        </div>
                                        <div class="progress progress-pill progress-md bg-light">
                                            <div class="progress-bar" data-progress="23"></div>
                                        </div>
                                    </div>
                                    <!-- <div class="project-meta">
                                        <ul class="project-users g-1">
                                            <li>
                                                <div class="user-avatar sm bg-primary"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                            </li>
                                            <li>
                                                <div class="user-avatar sm bg-blue"><span>N</span></div>
                                            </li>
                                        </ul>
                                        <span class="badge badge-dim bg-light text-gray"><em class="icon ni ni-clock"></em><span>21 Days Left</span></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="project">
                                    <div class="project-head">
                                        <a href="html/apps-kanban.html" class="project-title">
                                            <div class="user-avatar sq bg-info"><span>KR</span></div>
                                            <div class="project-info">
                                                <h6 class="title">MyMI Exchange</h6>
                                                <!-- <span class="sub-text">Techyspec</span> -->
                                            </div>
                                        </a>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Project</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Mark As Done</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-details">
                                        <p>Improve SEO keyword research, A/B testing, Local market improvement.</p>
                                    </div>
                                    <div class="project-progress">
                                        <div class="project-progress-details">
                                            <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span>2 Tasks</span></div>
                                            <div class="project-progress-percent">52.5%</div>
                                        </div>
                                        <div class="progress progress-pill progress-md bg-light">
                                            <div class="progress-bar" data-progress="52.5"></div>
                                        </div>
                                    </div>
                                    <!-- <div class="project-meta">
                                        <ul class="project-users g-1">
                                            <li>
                                                <div class="user-avatar sm bg-primary"><img src="./images/avatar/a-sm.jpg" alt=""></div>
                                            </li>
                                        </ul>
                                        <span class="badge badge-dim bg-danger"><em class="icon ni ni-clock"></em><span>Due Tomorrow</span></span>
                                    </div> -->
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
                                            <h6 class="title">Active Partner Assets</h6>
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
                                    <?php $this->load->view('Management/Partners/Listing-Table', $viewFileData); ?>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
