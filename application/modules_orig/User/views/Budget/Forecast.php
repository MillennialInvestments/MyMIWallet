<?php
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems'); 

// User Account Information
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$cuID                               = $userAccount['cuID'];
// Page Configuration
$accountType                        = $this->uri->segment(2); 
$totalIncome                        = 0;
$totalLastIncome                    = 0; 
$totalExpenses                      = 0;
$threeMonthExpenses                 = $totalExpenses * 3; 
$sixMonthExpenses                   = $totalExpenses * 3; 
$twelveMonthExpenses                = $totalExpenses * 3; 
$totalLastExpenses                  = 0;
$totalSurplus                       = $totalIncome - $totalExpenses;
$totalInvestPercentage              = 0;
$totalInvestment                    = $totalSurplus * $totalInvestPercentage;           
$firstBudgetAccount                 = $this->mymibudget->get_first_budget_account($cuID);
$firstMonth                         = $firstBudgetAccount['firstAccountMonth'];
// echo $firstMonth . '<br>';
$monthA                             = $firstMonth;
// echo $monthA . '<br>';
$monthB                             = $firstMonth + 1;
if ($monthB > 0 && $monthB <= 12) {
    $monthB                         = $monthB;    
} else {
    $monthB                         = 1;
}
// echo $monthB . '<br>';
$monthC                             = $monthB + 1;
if ($monthC > 0 && $monthC <= 12) {
    $monthC                         = $monthC;    
} else {
    $monthC                         = 1;
}
// echo $monthC . '<br>';
$monthD                             = $monthC + 1;
if ($monthD > 0 && $monthD <= 12) {
    $monthD                         = $monthD;    
} else {
    $monthD                         = 1;
}
// echo $monthD . '<br>';
$monthE                             = $monthD + 1;
if ($monthE > 0 && $monthE <= 12) {
    $monthE                         = $monthE;    
} else {
    $monthE                         = 1;
}
// echo $monthE . '<br>';
$monthF                             = $monthE + 1;
if ($monthF > 0 && $monthF <= 12) {
    $monthF                         = $monthF;    
} else {
    $monthF                         = 1;
}
// echo $monthF . '<br>';
$monthG                             = $monthF + 1;
if ($monthG > 0 && $monthG <= 12) {
    $monthG                         = $monthG;    
} else {
    $monthG                         = 1;
}
// echo $monthG . '<br>';
$monthH                             = $monthG + 1;
if ($monthH > 0 && $monthH <= 12) {
    $monthH                         = $monthH;    
} else {
    $monthH                         = 1;
}
// echo $monthH . '<br>';
$monthI                             = $monthH + 1;
if ($monthI > 0 && $monthI <= 12) {
    $monthI                         = $monthI;    
} else {
    $monthI                         = 1;
}
// echo $monthI . '<br>';
$monthJ                             = $monthI + 1;
if ($monthJ > 0 && $monthJ <= 12) {
    $monthJ                         = $monthJ;    
} else {
    $monthJ                         = 1;
}
// echo $monthJ . '<br>';
$monthK                             = $monthJ + 1;
if ($monthK > 0 && $monthK <= 12) {
    $monthK                         = $monthK;    
} else {
    $monthK                         = 1;
}
// echo $monthK . '<br>';
$monthL                             = $monthK + 1;
if ($monthL > 0 && $monthL <= 12) {
    $monthL                         = $monthL;    
} else {
    $monthL                         = 1;
}
$monthASum                          = 0; 
$monthBSum                          = 0; 
$monthCSum                          = 0; 
$monthDSum                          = 0; 
$monthESum                          = 0; 
$monthFSum                          = 0; 
$monthGSum                          = 0; 
$monthHSum                          = 0; 
$monthISum                          = 0; 
$monthJSum                          = 0; 
$monthKSum                          = 0; 
$monthLSum                          = 0; 
// echo $monthL . '<br>';
$userBudgetAccounts                 = $this->mymibudget->get_user_budget_accounts($cuID);
$getUserBudgetAccounts              = $userBudgetAccounts['getUserBudgetAccounts'];

