<?php
$today                              = date("m/d/Y"); 
$month                              = date("n"); 
$day                                = date("d");
$year                               = date("Y"); 
$last_month                         = strtotime($month . ' - 1 month');
$pageURIA                           = $this->uri->segment(1);
$pageURIB                           = $this->uri->segment(2);
$pageURIC                           = $this->uri->segment(3);
$this->db->from('bf_support_requests');
$this->db->where('topic', $pageURIB); 
$getSupportRequests                 = $this->db->get()->result_array(); 
// print_r($getSupportRequests); 
$totalPendingSupport                = 0;  
$totalCompleteSupport               = 0;  
$highSeverity                       = 0;  
$highSeverityResolved               = 0;
$mostFrequentlyAskedCount           = 0; 
// print_r($getSupportRequests); 
foreach($getSupportRequests as $requests) {
    // print_r($requests); 
    if ($requests['level'] === 'Normal') {
        if ($requests['status']         === 'Pending') {
            $totalPendingSupport++; 
        } elseif ($requests['status']   === 'Complete') {
            $totalCompleteSupport++; 
        } 
    } elseif ($requests['level']    === 'High') {
        if ($requests['status'] === 'Pending') {
            $highSeverity++; 
        } elseif ($requests['status'] === 'Complete') {
            $highSeverityResolved++;
        }
    } 
}
if ($pageURIB === 'Assets') {
    $dashboardTitle                 = 'Assets /';
    $dashboardSubtitle              = 'Support Management'; 
} elseif ($pageURIB === 'Support') {
    $dashboardTitle                 = 'Support /';
    $dashboardSubtitle              = 'Management Dashboard'; 
}
$viewFileData                       = array(
    'getSupportRequests'            => 
)
// $highSeverity                       = 0;
$lastHighSeverity                   = 0; 
// $highSeverityResolved               = 0; 
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
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
                                </div>
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-help-fill"></em>
                                            <div class="title">Support Requests</div>
                                            <p>There is <strong><?php echo $totalPendingSupport; ?></strong> pending requests and <strong><?php echo $totalCompleteSupport; ?></strong> completed requests. </p>
                                        </div>
                                        <a href="<?php echo site_url('Management/Assets/Support/Requests'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-wallet-fill"></em>
                                            <div class="title">High Severity Issues</div>
                                            <p>We have a total of <strong><?php echo $highSeverity; ?> High Severity Requests</strong>, and a total of <strong><?php echo $highSeverityResolved; ?></strong> Total Requests Completed.</p>
                                        </div>
                                        <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                    </div>
                                </div><!-- .card-inner -->
                                <!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="nk-wg-action">
                                        <div class="nk-wg-action-content">
                                            <em class="icon ni ni-cc-alt-fill"></em>
                                            <div class="title">Most Frequent Question/Issue</div>
                                            <p>
                                                <!-- <strong>Question:</strong> <?php //echo $mostFrequentlyAsked; ?><br>
                                                <strong>Total Requests:</strong> <?php //echo $mostFrequentlyAskedCount; ?> -->
                                            </p>
                                        </div>
                                        <a href="<?php echo site_url('/Management/Assets'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
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
                                                        <div class="amount"><?php echo $highSeverity; ?> <small class="currenct currency-usd">Requests</small></div>
                                                        <div class="info">Last month <strong><?php echo $highSeverityResolved; ?> <span class="currenct currency-usd"> Requests</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total High Severity Requests</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xxl-12">
                                                    <div class="nk-order-ovwg-data sell">
                                                        <div class="amount"><?php echo $totalCompleteSupport; ?> <small class="currenct currency-usd">Requests</small></div>
                                                        <div class="info">Last month <strong><?php echo $totalPendingSupport; ?> <span class="currenct currency-usd">Requests</span></strong></div>
                                                        <div class="title"><em class="icon ni ni-arrow-up-left"></em> Monthly Total Requests</div>
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
                
				<?php
                ?>
			</div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-bordered h-100">
                            <div class="card-inner-group">
                                <div class="card-inner card-inner-md">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Support Requests</h6>
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
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
            <?php $this->load->view('Management/Support/Requests/Listing-Table', $getSupportRequests); ?>
		</div>
	</div>
</div>
