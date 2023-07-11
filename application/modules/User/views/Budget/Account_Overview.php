<?php
<<<<<<< HEAD
$managementActionItems = $this->config->item('managementActionItems');
$userAccount = $_SESSION['allSessionData']['userAccount'];
$cuID = $userAccount['cuID'];
$accountType = $this->uri->segment(2);

if ($accountType === 'Expenses') {
    $accountType = 'Expense';
}

$startOfCurrentPeriod = date('Y-m-d H:i:s', strtotime(date('Y-m-01')));
$totalIncome = 0;
$totalLastIncome = 0;
$totalExpenses = 0;
$threeMonthExpenses = $totalExpenses * 3;
$sixMonthExpenses = $totalExpenses * 3;
$twelveMonthExpenses = $totalExpenses * 3;
$totalLastExpenses = 0;
$totalSurplus = $totalIncome - $totalExpenses;
$totalInvestPercentage = 0;
$totalInvestment = $totalSurplus * $totalInvestPercentage;

$this->db->from('bf_users_budgeting');
$this->db->where('status', 1);
$this->db->where('account_type', $accountType);
$this->db->where('created_by', $cuID);
$getSources = $this->db->get();
$sources = [];
$lastSources = []; 
$totalSourceBreakdown = 0;
$totalSourceAccount = 0;

function calculateChange($current, $last)
{
    if ($last == 0) {
        return $current * 100;
    }
    return (($current - $last) / $last) * 100;
}

foreach ($getSources->result_array() as $source) {
    $sourceType = $source['source_type'];
    $amount = $source['net_amount'];
    $totalSourceAccount += $amount;
    if (!array_key_exists($sourceType, $sources)) {
        $sources[$sourceType] = 0;
    }
    $sources[$sourceType] += $amount;
}

$sourceBreakdown = [];
$colors = ["#798bff", "#baaeff", "#7de1f8"];
$colorIndex = 0;

$uniqueSources = []; // Array to store unique source types

foreach ($getSources->result_array() as $source) {
    $sourceType = $source['source_type'];
    $amount = $source['net_amount'];

    if (!isset($uniqueSources[$sourceType])) {
        $uniqueSources[$sourceType] = $amount;

        $totalSourceAccount += $amount;

        $lastAmount = array_key_exists($sourceType, $lastSources) ? $lastSources[$sourceType] : 0;
        $change = calculateChange($amount, $lastAmount);

        $percentage = ($amount / $totalSourceAccount) * 1000;
        $sourceBreakdown[] = [
            'source_type' => $sourceType,
            'percentage' => number_format($percentage, 2),
            'color' => $colors[$colorIndex],
            'change' => number_format($change, 2)
        ];

        $colorIndex = ($colorIndex + 1) % count($colors);
    }
}

$viewFileData = [
    'accountType' => $accountType,
    'totalIncome' => $totalIncome,
    'totalLastIncome' => $totalLastIncome,
    'totalExpenses' => $totalExpenses,
    'totalLastExpenses' => $totalLastExpenses,
    'totalSurplus' => $totalSurplus,
    'totalInvestment' => $totalInvestment,
    'getSources' => $getSources,
    'sourceBreakdown' => $sourceBreakdown,
];

// print_r($viewFileData);

?><style>.nk-order-ovwg-data.income{border-color:#8ff0d6}.nk-order-ovwg-data.expenses{border-color:#e85347}.nk-order-ovwg-data.surplus{border-color:#84b8ff}.nk-order-ovwg-data.investments{border-color:#f4bd0e}</style>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-4">
            <?php $this->load->view('Budget/Account_Overview/action_center', $viewFileData); ?>
        </div>
        <div class="col-lg-8">
            <?php $this->load->view('Budget/Account_Overview/monthly_overview', $viewFileData); ?>
=======
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems'); 

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
                                    <canvas class="order-overview-chart" id="orderOverview"></canvas>
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        </div>
    </div>
</div>
<div class="nk-block">
    <div class="row">
<<<<<<< HEAD
        <div class="col-lg-4 col-sm-6">
            <?php $this->load->view('Budget/Account_Overview/source_breakdown', $viewFileData); ?>
        </div>
        <div class="col-lg-8 col-sm-6">
            <?php $this->load->view('Budget/Account_Overview/history_overview', $viewFileData); ?>
        </div>
    </div>
</div>
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