foreach($userBudgetAccounts['getUserBudgetAccounts'] as $budgetAccounts) {
    if ($budgetAccounts['account_type'] === 'Income') {
        $accountSum                 = $budgetAccounts['net_amount']; 
    } elseif ($budgetAccounts['account_type'] === 'Expense') {
        $accountSum                 = '-' . $budgetAccounts['net_amount']; 
    }
    if ($budgetAccounts['month'] === $monthA) {
        $monthASum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthB) {
        $monthBSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthC) {
        $monthCSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthD) {
        $monthDSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthE) {
        $monthESum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthF) {
        $monthFSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthG) {
        $monthGSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthH) {
        $monthHSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthI) {
        $monthISum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthJ) {
        $monthJSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthK) {
        $monthKSum                  += $accountSum;
    }
    if ($budgetAccounts['month'] === $monthL) {
        $monthLSum                  += $accountSum;
    }
}
?>
<style>
    .nk-order-ovwg-data.income {
        border-color: #8ff0d6;
    }
    .nk-order-ovwg-data.expenses {
        border-color: #e85347;
    }
    .nk-order-ovwg-data.surplus {
        border-color: #84b8ff;
    }
    .nk-order-ovwg-data.investments {
        border-color: #f4bd0e;
    }
</style>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-bordered h-100">
                <div class="card-inner-group">
                    <div class="card-inner card-inner-md">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title"><?php echo $accountType; ?> Action Center</h6>
                            </div>
                            <div class="card-tools me-n1">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
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
                                <div class="title">Add/Edit Income</div>
                                <p><a href="<?php echo site_url('/Budget/Add/Income'); ?>"><strong>Manage Income Accounts</strong></a> to manage your Monthly Income Accounts.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Income'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-help-fill"></em>
                                <div class="title">Add/Edit Expenses</div>
                                <p><a href="<?php echo site_url('/Budget/Add/Expense'); ?>"><strong>Manage Expense Accounts</strong></a> to manage your Monthly Expense Accounts.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Income/Settings'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-wallet-fill"></em>
                                <div class="title">Investment Opportunities</div>
                                <p>View and Manage your <a href="<?php echo site_url('Management/Assets/Transactions'); ?>"><strong><?php //echo $totalTransactions; ?> Potential Investments</strong></a>.</p>
                            </div>
                            <a href="<?php echo site_url('Management/Assets/Transactions'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div> 
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-wallet-fill"></em>
                                <div class="title">Need Support?</div>
                                <p>View and Manage your <a href="<?php echo site_url('Management/Assets/Transactions'); ?>"><strong><?php //echo $totalTransactions; ?>Active Support Requests</strong></a>.</p>
                            </div>
                            <a href="<?php echo site_url('Management/Assets/Transactions'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
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
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
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
                            <div class="col-12">
                                <div class="nk-order-ovwg-ck">
                                    <canvas class="bar-chart chartjs-render-monitor" id="barChartMultiple" width="424" height="180" style="display: block; width: 424px; height: 180px;"></canvas>
                                </div>
                            </div><!-- .col -->
                            <div class="col-12">
                                <div class="row g-4">
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="<?php echo site_url('Budget/Income'); ?>">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalIncome; ?> <small class="currenct currency-usd">USD</small></div>
                                                <div class="info">Last month <strong><?php echo $totalLastIncome; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-down-left"></em> Monthly Income</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="<?php echo site_url('Budget/Expenses'); ?>">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalExpenses; ?> <small class="currenct currency-usd">USD</small></div>
                                                <div class="info">Last month <strong><?php echo $totalLastExpenses; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Monthly Expenses</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalSurplus; ?> <small class="currenct currency-usd">USD</small></div>
                                                <div class="info">Last month <strong><?php echo $totalLastIncome; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-down-left"></em> Monthly Surplus</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalInvestment; ?> <small class="currenct currency-usd">USD</small></div>
                                                <div class="info">Last month <strong><?php echo $totalLastExpenses; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Investments</div>
                                            </div>
                                        </a>
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
                <div class="card-inner">
                    <div class="nk-order-ovwg">
                        <div class="row g-4 align-end">
                            <div class="col-12 pr-3">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Monthly Expense Overview</h6>
                                        <p>Last 12 Months of Total Monthly Spend &amp; Total Transaction Fees.</p>
                                    </div>
                                    <div class="card-tools mt-n1 me-n1">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                    <li><a href="#"><span>3 Months</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table default" id="userBudgetingIncomeDatatable">
                                    <thead>
                                        <tr>
                                            <th>Account Name</th>
                                            <th>Source</th>
                                            <th>Pay Schedule</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $this->db->from('bf_users_budgeting');
                                        $this->db->where('status', 'Active');
                                        $this->db->where('account_type', $accountType); 
                                        $getIncomeAccounts        = $this->db->get();
                                        foreach($getIncomeAccounts->result_array() as $income) {
                                            echo '
                                        <tr>
                                            <td>' . $income['name'] . '</td>
                                            <td>' . $income['source_type'] . '</td>
                                            <td>' . $income['intervals'] . '</td>
                                            <td>' . $income['amount'] . '</td>
                                        </tr>
                                            ';
                                        }; 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- .nk-order-ovwg -->
                </div><!-- .card-inner -->
            </div><!-- .card -->
        </div>
    </div>
</div>