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
                    <div class="title">Checking - <?php echo $checkingSummaryFMT; ?></div>
                    <p>
                        Manage your 
                        <a href="<?php echo site_url('Wallets/Checking'); ?>">Checking Accounts</a> 
                        <!-- 
                            // #NEXTSTEPS Change to this once Individual Wallet Overviews are completed (/Wallets/Checking, /Wallets/Savings, etc.)
                            <a href="<?php //echo site_url('/Wallets/Checking'); ?>">Checking Accounts</a>  
                        -->
                        to update your Monthly Budget.
                    </p>
                </div>
                <a href="<?php echo site_url('/Wallets/Checking'); ?>" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
            </div>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- .card -->