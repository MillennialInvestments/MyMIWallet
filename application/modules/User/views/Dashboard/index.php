<?php /* /users/views/user_fields.php */
$allSessionData                                 = $_SESSION['allSessionData'];
$userAccount                                    = $allSessionData['userAccount'];
$userBudget                                     = $allSessionData['userBudget'];
// print_r($userBudget);
$myMIWalletSummary                              = $allSessionData['myMIWalletSummary'];
// User Account Configurations
$cuID									        = $userAccount['cuID'];
$cuRole									        = $userAccount['cuRole'];
$cuEmail								        = $userAccount['cuEmail'];
$cuWalletID								        = $userAccount['cuWalletID'];
$cuWalletCount							        = $userAccount['cuWalletCount'];
$cuTotalWalletCount						        = $userAccount['cuTotalWalletCount'];
$cuKYC                                          = $userAccount['cuKYC'];
// User Budget Configurations
$budgetOverallBalance                           = $userBudget['accountSurplus'];
$budgetIncome                                   = $userBudget['incomeAccountSummary']['income'];
$thisMonthIncome                                = $userBudget['incomeAccountSummary']['thisMonthIncome'];
$lastMonthIncome                                = $userBudget['incomeAccountSummary']['lastMonthIncome'];
$momIncomeAverages                              = number_format($userBudget['incomeAccountSummary']['momIncomeAverages'],2);
$budgetExpenses                                 = $userBudget['expenseAccountSummary']['expenses'];
$thisMonthExpenses                              = $userBudget['expenseAccountSummary']['thisMonthExpenses'];
$lastMonthExpenses                              = $userBudget['expenseAccountSummary']['lastMonthExpenses'];
$momExpenseAverages                             = number_format($userBudget['expenseAccountSummary']['momExpenseAverages'],2);
// MyMI Wallet Configurations
$walletID								        = $userAccount['walletID'];
$walletTitle							        = $userAccount['walletTitle'];
$walletBroker							        = $userAccount['walletBroker'];
$walletNickname							        = $userAccount['walletNickname'];
$walletDefault							        = $userAccount['walletDefault'];
$walletExchange							        = $userAccount['walletExchange'];
$walletMarketPair						        = $userAccount['walletMarketPair'];
$walletMarket							        = $userAccount['walletMarket'];
$walletFunds							        = $userAccount['walletFunds'];
$walletInitialAmount					        = $userAccount['walletInitialAmount'];
$walletAmount							        = $userAccount['walletAmount'];
$walletPercentChange					        = $userAccount['walletPercentChange'];
$walletGains							        = $userAccount['walletGains'];
$depositAmount							        = $userAccount['depositAmount'];
$withdrawAmount							        = $userAccount['withdrawAmount'];
// MyMI Coin Configurations
$MyMICoinValue							        = $userAccount['MyMICoinValue'];
$MyMICCurrentValue						        = $userAccount['MyMICCurrentValue'];
$MyMICCoinSum							        = $userAccount['MyMICCoinSum'];
// MyMI Gold Configurations
$MyMIGoldValue							        = $userAccount['MyMIGoldValue'];
$MyMIGCurrentValue						        = $userAccount['MyMIGCurrentValue'];
$MyMIGCoinSum							        = $userAccount['MyMIGCoinSum'];
// User Trade Activity Configurations
$lastTradeActivity                              = $userAccount['lastTradeActivity'];
// $walletData							    	= $userAccount['walletData'];
$getWallets								        = $userAccount['getWallets'];
$walletSum                                      = $myMIWalletSummary['walletSum'];
$assetNetValue                                  = $userAccount['assetNetValue'];
$assetTotalCount                                = $userAccount['assetTotalCount'];
$assetTotalGains                                = $userAccount['assetTotalGains'];
// Product/Service Costing Configurations
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
$totalFinancialBalance                          = '$' . number_format($budgetOverallBalance,2);
$lastAccountBalance                             = '0.00';
$investmentBalance                              = '0.00';
$totalInvestmentBalance                         = '$' . $investmentBalance;
$totalAccountBalance                            = '$' . number_format($budgetOverallBalance + $investmentBalance, 2); 
$totalMonthlyIncome                             = '$' . number_format($thisMonthIncome, 2); 
$totalAnnualIncome                              = '$' . number_format($budgetIncome, 2); 
$totalLastMonthIncome                           = '$' . number_format($lastMonthIncome, 2); 
$totalMonthlyExpenses                           = '$' . number_format($thisMonthExpenses, 2); 
$totalAnnualExpenses                            = '$' . number_format($budgetExpenses, 2); 
$totalLastMonthExpenses                         = '$' . number_format($lastMonthExpenses, 2); 
$activeInvestmentTotals                         = '0.00';
$activeInvestmentPercent                        = '0.00';
if ($activeInvestmentPercent > 0) {
    $activeInvestmentGains                      = $activeInvestmentPercent . '%';
    $activeInvestGainsClassA                    = 'change up text-success';
    $activeInvestGainsClassB                    = 'icon ni ni-arrow-long-up';
} elseif ($activeInvestmentPercent < 0) {
    $activeInvestmentGains                      = $activeInvestmentPercent . '%';
    $activeInvestGainsClassA                    = 'change up text-danger';
    $activeInvestGainsClassB                    = 'icon ni ni-arrow-long-down';
} else {
    $activeInvestmentGains                      = $activeInvestmentPercent . '%';
    $activeInvestGainsClassA                    = 'change text-muted';
    $activeInvestGainsClassB                    = 'icon ni ni-arrow-minus';
}
$activeMonthlyInvestPercent                        = '0.00';
if ($activeMonthlyInvestPercent > 0) {
    $activeMonthlyInvestGains                      = $activeMonthlyInvestPercent . '%';
    $activeMonthlyInvestGainsClassA                    = 'change up text-success';
    $activeMonthlyInvestGainsClassB                    = 'icon ni ni-arrow-long-up';
} elseif ($activeMonthlyInvestPercent < 0) {
    $activeMonthlyInvestGains                      = $activeMonthlyInvestPercent . '%';
    $activeMonthlyInvestGainsClassA                    = 'change up text-danger';
    $activeMonthlyInvestGainsClassB                    = 'icon ni ni-arrow-long-down';
} else {
    $activeMonthlyInvestGains                      = $activeMonthlyInvestPercent . '%';
    $activeMonthlyInvestGainsClassA                    = 'change text-muted';
    $activeMonthlyInvestGainsClassB                    = 'icon ni ni-arrow-minus';
}
$activeTotalTrades                              = '0';
$activeInvestmentProfits                        = '0.00';
$activeMonthlyInvestments                       = '0.00';
$activeMonthyTrades                             = '0';

