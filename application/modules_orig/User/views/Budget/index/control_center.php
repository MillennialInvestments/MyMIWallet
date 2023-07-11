<div class="card card-bordered h-100">
    <div class="card-inner-group">
        <div class="card-inner card-inner-md">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Financial Summary</h6>
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
                    <em class="icon ni ni-cc-alt"></em>
                    <div class="title">Checking <br><?php echo $checkingSummaryFMT; ?></div>
                    <!-- <p>
                        Manage your 
                        <a href="<?php //echo site_url('Wallets/Checking'); ?>">Checking Accounts</a> 
                        to update your Monthly Budget.
                    </p> -->
                </div>
                <a href="<?php echo site_url('/Wallets/Checking'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Income YTD <br><?php echo $incomeYTDSummaryFMT; ?></div>
                    <!-- <p>
                        Manage your 
                        <a href="#budgeting-monthly-financial-overview">Income Accounts</a> 
                        to update your Financial Forecast.
                    </p> -->
                </div>
                <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-out"></em>
                    <div class="title">Expense YTD <br><?php echo $expenseYTDSummaryFMT; ?></div>
                    <!-- <p>
                        Manage your 
                        <a href="#budgeting-monthly-financial-overview">Expense Accounts</a> 
                        to update your Financial Forecast.
                    </p> -->
                </div>
                <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-activity"></em>
                    <div class="title">Credit Cards <br><?php echo $creditAvailableFMT . ' / <small>' . $creditLimitFMT . '</small>'; ?></div>
                    <!-- <p>
                        Manage your 
                        <a href="<?php //echo site_url('/Wallets/Credit'); ?>">Credit</a> 
                        to update your Financial Forecast.
                    </p> -->
                </div>
                <a href="<?php echo site_url('/Wallets/Credit'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-activity"></em>
                    <div class="title">Debt <br><?php echo $debtSummaryFMT; ?></div>
                    <!-- <p>
                        Manage your 
                        <a href="<?php //echo site_url('/Wallets/Debt'); ?>">Debt</a> 
                        to update your Financial Forecast.
                    </p> -->
                </div>
                <a href="<?php echo site_url('/Wallets/Debt'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->        
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-activity"></em>
                    <div class="title">Investments <br><small>(**COMING SOON**)</small></div>
                    <!-- <p>
                        Manage your Investments
                        to update your Retirement Financial Forecast.
                    </p> -->
                </div>
                <?php 
                // !! Pop Up Modal with Service Description // 
                ?>
                <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-activity"></em>
                    <div class="title">Retirement <br><small>(**COMING SOON**)</small></div>
                    <!-- <p>
                        Manage your 
                        Retirement Plan
                        to update your Retirement Financial Forecast.
                    </p> -->
                </div>
                <?php 
                // !! Pop Up Modal with Service Description // 
                ?>
                <a href="#" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <br>
        <?php 
        if ($investmentOperations === 1) {
        ?>    
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-out"></em>
                    <div class="title">Investment Strategy</div>
                    <p>
                        Manage your 
                        <a href="#budgeting-monthly-financial-overview">Investment Profile &amp; Strategy</a> 
                        <!-- 
                            // #NEXTSTEPS Change to this once Individual Wallet Overviews are completed (/Wallets/Checking, /Wallets/Savings, etc.)
                            <a href="<?php //echo site_url('/Wallets/Checking'); ?>">Checking Accounts</a>  
                        -->
                        to accurately forecast your Personal Budget.
                    </p>
                </div>
                <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <?php
        }
        ?>
        <!--
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-coins"></em>
                    <div class="title">Investments / Assets</div>
                    <p>
                        Manage your 
                        <a href="<?php //echo site_url('/Budget/Income/Accounts'); ?>">Investments / Assets</a> 
                        <!-- 
                            // #NEXTSTEPS Change to this once Individual Wallet Overviews are completed (/Wallets/Checking, /Wallets/Savings, etc.)
                            <a href="<?php //echo site_url('/Wallets/Checking'); ?>">Checking Accounts</a>  
                        --
                        to update your Financial Forecast.
                    </p>
                </div>
                <a href="<?php //echo site_url('/Budget/Add/Expense'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
        <!--
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-growth"></em>
                    <div class="title">Retirement</div>
                    <p>View, manage and analyze your <a href="<?php //echo site_url('Budget/Forecast'); ?>"><strong><?php //echo $totalTransactions; ?> Financial Forecast &amp; 5-Year Projections</strong></a>.</p>
                </div>
                <a href="<?php //echo site_url('Exchanges'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- .card -->