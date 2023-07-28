<style>
    .ni-line-height {
        line-height: 0.5rem;
    }
    .ni-nav-link {
        display: block !important; 
    }
</style>
<div class="card card-bordered h-100">
    <div class="card-inner-group">
        <div class="card-inner card-inner-md">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Assessment Center</h6>
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
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Account Setup & Progress</div>
                    <p>
                        <a data-toggle="tab" href="#account-checklist">Manage Your Account</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#account-checklist"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Account Information</div>
                    <p>
                        <a data-toggle="tab" href="#account-information">Manage Your Account</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#account-information"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Banking Information</div>
                    <p>
                        <a data-toggle="tab" href="#banking-summary">Manage Your Bank Account</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#banking-summary"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Credit Information</div>
                    <p>
                        <a data-toggle="tab" href="#credit-summary">Manage Your Credit Summary</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#credit-summary"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Debt Information</div>
                    <p>
                        <a data-toggle="tab" href="#debt-summary">Manage Your Debt Summary</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#debt-summary"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <?php if ($investmentOperations === 1) { ?>
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Investment Information</div>
                    <p>
                        <a data-toggle="tab" href="#investment-summary">Manage Your Investment Summary</a> 
                        to update your Investor Profile.<?php echo 'InvestmentOperations: ' . $investmentOperations; ?>
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#investment-summary"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Risk Assessment</div>
                    <p>
                        Manage your 
                        <a data-toggle="tab" href="#financial-goals">Complete Your Risk Assessment</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#financial-goals"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content">
                    <em class="icon ni ni-wallet-in"></em>
                    <div class="title">Experience/Knowledge</div>
                    <p>
                        <a data-toggle="tab" href="#investment-experience">Update Your Experience/Knowledge</a> 
                        to update your Investor Profile.
                    </p>
                </div>
                <a class="btn btn-icon btn-trigger me-n2" data-toggle="tab" href="#investment-experience"><em class="icon ni ni-forward-ios"></em></a>
                <!-- <a href="#budgeting-monthly-financial-overview" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a> -->
            </div>
        </div><!-- .card-inner -->
        <?php
        }
        ?>
    </div><!-- .card-inner-group -->
</div><!-- .card -->