<<<<<<< HEAD
$emergencyFundTarget                            = $thisMonthExpenses * 6; 
$emergencyFundPercentage                        = '0.00'; 
$totalDebt                                      = $userBudget['debtAccountSummary']['totalDebt'];
// $debtTotalPercentage                            = $userBudget['debtTotalPercentage'];
$dashboardData							        = array(
    'getWallets'						        => $getWallets,
    'cuID'								        => $cuID,
    'cuEmail'							        => $cuEmail,
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
    'totalAnnualIncome'                         => $totalAnnualIncome,  
    'totalMonthlyIncome'                        => $totalMonthlyIncome,  
    'totalLastMonthIncome'                      => $totalLastMonthIncome,  
    'momIncomeAverages'                         => $momIncomeAverages,
    'totalAnnualExpenses'                       => $totalAnnualExpenses,  
    'totalMonthlyExpenses'                      => $totalMonthlyExpenses,  
    'totalLastMonthExpenses'                    => $totalLastMonthExpenses,  
    'momExpenseAverages'                        => $momExpenseAverages,
    'activeInvestmentTotals'                    => $activeInvestmentTotals,
    'activeInvestGainsClassA'                   => $activeInvestGainsClassA,
    'activeInvestGainsClassB'                   => $activeInvestGainsClassB,
    'activeInvestmentGains'                     => $activeInvestmentGains,
    'activeTotalTrades'                         => $activeTotalTrades,
    'activeInvestmentProfits'                   => $activeInvestmentProfits,
    'activeMonthlyInvestments'                  => $activeMonthlyInvestments,
    'activeMonthlyInvestGainsClassA'            => $activeMonthlyInvestGainsClassA,
    'activeMonthlyInvestGainsClassB'            => $activeMonthlyInvestGainsClassB,
    'activeMonthlyInvestGains'                  => $activeMonthlyInvestGains,
    'activeMonthyTrades'                        => $activeMonthyTrades,
    'budgetIncome'                              => $budgetIncome,
    'budgetExpenses'                            => $budgetExpenses,
    'emergencyFundTarget'                       => $emergencyFundTarget,
    'emergencyFundPercentage'                   => $emergencyFundPercentage,
    'totalDebt'                                 => $totalDebt,
    // 'debtTotalPercentage'                       => $debtTotalPercentage,
);
print_r($dashboardData);
?>   
=======
$walletCost								= $this->config->item('wallet_cost');  			 		// $5
$gas_fee								= $this->config->item('gas_fee');
$trans_fee								= $this->config->item('trans_fee');
$trans_percent							= $this->config->item('trans_percent');
$expenses								= ($walletCost * $trans_percent) + $trans_fee;			// Total Fees
$total_fees								= number_format($expenses, 2);
$fee_coins								= round(($MyMICoinValue), 8);
$walletCoins							= ($walletCost / $MyMICoinValue) + $fee_coins;
$remainingCoins							= $MyMICCoinSum - $walletCoins;
$dashboardData							= array(
	'getWallets'						=> $getWallets,
	'cuID'								=> $cuID,
	'cuWalletCount'						=> $cuWalletCount,
	'cuTotalWalletCount'				=> $cuTotalWalletCount,
	'walletID'							=> $walletID,
	'walletTitle'						=> $walletTitle,
	'walletAmount'						=> $walletAmount,
	'walletFunds'						=> $walletFunds,
	'walletGains'						=> $walletGains,
	'MyMICCoinSum'						=> $MyMICCoinSum,
	'MyMICCurrentValue'					=> $MyMICCurrentValue,
	'MyMIGCoinSum'						=> $MyMIGCoinSum,
	'MyMIGCurrentValue'					=> $MyMIGCurrentValue,
	'lastTradeActivity'					=> $lastTradeActivity,
	'walletCost'						=> $walletCost,
	'walletCoins'						=> $walletCoins,
	'walletSum'                         => $walletSum,
	'assetNetValue'                     => $assetNetValue,
	'assetTotalCount'                   => $assetTotalCount,
	'assetTotalGains'                   => $assetTotalGains,
);
?>
>>>>>>> 0602759db180cc3e843f37d0f6b332b2d117db5c
<style>
	.tranx-amount .number {
		font-size: 0.87em;
	}
