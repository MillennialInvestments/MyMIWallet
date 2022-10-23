<?php
// User Account Information
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$userBudget                         = $_SESSION['allSessionData']['userBudget'];
// print_r($userAccount);
$cuID                               = $userAccount['cuID'];
// Time Configurations
$current_year                       = date('Y');
$end_of_year                        = date('m/d/Y', strtotime('12/31'));
$current_date                       = date('m/d/Y');
$daysLeft                           = date('dd', strtotime($end_of_year)) - date('dd', strtotime($current_date));
$weeksLeft                          = date('W', strtotime($end_of_year)) - date('W', strtotime($current_date));
$monthsLeft                         = date('m', strtotime($end_of_year)) - date('m', strtotime($current_date));
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems');
// Budget Configurations/Variables
$income                             = $userBudget['incomeAccountSummary']['income'];
$expenses                           = $userBudget['expenseAccountSummary']['expenses'];
$totalIncome                        = '$' . number_format($income, 2);
$lastMonthIncome                    = $userBudget['incomeAccountSummary']['lastMonthIncome']; 
$totalLastIncome                    = 0;
$totalExpenses                      = '-$' . number_format($expenses, 2);
// $threeMonthExpenses                 = $totalExpenses * 3;
// $sixMonthExpenses                   = $totalExpenses * 3;
// $twelveMonthExpenses                = $totalExpenses * 3;
$lastMonthExpenses                  = $userBudget['expenseAccountSummary']['lastMonthExpenses'];
$surplus                            = $income - $expenses;
$totalSurplus                       = '$' . number_format($surplus,2);
$totalSavingsPerMonth               = number_format($surplus / $monthsLeft,2);
$totalInvestPercentage              = 0.2;
$totalInvestment                    = '$' . number_format($surplus * $totalInvestPercentage,2);
$totalInvestmentPerMonth            = '$' . number_format(($surplus * $totalInvestPercentage) / $monthsLeft,2);

