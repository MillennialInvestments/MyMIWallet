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
                                <div class="amount"><?php //echo $totalCampaignUsers; ?> <?php echo $marketingUsersGained; ?> <small class="currenct currency-usd">User Gained</small></div>
                                <div class="info">Active Users <strong><?php echo $totalActiveUsers; ?> <span class="currenct currency-usd">Active Users</span></strong></div>
                                <div class="title"><em class="icon ni ni-arrow-down-left"></em> Total Active Users</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-12">
                            <div class="nk-order-ovwg-data sell">
                                <div class="amount">0 <small class="currenct currency-usd">Total Reach</small></div>
                                <div class="info">Reach/Month <strong> <?php echo $marketingImpressions; ?><span class="currenct currency-usd"> Impressions</span></strong></div>
                                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Total Reach Analytics</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
            </div>
        </div><!-- .nk-order-ovwg -->
    </div><!-- .card-inner -->
</div><!-- .card -->