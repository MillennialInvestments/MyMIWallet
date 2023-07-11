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