<div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group mb-1">
            <div class="card-title">
                <h6 class="title">Investment Overview</h6>
                <p>The investment overview of your platform. <a href="<?php echo site_url('/Trade-Tracker'); ?>">View All Trades</a></p>
            </div>
        </div>
        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#thisyear">Top 10 Winners</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#alltime">Top 10 Losers</a>
            </li> -->
        </ul>
        <div class="tab-content mt-0">
            <div class="tab-pane active" id="overview">
                <div class="invest-ov gy-2">
                    <div class="subtitle">Currently Actived Investment</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">
                                <?php echo $activeInvestmentTotals; ?> <span class="currency currency-usd">USD</span>
                                <small>(<span class="<?php echo $activeInvestGainsClassA; ?>"><em class="<?php echo $activeInvestGainsClassB; ?>"></em><?php echo $activeInvestmentGains; ?></span>)</small>
                            </div>
                            <div class="title">Total Investment Value</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div><span class="amount"><?php echo $activeTotalTrades; ?></span></div>
                            <div class="title">Total Trades</div>
                        </div>
                    </div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount"><?php echo $activeInvestmentProfits; ?> <span class="currency currency-usd">USD</span></div>
                            <div class="title">Profits</div>
                        </div>
                    </div>
                </div>
                <div class="invest-ov gy-2">
                    <div class="subtitle">This Month's Investments</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">
                                <?php echo $activeMonthlyInvestments; ?> <span class="currency currency-usd">USD</span>
                                <small>(<span class="<?php echo $activeMonthlyInvestGainsClassA; ?>"><em class="<?php echo $activeMonthlyInvestGainsClassB; ?>"></em><?php echo $activeMonthlyInvestGains; ?></span>)</small>
                            </div>
                            <div class="title">Active Investments (MTD)</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div><span class="amount"><?php echo $activeMonthyTrades; ?></span></div>
                            <div class="title">Active Trades</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="thisyear">
                <div class="invest-ov gy-2">
                    <div class="subtitle">Currently Actived Investment</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">89,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Amount</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div>
                                <span class="amount">96</span>
                                <small><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></small>
                            </div>
                            <div class="title">Plans</div>
                        </div>
                    </div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">99,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Paid Profit</div>
                        </div>
                    </div>
                </div>
                <div class="invest-ov gy-2">
                    <div class="subtitle">Investment in this Month</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Amount</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div><span class="amount">83</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                            <div class="title">Plans</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="alltime">
                <div class="invest-ov gy-2">
                    <div class="subtitle">Currently Actived Investment</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Amount</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div><span class="amount">556</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                            <div class="title">Plans</div>
                        </div>
                    </div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Paid Profit</div>
                        </div>
                    </div>
                </div>
                <div class="invest-ov gy-2">
                    <div class="subtitle">Investment in this Month</div>
                    <div class="invest-ov-details">
                        <div class="invest-ov-info">
                            <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                            <div class="title">Amount</div>
                        </div>
                        <div class="invest-ov-stats">
                            <div><span class="amount">223</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                            <div class="title">Plans</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>