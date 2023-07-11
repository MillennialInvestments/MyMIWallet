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

// Active Users
$totalActiveUsers                   = $reporting['totalActiveUsers']; 
$totalActivePartners                = $reporting['totalActivePartners']; 
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
$totalWalletsCreated                = $reporting['totalWalletsCreated'];

// Percentages
$assetPercentage                    = $reporting['assetPercentage'];
$pendingAssetsPercentage            = $reporting['pendingAssetsPercentage'];
$transactionPercentage              = $reporting['transactionPercentage']; 
$transAmountPercentage              = $reporting['transAmountPercentage']; 
$transFeesPercentage                = $reporting['transFeesPercentage'];
$partnerPercentage                  = $reporting['partnerPercentage'];
$usersPercentage                    = $reporting['usersPercentage'];
$walletsPercentage                  = $reporting['walletsPercentage'];

// Targets
$targetAssets                       = $reporting['targetAssets'];
$targetTransactions                 = $reporting['targetTransactions'];
$targetTransAmount                  = $reporting['targetTransAmount'];
$targetTransFees                    = $reporting['targetTransFees']; 
$targetUsers                        = $reporting['targetUsers'];
$targetPartners                     = $reporting['targetPartners'];
$targetWallets                      = $reporting['targetWallets'];

// Marketing Dashboard Information
$tasks                              = array('Page SEO Edit');
$departmentPendingTasks             = $this->mymianalytics->get_department_tasks($department, $tasks);
// print_r($departmentPendingTasks); 
$getTasksByDepartment               = $departmentPendingTasks['getTasksByDepartment'];
$totalDepartmentTasks               = $departmentPendingTasks['totalTasks'];
$totalPageSEOTasks                  = $departmentPendingTasks['totalTasksByType']['Page SEO Edit']; 

$marketingDepartment                = $this->mymimarketing->marketing(); 
$getActiveCampaigns                 = $marketingDepartment['department']['getActiveCampaigns']; 
$totalActiveCampaigns               = $marketingDepartment['department']['totalActiveCampaigns']; 
// !!! FIX THE BELOW TO REACHOUT TO MYMIMARKETING LIBRARY FOR DATA
$marketingUsersGained               = 0;
$marketingImpressions               = 0;
// !!! FIX ENDS HERE
// print_r($getActiveCampaigns);
$viewFileData                       = array(
    'getApprovedAssets'             => $getApprovedAssets,
    'getActiveCampaigns'            => $getActiveCampaigns,
    'totalActiveUsers'              => $totalActiveUsers,
    'marketingUsersGained'          => $marketingUsersGained,
    'marketingImpressions'          => $marketingImpressions,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">MyMI Management - <?php echo $pageURIB . ' ' . str_replace('-', ' ', $pageURIC); ?></h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<a href="<?php echo site_url('/Management/Marketing'); ?>">Back to Marketing Dashboard</a>							
					</div>
				</div>
			</div>
			<div class="nk-block">
                <div class="row">
                    <!-- Action Center -->
                    <div class="col-lg-4">
                        <?php $this->load->view('Management/Marketing/Campaigns/action_center', $viewFileData); ?>
                    </div><!-- .col -->
                    <!-- Month-to-Month Overview -->
                    <div class="col-lg-8">
                        <?php $this->load->view('Management/Marketing/Campaigns/monthly_overview', $viewFileData); ?>
                    </div>
                </div>
			</div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->load->view('Management/Marketing/Campaigns/Listing-Table', $viewFileData); ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