// echo $totalIncome;
// echo $totalExpenses;
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
    .nk-order-ovwg-data .amount {
        font-size: 1.25rem;
        font-weight: 700;
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
                                <h6 class="title">Action Center</h6>
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
                                <div class="title">Manage Income</div>
                                <p>Add <a href="<?php echo site_url('/Budget/Add/Income'); ?>"><strong>Income Accounts</strong></a> to update your Monthly Income Accounts.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Add/Income'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-help-fill"></em>
                                <div class="title">Manage Expenses</div>
                                <p>Add <a href="<?php echo site_url('/Budget/Add/Expense'); ?>"><strong>Expense Accounts</strong></a> to update your Monthly Expense Budget.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Add/Expense'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-wallet-fill"></em>
                                <div class="title">Investment Opportunities</div>
                                <p>View, manage and track your <a href="<?php echo site_url('Exchanges'); ?>"><strong><?php //echo $totalTransactions; ?> Financial Investments Opportunities</strong></a>.</p>
                            </div>
                            <a href="<?php echo site_url('Exchanges'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-wallet-fill"></em>
                                <div class="title">Need Support?</div>
                                <p>View and manage your <a href="<?php echo site_url('Support/My-Requests'); ?>"><strong><?php //echo $totalTransactions; ?>Active Support Requests</strong></a> for additional assistance.</p>
                            </div>
                            <a href="<?php echo site_url('Support/My-Requests'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
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
                                                <div class="amount"><?php echo $totalIncome; ?></div>
                                                <div class="info">Last month <strong><?php echo $totalLastIncome; ?></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-down-left"></em> <small>Income</small></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="<?php echo site_url('Budget/Expenses'); ?>">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalExpenses; ?></div>
                                                <div class="info">Last Month <strong><?php echo $lastMonthExpenses; ?></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-up-left"></em> <small>Expenses</small></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalSurplus; ?></div>
                                                <div class="info">Avg Per Month <strong><?php echo '$' . $totalSavingsPerMonth; ?></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-down-left"></em> <small>Savings</small></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                                        <a href="">
                                            <div class="nk-order-ovwg-data surplus">
                                                <div class="amount"><?php echo $totalInvestment; ?></div>
                                                <div class="info">Avg Per Month <strong><?php echo $totalInvestmentPerMonth; ?></strong></div>
                                                <div class="title"><em class="icon ni ni-arrow-up-left"></em> <small>Investments</small></div>
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
                                        <h6 class="title">Monthly Financial Overview</h6>
                                        <p>Last 12 Months of Total Monthly ßFinancial Growth.</p>
                                    </div>
                                    <div class="card-tools mt-n1 me-n1">
                                        <a class="btn btn-success text-white" href="<?php echo site_url('/Budget/Add/Income'); ?>"><i class="icon ni ni-plus"></i> Income</a>
                                        <a class="btn btn-danger text-white" href="<?php echo site_url('/Budget/Add/Expense'); ?>"><i class="icon ni ni-plus"></i> Expense</a>
                                    </div>
                                </div>
                                <table class="table default" id="userBudgetingIncomeDatatable">
                                    <thead>
                                        <tr>
                                            <th class="d-none"></th>
                                            <th>Due Date</th>
                                            <th>Account</th>
                                            <th>Source</th>
                                            <th>Pay Schedule</th>
                                            <th>Amount</th>
                                            <th>Subtotal</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $this->db->where('account_type', 'Income');
                                        $getAccounts                        = $this->budget_model->get_accounts_order_asc_by_date($cuID);
                                        $sum                                = 0;
                                        foreach($getAccounts->result_array() as $account) {
                                            if ($account['account_type'] === 'Income') {
                                                $accountNetAmount           = $account['net_amount'];
                                            } elseif ($account['account_type'] === 'Expense') {
                                                $accountNetAmount           = '-' . $account['net_amount'];
                                            }
                                            $sum                            += $accountNetAmount;
                                            if ($sum >= 0) {
                                                $sumDisplay                 = '$' . number_format($sum,2);
                                            } elseif ($sum < 0) {
                                                $sumDisplay                 = '<span class="statusRed">-$' . number_format(($sum * -1),2) . '</span>';
                                            }
                                            if ($account['paid'] == 0) {
                                                $accountPaidStatus          = '<a href="' . site_url('Budget/Paid/' . $account['id']) . '"><i class="icon ni ni-check-thick"></i></a>';
                                            } else {
                                                $accountPaidStatus          = '<span class="statusGreen"><i class="icon ni ni-check-thick"></i></span>';
                                            }
                                                echo '
                                            <tr>
                                                <td class="d-none">' . $account['year'] . '-' . $account['month'] . '-' . $account['day'] . '</td>
                                                <td>' . date("F d, Y", strtotime($account['year'] . '-' . $account['month'] . '-' . $account['day'])) . '</td>
                                                <td>' . $account['name'] . '</td>
                                                <td>' . $account['source_type'] . '</td>
                                                <td>' . $account['intervals'] . '</td>
                                                <td>' . number_format($accountNetAmount,2) . '</td>
                                                <td>' . $sumDisplay . '</td>
                                                <td>
                                                    ' . $accountPaidStatus . '
                                                    <a href="' . site_url('Budget/Edit/' . $account['id']) . '"><i class="icon ni ni-edit"></i></a>
                                                    <a class="text-red" href="' . site_url('Budget/Delete-Account/' . $account['id']) . '"><i class="icon ni ni-cross-circle"></i></a>
                                                </td>
                                            </tr>
                                                ';
                                        };
                                        // $this->db->from('bf_users_budgeting');
                                        // $this->db->where('status', 1);
                                        // $this->db->where('account_type', 'Income');
                                        // $getIncomeAccounts        = $this->db->get();
                                        // foreach($getIncomeAccounts->result_array() as $income) {
                                        //     echo '
                                        // <tr>
                                        //     <td>' . date("Y-m-d", strtotime($income['designated_date'])) . '</td>
                                        //     <td>' . $income['name'] . '</td>
                                        //     <td>' . $income['source_type'] . '</td>
                                        //     <td>' . $income['intervals'] . '</td>
                                        //     <td>' . $income['net_amount'] . '</td>
                                        //     <td>
                                        //         <a href="' . site_url('Budget/Edit/' . $income['id']) . '"><i class="icon ni ni-edit"></i></a>
                                        //         <a class="text-red" href="' . site_url('Budget/Delete/' . $income['id']) . '"><i class="icon ni ni-cross-circle"></i></a>
                                        //     </td>
                                        // </tr>
                                        //     ';
                                        // };
                                        // $this->db->from('bf_users_budgeting');
                                        // $this->db->where('status', 1);
                                        // $this->db->where('account_type', 'Expense');
                                        // $getIncomeAccounts        = $this->db->get();
                                        // foreach($getIncomeAccounts->result_array() as $income) {
                                        //     echo '
                                        // <tr>
                                        //     <td>' . date("Y-m-d", strtotime($income['designated_date'])) . '</td>
                                        //     <td>' . $income['name'] . '</td>
                                        //     <td>' . $income['source_type'] . '</td>
                                        //     <td>' . $income['intervals'] . '</td>
                                        //     <td>' . $income['net_amount'] . '</td>
                                        //     <td>
                                        //         <a href="' . site_url('Budget/Edit/' . $income['id']) . '"><i class="icon ni ni-edit"></i></a>
                                        //         <a class="text-red" href="' . site_url('Budget/Delete/' . $income['id']) . '"><i class="icon ni ni-cross-circle"></i></a>
                                        //     </td>
                                        // </tr>
                                        //     ';
                                        // };
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
<!-- <script type='text/javascript'>
$(document).ready(function() {
    var table = $('#userBudgetingIncomeDatatableB').DataTable({ // Set Table ID here, change it above
        "columnDefs": [
            { "visible": false, "targets": 2 } // ??? Determine what Targets designates
        ],
        "order": [[ 0, 'asc' ]], // Change to 0, 'asc'
        "displayLength": 25, // Change to current settings
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            var subTotal = new Array();
            var groupID = -1;
            var aData = new Array();
            var index = 0;
            api.column(5, {page:'current'} ).data().each(
                function ( group, i ) { // ??? Does api.columm(2) determine the column to summarize?
                    console.log(group+" "+i+" | ");
                    var vals = api.row(api.row($(rows).eq(i)).index()).data();
                    console.log(vals);
                    var netAmount = vals[5] ? parseFloat(vals[5]) : 0; // change to netAmount
                    console.log(netAmount);
                    if (typeof aData[group] == 'undefined') {
                        aData[group] = new Array();
                        aData[group].rows = [];
                        aData[group].netAmount = []; // change to netAmount
                        console.log(aData[group]);
                    }
                    aData[group].rows.push(i);
                    aData[group].netAmount.push(netAmount); // change to netAmount
                }
            );
            var idx= 0;
             for(var subTotal in aData){ // change `office` to `subTotal`
                            idx =  Math.max.apply(Math,aData[subTotal].rows);
                   var sum = 0;
                   $.each(aData[subTotal].netAmount,function(k,v){ // change `office` to `subTotal`
                        sum = sum + v;
                   });
                             console.log(aData[subTotal].netAmount); // change `office` to `subTotal` || change `salary` to `netAmount`
                   $(rows).eq( idx ).after(
                        '<td>'+sum+'</td>' // change `office` to `netAmount`
                    );
            };
        }
    } );
} );
</script> -->