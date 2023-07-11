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
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
                        <?php echo '<div id="investment-data" hidden>' .json_encode($userInvestmentRecords,true) . '</div>'; //print_r(json_encode($userInvestmentRecords));?>
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
                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> <small>Income</small></div>
                            <div class="amount"><?php echo $thisMonthsIncomeFMT; ?></div>
                            <div class="info row">
                                <span class="col-6 p-0">Last month</span><span class="col-6 p-0 text-right"><strong><?php echo $lastMonthsIncomeFMT; ?></strong></span>
                                <span class="col-6 p-0">Annual (Proj.)</span><span class="col-6 p-0 text-right"><strong><?php echo $totalIncomeFMT; ?></strong></span>
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
                            <div class="title"><em class="icon ni ni-arrow-up-left"></em> <small>Investments</small></div>
                            <div class="amount"><?php echo $thisMonthsInvestmentsFMT; ?></div>
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
<script>
    // Fetch your JSON data from the hidden div
    let investmentData = document.querySelector("#investment-data").innerText;

    // Parse the JSON data to a JavaScript object
    let userInvestmentRecords;
    try {
        userInvestmentRecords = JSON.parse(investmentData);
    } catch (e) {
        console.error("Error parsing JSON:", e);
        // Handle error as appropriate for your application
    }

    // Initialize objects to hold the sums of net gains for each year and each month
    let monthlyNetGains = {};

    // Iterate over each investment record
    for (let i = 0; i < userInvestmentRecords.length; i++) {
        let record = userInvestmentRecords[i];

        // Extract the year and month from the close_date field
        // Assumes close_date is in 'yyyy/mm/dd' format
        let dateParts = record.close_date.split('/');
        let year = dateParts[0];
        let month = dateParts[1];

        // If there's no existing entry for this month in monthlyNetGains, initialize it to 0
        let monthYearKey = `${year}-${month}`; // This key allows to differentiate the same month across different years
        if (!(monthYearKey in monthlyNetGains)) {
            monthlyNetGains[monthYearKey] = 0;
        }

        // Add the net gains for this record to the sums for the relevant month
        monthlyNetGains[monthYearKey] += parseFloat(record.net_gains);
    }

    // Preparing data for the Chart.js
    let labels = Object.keys(monthlyNetGains);
    let data = Object.values(monthlyNetGains);

    // Drawing the Chart.js chart
    let ctx = document.getElementById('report-chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Net gains per month',
                data: data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Net gains'
                    }
                }
            }
        }
    });
</script>