</style>
<<<<<<< HEAD

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
                                        <li><a href="<?php echo site_url('Budget/Add/Income'); ?>"><em class="icon ni ni-plus-c"></em><span>Add Income Account</span></a></li>
                                        <li><a href="<?php echo site_url('Budget/Add/Expense'); ?>"><em class="icon ni ni-minus-c"></em><span>Add Expense Account</span></a></li>
                                        <!-- <li><a href="#"><em class="icon ni ni-note-add-fill-c"></em><span>Add Page</span></a></li> -->
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
            <?php $this->load->view('User/Dashboard/index-new/investment_overview', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <?php $this->load->view('User/Dashboard/index-new/investment_plan', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <?php $this->load->view('User/Dashboard/index-new/support_requests', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <?php $this->load->view('User/Dashboard/index-new/recent_activities', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <?php $this->load->view('User/Dashboard/index-new/notifications', $dashboardData); ?>
        </div><!-- .col -->        
		<div class="col-md-12 mb-3">  
=======
<div>TESTTESTETSETTEST TEST</div>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">
			<?php $this->load->view('User/Dashboard/index/header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/financial_overview', $dashboardData); ?>
			<?php
			if (!empty($assetNetValue)) {
				$this->load->view('User/Dashboard/index/asset_overview', $dashboardData);
			}
			?>
		</div>
		<div class="col-12 col-md-9">
			<?php //$this->load->view('User/Dashboard/index/Announcements'); 
			?>
			<?php $this->load->view('User/Dashboard/index/Balances', $dashboardData); ?>
		</div>
	</div>
</div>
<hr class="my-5">
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">
>>>>>>> 0602759db180cc3e843f37d0f6b332b2d117db5c
			<?php $this->load->view('User/Dashboard/index/market-header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/US_Market_Overview'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/US_Additional_Overview'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/International_Market_Overview'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/Crypto_Market_Overview'); ?>
		</div>
<<<<<<< HEAD
    </div>
</div>


=======
	</div>
</div>
>>>>>>> 0602759db180cc3e843f37d0f6b332b2d117db5c
