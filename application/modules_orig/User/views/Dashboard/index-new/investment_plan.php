<div class="card card-bordered card-full">
    <div class="card-inner d-flex flex-column h-100">
        <div class="card-title-group mb-3">
            <div class="card-title">
                <h6 class="title">Top Invested Plan</h6>
                <p>In last 30 days top invested schemes.</p>
            </div>
            <div class="card-tools mt-n4 me-n1">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>15 Days</span></a></li>
                            <li><a href="#" class="active"><span>30 Days</span></a></li>
                            <li><a href="#"><span>3 Months</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress-list gy-3">
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Initial Emergency Fund - <?php echo $emergencyFundTarget; ?></div>
                    <div class="progress-amount"><?php echo $emergencyFundPercentage . '%'; ?></div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar" data-progress="<?php echo $emergencyFundPercentage; ?>"></div>
                </div>
            </div>
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Debt Snowball</div>
                    <div class="progress-amount">18.49%</div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-orange" data-progress="18.49"></div>
                </div>
            </div>
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Complete Emergency Fund</div>
                    <div class="progress-amount">16%</div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-teal" data-progress="16"></div>
                </div>
            </div>
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Retirement Funds</div>
                    <div class="progress-amount">29%</div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-pink" data-progress="29"></div>
                </div>
            </div>
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Traditional Investments</div>
                    <div class="progress-amount">33%</div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-azure" data-progress="33"></div>
                </div>
            </div>
            <div class="progress-wrap">
                <div class="progress-text">
                    <div class="progress-label">Alternative Investments</div>
                    <div class="progress-amount">33%</div>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-azure" data-progress="33"></div>
                </div>
            </div>
        </div>
        <div class="invest-top-ck mt-auto">
            <canvas class="iv-plan-purchase" id="planPurchase"></canvas>
        </div>
    </div>
</div>