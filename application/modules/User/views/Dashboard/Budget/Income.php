<?php
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems'); 
$totalAnnualIncome                  = 0;
$totalLastAnnualIncome              = 0; 
$totalMonthlyIncome                 = 0;
$totalLastMonthlyIncome             = 0; 
$totalWeeklyIncome                  = 0;
$totalLastWeeklyIncome              = 0; 
$totalDailyIncome                   = 0;
$totalLastDailyIncome               = 0;                  
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
                                <div class="title">Add Income Account</div>
                                <p><a href="<?php echo site_url('/Budget/Income/Add'); ?>">Add an Income Account</strong></a> to track your income sources.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Income/Add'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-wg-action">
                            <div class="nk-wg-action-content">
                                <em class="icon ni ni-help-fill"></em>
                                <div class="title">Income Settings</div>
                                <p><a href="<?php echo site_url('/Budget/Income/Settings'); ?>"><strong>Adjust Income Settings</strong></a> to configure your accounts.</p>
                            </div>
                            <a href="<?php echo site_url('/Budget/Income/Settings'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
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
                            <div class="col-xxl-8">
                                <div class="nk-order-ovwg-ck">
                                    <canvas class="order-overview-chart" id="orderOverview"></canvas>
                                </div>
                            </div><!-- .col -->
                            <div class="col-xxl-4">
                                <div class="row g-4">
                                    <div class="col-sm-6 col-xxl-12">
                                        <div class="nk-order-ovwg-data buy">
                                            <div class="amount"><?php //echo $totalTransTotals; ?> <small class="currenct currency-usd">USD</small></div>
                                            <div class="info">Last month <strong><?php //echo $totalLastTransTotals; ?> <span class="currenct currency-usd">USD</span></strong></div>
                                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total Monthly Spend</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-12">
                                        <div class="nk-order-ovwg-data sell">
                                            <div class="amount"><?php //echo $totalTransFees; ?> <small class="currenct currency-usd">USD</small></div>
                                            <div class="info">Last month <strong><?php //echo $totalLastTransFees; ?> <span class="currenct currency-usd">USD</span></strong></div>
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
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">Month-to-Month Overview Test</h6>
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
                                        $this->db->where('account_type', 'Income'); 
                                        $getAccounts        = $this->db->get();
                                        foreach($getAccounts->result_array() as $account) {
                                            echo '
                                        <tr>
                                            <td>' . $account['name'] . '</td>
                                            <td>' . $account['source_type'] . '</td>
                                            <td>' . $account['intervals'] . '</td>
                                            <td>' . $account['amount'] . '</td>
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