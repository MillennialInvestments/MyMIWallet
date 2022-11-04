<?php
$today                              = date("m/d/Y"); 
$month                              = date("n"); 
$day                                = date("d");
$year                               = date("Y"); 
$last_month                         = strtotime($month . ' - 1 month');
$this->db->from('bf_exchanges_listing_request');
$this->db->where('date', $today); 
$this->db->where('status !=', 'Viewed');
$getPendingAssets                   = $this->db->get(); 
$totalPendingAssets                 = $getPendingAssets->num_rows(); 
$this->db->from('bf_exchanges_assets');
$this->db->where('date', $today); 
$this->db->where('status', 'Approved');
$getApprovedAssets                  = $this->db->get(); 
$totalApprovedAssets                = $getApprovedAssets->num_rows(); 
$this->db->from('bf_support_requests');
$this->db->where('date', $today); 
$this->db->where('status', 'Pending');
$getPendingSupport                  = $this->db->get(); 
$totalPendingSupport                = $getPendingSupport->num_rows(); 
$this->db->from('bf_support_requests');
$this->db->where('date', $today); 
$this->db->where('status', 'Complete');
$getCompleteSupport                  = $this->db->get(); 
$totalCompleteSupport                = $getCompleteSupport->num_rows(); 
$this->db->from('bf_exchanges_orders');
// $this->db->where('month', $month); 
// $this->db->where('day', $day); 
// $this->db->where('year', $year); 
$this->db->where('status', 'Closed');
$getTotalTrans                      = $this->db->get(); 
$totalTransactions                  = $getTotalTrans->num_rows(); 
$this->db->select_sum('amount');
$this->db->select_sum('fees');
$this->db->from('bf_exchanges_orders');
// $this->db->where('month', $month); 
// $this->db->where('day', $day); 
// $this->db->where('year', $year); 
$this->db->where('status', 'Closed');
$getTotalAmounts                    = $this->db->get(); 
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
}
$this->db->select_sum('amount');
$this->db->select_sum('fees');
$this->db->from('bf_exchanges_orders');
// $this->db->where('month', $last_month); 
// $this->db->where('year', $year); 
$this->db->where('status', 'Closed');
$getLastTotalAmounts                = $this->db->get(); 
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
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">MyMI Management</h1>
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
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
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
                            </div>
                            <header class="title-header">
                                <h3>Movie Title</h3>
                            </header>
                            <div class="card-block">
                                <div class="img-card">
                                    <img src="//placehold.it/300x250" alt="Movie" class="w-100" />
                                </div>
                                <p class="tagline card-text text-xs-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <article class="card">
                            <header class="title-header">
                                <h3>Movie Title</h3>
                            </header>
                            <div class="card-block">
                                <div class="img-card">
                                    <img src="https://placehold.it/300x250" alt="Movie" class="w-100" />
                                </div>
                                <p class="tagline card-text text-xs-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <article class="card">
                            <header class="title-header">
                                <h3>Movie Title</h3>
                            </header>
                            <div class="card-block">
                                <div class="img-card">
                                    <img src="https://placehold.it/300x250" alt="Movie" class="w-100" />
                                </div>
                                <p class="tagline card-text text-xs-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <article class="card">
                            <header class="title-header">
                                <h3>Movie Title</h3>
                            </header>
                            <div class="card-block">
                                <div class="img-card">
                                    <img src="https://placehold.it/300x250" alt="Movie" title="Movie" class="w-100" />
                                </div>
                                <p class="tagline card-text text-xs-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
