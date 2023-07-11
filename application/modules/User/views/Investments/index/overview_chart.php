<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="card-title-group align-start mb-3">
            <div class="card-title">
                <h6 class="title">Month-to-Month Overview</h6>
                <p>Click on the legend below to hide or show parts of the chart and edit the timeframe at the bottom of it</p>
            </div>
            <div class="card-tools mt-n1 me-n1">
                <div class="dropdown text-white d-sm-none d-md-block">
                    <a href="#" class="btn btn-primary btn-md text-white" data-bs-toggle="dropdown" aria-expanded="false"><span>Chart Settings</span><em class="icon ni ni-setting"></em></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1" style="">
                        <ul class="link-list-opt no-bdr">
                            <li class="p-1">
                                <h7>Start Date?</h7>
                                <input type="date">   
                            </li>
                            <li class="divider"></li>
                            <li class="p-1">
                                <h7>Historical Timeline?</h7>
                                <select class="form-select form-control link-list-opt no-bdr" id="chart-lower" aria-label="Default select ">
                                    <option value="-12">-12 months</option>
                                    <option value="-6">-6 months</option>
                                    <option value="-3">-3 months</option>
                                    <option value="-1" selected>-1 month</option>
                                    <option value="0">Only Forward</option>
                                </select>                                                              
                            </li>
                            <li class="divider"></li>
                            <li class="p-1">             
                                <h7>Forward-Looking?</h7>
                                <select class="form-select form-control" id="chart-upper" aria-label="Default select ">
                                    <option value="12" selected>12 months</option>
                                    <option value="6">6 months</option>
                                    <option value="3">3 months</option>
                                    <option value="1">1 month</option>
                                    <option value="0">Only Backward</option>
                                </select> 
                            </li>
                        </ul>         
                    </div>
                </div>
            </div>
        </div><!-- .card-title-group -->
        <div class="nk-order-ovwg">
            <div class="row g-4 align-end">
                <div class="col-12">
                    <div class="nk-order-ovwg-ck" style="height:100%;">
                        `<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
                        <?php
                        echo("<div id='budget-data' hidden>" .json_encode($userInvestmentRecords,true) . '</div>');
                        ?>
                        <div class="h-100">
                            <canvas class="h-100" id="report-chart"></canvas>
                        </div>                               
                    </div>
                </div><!-- .col -->
            </div>
        </div><!-- .nk-order-ovwg -->
        <div class="nk-order-ovwg">
            <div class="row g-4 align-end">
                <div class="col-12">
                    <h6>This month's performance</h6>
                    <p>A quick visual summary of your incomes and expenses this month</p>
                </div>
            </div>
        </div>
        <div class="nk-order-ovwg py-5">
            <div class="row g-4 align-end">
                <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                    <a href="<?php echo site_url('Budget/Income'); ?>">
                        <div class="nk-order-ovwg-data surplus">
                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> <small>Active Investments</small></div>
                            <div class="amount"><?php echo $activeInvestmentCount; ?></div>
                            <div class="info row">
                                <span class="col-6 p-0">Last month</span><span class="col-6 p-0 text-right"><strong><?php echo $monthlyInvestmentCount; ?></strong></span>
                                <span class="col-6 p-0">Annual (Proj.)</span><span class="col-6 p-0 text-right"><strong><?php echo $annualInvestmentsCount; ?></strong></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                    <a href="<?php echo site_url('Budget/Expenses'); ?>">
                        <div class="nk-order-ovwg-data surplus">
                            <div class="title"><em class="icon ni ni-arrow-up-left"></em> <small>Expenses</small></div>
                            <div class="amount"><?php echo $thisMonthsExpenseFMT; ?></div>
                            <div class="info row">
                                <span class="col-6 p-0">Last month</span><span class="col-6 p-0 text-right"><strong><?php echo $lastMonthsExpenseFMT; ?></strong></span>
                                <span class="col-6 p-0">Annual (Proj.)</span><span class="col-6 p-0 text-right"><strong><?php echo $totalExpenseFMT; ?></strong></span>
                                <span class="col-12"></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                    <a href="">
                        <div class="nk-order-ovwg-data surplus">
                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> <small>Savings</small></div>
                            <div class="amount"><?php echo $thisMonthsSurplusFMT; ?></div>
                            <div class="info row">
                                <span class="col-6 p-0">Last month</span><span class="col-6 p-0 text-right"><strong><?php echo $lastMonthsSurplusFMT; ?></strong></span>
                                <span class="col-6 p-0">Annual (Proj.)</span><span class="col-6 p-0 text-right"><strong><?php echo $totalSurplusFMT; ?></strong></span>
                                <span class="col-12"></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-3 col-md-6 col-xxl-3">
                    <a href="">
                        <div class="nk-order-ovwg-data surplus">
                            <div class="title"><em class="icon ni ni-arrow-up-left"></em> <small>Investments (<?php echo $monthlySavingsPercentageFMT; ?>)</small></div>
                            <div class="amount"><?php echo $thisMonthsInvestmentsFMT . '<small> / ' . $thisMonthsInvestmentsSplitFMT . '</small>'; ?></div>
                            <div class="info row">
                                <span class="col-6 p-0">Last Month</span><span class="col-6 p-0 text-right"><strong><?php echo $lastMonthsInvestmentsFMT; ?></strong></span>
                                <span class="col-6 p-0">Annual (Proj.)</span><span class="col-6 p-0 text-right"><strong><?php echo $totalInvestmentsFMT; ?></strong></span>
                                <span class="col-12"></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div><!-- .card-inner -->
</div><!-- .card -->