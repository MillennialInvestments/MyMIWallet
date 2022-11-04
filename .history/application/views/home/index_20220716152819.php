<?php
$currentUserID 			= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$beta                   = $this->config->item('beta'); 
if (empty($currentUserID)) {
    if ($beta === 0) {
        $btnURL         = site_url('/Free/register'); 
    } elseif ($beta === 1) {
        $btnURL         = site_url('/Beta/register'); 
    }
    $btnText            = 'Register Now';
} else {
    $btnURL             = site_url('/Dashboard'); 
    $btnText            = 'Dashboard';
}
$totalActiveUsers       = $_SESSION['reporting']['totalActiveUsers']; 
$totalWalletsCreated    = $_SESSION['reporting']['totalWalletsCreated']; 
$totalTradesTracked     = $_SESSION['reporting']['totalTradesTracked']; 
$totalActivePartners    = $_SESSION['reporting']['totalActivePartners']; 
$totalApprovedAssets    = $_SESSION['reporting']['totalApprovedAssets']; 
?>
<style>
    .intro-banner{background-image: url("<?php echo base_url('assets/images/MyMI-Walllet-Background.jpeg'); ?>")}
</style>
<div class="intro-banner bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc">
                            <span class="overline-title">Introducing</span>
                            <h1 class="title text-white">MyMI Wallet <span class="version">v7.1.5</span> </h1>
                            <p class="text-light">
                                A powerful Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange for Retail & Institutional Investors alike. 
                                <strong class="text-white">MyMI Wallet</strong> comes with a variety of <a href="">Premium Features</a>, necessary to provide Investors with the Accounting & Analytical Tools and our <strong class="text-primary">Asset Marketplace & Exchanges</strong> that helps you to create your own <a href="">Digital Assets</a> to sell to intereseted potential investors.</p>
                        </div>
                        <ul class="intro-action-group">
                            <li><a href="<?php echo site_url($btnURL); ?>" class="btn btn-lg btn-primary" target="_blank"><?php echo $btnText; ?></a></li>
                            <li><a href="<?php echo site_url('/Knowledge-Base'); ?>" class="link-to btn btn-lg btn-light">Learn More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-overview text-center bg-lighter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">MyMI Wallet Overview</span>
                    <h2 class="intro-heading-lead">Accounting <span class="break-mb">&</span> Analytical Statistics</h2>
                    <div class="intro-section-desc">
                        <p>An overview of <strong class="text-soft">MyMI Wallet</strong> – is fully clean and premium designed admin template which included beautiful hand-crafted components & elements. MyMI Wallet completely focusing on <strong>conceptual base apps or dashboard</strong>, as it’s equipped with pre-built screens as well.
                        </p>
                        <?php //print_r($_SESSION['reporting']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="intro-overview-list">
                    <div class="intro-overview-item highlight"><span class="intro-ov-number text-blue"><?php echo $totalActiveUsers; ?>+</span><span class="intro-ov-title text-blue">Investors</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalWalletsCreated; ?></span><span class="intro-ov-title ">MyMI Wallets</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalTradesTracked; ?></span><span class="intro-ov-title ">Total Trades</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalActivePartners; ?></span><span class="intro-ov-title ">MyMI Partners</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalApprovedAssets; ?></span><span class="intro-ov-title ">MyMI Assets</span></div>
                </div>
            </div>
        </div>
        <div class="intro-overview-action">
            <ul>
                <li><a href="<?php echo site_url($btnURL); ?>" class="link-to btn btn-lg btn-secondary"><?php echo $btnText; ?></a></li>
                <li><a href="<?php echo site_url('Knowledge-Base/Getting-Started'); ?>" class="link-to btn btn-lg btn-round btn-primary">Get Started</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="promotion" class="intro-section intro-section-sm intro-promo-iv text-white">
    <div class="container container-ld">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="g pe-md-4">
                <div class="w-max-600px">
                    <h3 class="title mb-3">Looking for Advanced HYIP Investment System?</h3>
                    <p class="lead">We're thrilled to tell you that we have developed new functional application to manage your HYIP Investment. If you are interest to check demo please contact us.</p>
                </div>
            </div>
            <div class="g mt-4 mt-md-0"><a href="https://softnio.com/get-early-access/" target="_blank" class="btn btn-lg btn-promo-iv"><span>Get Investorm</span></a></div>
        </div>
    </div>
</div>




<div id="preview" class="intro-section intro-apps text-center text-white bg-primary-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="intro-section-title">
                    <span class="overline-title">MyMI Wallet</span>
                    <h2 class="intro-heading-lead intro-title">Premium Features</h2>
                </div>
            </div>
        </div>
        <div class="row intro-apps-list justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo2/ecommerce/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-ecommerce.jpg'); ?>" src="<?php echo base_url('assets/images/demo-ecommerce2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo2/ecommerce/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Investor</span>
                            <h4 class="intro-apps-title title">Account Management</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">Learn More!</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo4/subscription/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-subscription.jpg'); ?>" src="<?php echo base_url('assets/images/demo-subscription2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo4/subscription/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Investor</span>
                            <h4 class="intro-apps-title title">MyMI Wallets</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">Learn More!</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo5/crypto/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-buysell.jpg'); ?>" src="<?php echo base_url('assets/images/demo-buysell2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo5/crypto/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Investor</span>
                            <h4 class="intro-apps-title title">Trade Tracker</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">14 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo6/invest/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-invest.jpg'); ?>" src="<?php echo base_url('assets/images/demo-invest2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo6/invest/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 6</span>
                            <h4 class="intro-apps-title title">HYIP Investment Panel</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">13 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo2/lms/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-lms.jpg'); ?>" src="<?php echo base_url('assets/images/demo-lms2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo2/lms/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 2</span>
                            <h4 class="intro-apps-title title">LMS / Learning Management System</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">22 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo1/crm/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-crm.jpg'); ?>" src="<?php echo base_url('assets/images/demo-crm2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo1/crm/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 1</span>
                            <h4 class="intro-apps-title title">CRM / Customer Relationship Management</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">33 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo7/hospital/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-hospital.jpg'); ?>" src="<?php echo base_url('assets/images/demo-hospital2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo7/hospital/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo7</span>
                            <h4 class="intro-apps-title title">Hospital Management System</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">25 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo1/hotel/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-hotel.jpg'); ?>" src="<?php echo base_url('assets/images/demo-hotel2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo1/hotel/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo1</span>
                            <h4 class="intro-apps-title title">Hotel Management System</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">19 screens</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo3/cms/index.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-cms.jpg'); ?>" src="<?php echo base_url('assets/images/demo-cms2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo3/cms/index.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo3</span>
                            <h4 class="intro-apps-title title">CMS Panel</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">13 screens</a>
                </div>
            </div>
        </div>
        <div class="row intro-apps-list is-compact justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo3/apps/file-manager.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-file-manager.jpg'); ?>" src="<?php echo base_url('assets/images/demo-file-manager2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo3/apps/file-manager.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 3</span>
                            <h4 class="intro-apps-title title">File Manager</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">10 screens</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo3/apps/chats.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-chats.jpg'); ?>" src="<?php echo base_url('assets/images/demo-chats2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo3/apps/chats.html">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 3</span>
                            <h4 class="intro-apps-title title">Messenger / Chats</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">3 screens</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo3/apps/messages.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-messages.jpg'); ?>" src="<?php echo base_url('assets/images/demo-messages2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo3/apps/messages.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 3</span>
                            <h4 class="intro-apps-title title">Support / Messages</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">1 screen</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="intro-apps-item">
                    <a href="https://dashlite.net/demo3/apps/mailbox.html" class="intro-apps-img" target="_blank"><img class="intro-apps-default" src="<?php echo base_url('assets/images/Dashlite-Examples/demo-inbox.jpg'); ?>" src="<?php echo base_url('assets/images/demo-inbox2x.jpg'); ?> 2x" alt=""></a>
                    <div class="intro-apps-desc">
                        <a href="https://dashlite.net/demo3/apps/mailbox.html" target="_blank">
                            <span class="intro-apps-subtitle overline-title">Layout - Demo 3</span>
                            <h4 class="intro-apps-title title">Inbox / Mailbox</h4>
                        </a>
                    </div>
                    <a class="intro-apps-target">1 screen</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="intro-layout" class="intro-section intro-preview bg-lighter">
    <div class="container-xl">
        <div class="row justify-content-center text-center">
            <div class="col-lg-7">
                <div class="intro-section-title">
                    <span class="intro-section-subtitle overline-title">Admin Tempalte Layout</span>
                    <h2 class="intro-heading-lead intro-title">Multipurpose Admin Dashboard</h2>
                    <div class="intro-section-desc">
                        <p>DashLite template included different layouts that fit into any application. Also all the layouts supported <strong>Dark Theme Mode</strong> & <strong>RTL Compatibility</strong>, which will give more power on your application.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-preview-list row justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo1/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-purple"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-1d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-1d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 1</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo2/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-pink"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-2d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-2d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 2</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo3/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-teal"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-3d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-3d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 3</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo4/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-danger"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-4d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-4d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 4</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo5/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-warning"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-5d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-5d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 5</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo6/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-blue"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-6d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-6d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 6</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo7/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-success"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-7d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-7d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 7</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/demo8/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-cyan"><img src="<?php echo base_url('assets/images/Dashlite-Examples/layout-8d.jpg'); ?>" src="<?php echo base_url('assets/images/layout-8d2x.jpg'); ?> 2x" alt="DashLite Dashboard"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Layout - Demo 8</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-4">
                <a href="https://dashlite.net/index.html" class="intro-preview-item" target="_blank">
                    <div class="intro-preview-img bg-light"><img src="<?php echo base_url('assets/images/Dashlite-Examples/main-landing.jpg'); ?>" src="<?php echo base_url('assets/images/main-landing2x.jpg'); ?> 2x" alt="DashLite Landing Page"></div>
                    <div class="intro-preview-name">
                        <h4 class="intro-preview-title title">Landing Page <span class="badge bg-danger">Free</span></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-story bg-lighter">
    <div class="container container-ld">
        <div class="row justify-content-between">
            <div class="col-md-4 col-lg-5">
                <div class="intro-content-aside">
                    <div class="intro-section-title">
                        <span class="overline-title">Story Behind</span>
                        <h2 class="intro-heading-lead title">Story of Making DashLite</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-7">
                <div class="intro-content-entry">
                    <p>In marketplace, most of dashboard are generic. On other hand developers and programmers faced lots problem to build their application because those generic dashboard does not provide real-usecase pages. To solve the problem, Softnio Team make a vision. </p>
                    <p>Our vision is so simple. Create the largest and the most comprehensive conceptual base dashboard including great UI/UX. We just released our very first version of dashboard with 4 conceptual apps. Our ultimate goal is to designing more than 10 conceptual dashboard by end of 2021. You can see what's coming next in our 'Upcoming Release'.</p>
                    <div class="intro-team">
                        <span class="title text-soft">Design and developed by</span>
                        <div class="intro-team-list">
                            <div class="intro-team-member">
                                <div class="intro-team-media"><img src="<?php echo base_url('assets/images/Dashlite-Examples/team-abu.jpg'); ?>" src="<?php echo base_url('assets/images/team-abu2x.jpg'); ?> 2x" alt="Abu"></div>
                                <div class="intro-team-info">
                                    <h5 class="intro-team-title title">Abu Bin Ishityak</h5>
                                    <span class="intro-team-role">Role as Designer</span>
                                </div>
                            </div>
                            <div class="intro-team-member">
                                <div class="intro-team-media"><img src="<?php echo base_url('assets/images/Dashlite-Examples/team-nio.jpg'); ?>" src="<?php echo base_url('assets/images/team-nio2x.jpg'); ?> 2x" alt="Nio"></div>
                                <div class="intro-team-info">
                                    <h5 class="intro-team-title title">Softnio Team</h5>
                                    <span class="intro-team-role">Role as Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-upcoming bg-white">
    <div class="container container-ld">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-content-aside">
                    <div class="intro-section-title">
                        <span class="overline-title">Future Roadmap</span>
                        <h2 class="intro-heading-lead title">Upcoming Release</h2>
                        <div class="intro-content-entry">
                            <p>As our ultimate goal is to design lots of application so these give you a clear understanding where we are heading. We hope so you love our design and to support us on the mission. As always if you have any idea/concept then, provide us info we will keep that in mind for future release.</p>
                            <span class="notes">Note: You will get email notification for all the future releases and get update version dashboard for free and for lifetime.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="intro-upcoming-items">
                    <div class="intro-upcoming-item s2 bg-blue">
                        <div class="w-100">
                            <span class="intro-upcoming-sub">Application <em class="float-end">Upcoming</em></span>
                            <h2 class="intro-upcoming-title title">PMS Application</h2>
                            <p>Introduce pre-build pages for project management system.</p>
                        </div>
                    </div>
                    <div class="intro-upcoming-item s3 bg-purple">
                        <div class="w-100">
                            <span class="intro-upcoming-sub">Use Case Concept <em class="float-end">Upcoming</em></span>
                            <h2 class="intro-upcoming-title title">Loan management panel</h2>
                            <p>Introduce pre-build pages for Loan management panel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-purchase bg-lighter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Get Dashlite Today</span>
                    <h2 class="intro-heading-lead intro-title"> Purchase Today <span class="break-xs">&</span> Start Building <br class="d-none d-md-inline break-m"> Application <span class="break-xs">with</span> DashLite Today</h2>
                    <div class="intro-section-desc">
                        <p>Purchase and get access to the DashLite today and starting redesign your existing application.<br class="d-none d-md-inline">Do not forgot to check out our roadmap to see what's coming next.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="row intro-featured-block align-items-center no-gutters">
                    <div class="col-md-7">
                        <div class="intro-featured-card left text-white">
                            <h2 class="title">HTML Package</h2>
                            <ul class="intro-featured-list">
                                <li>7+ Deshboard Layout</li>
                                <li>11+ Conceptuals Apps</li>
                                <li>150+ Use-case screens</li>
                                <li>60+ Hand-made SVG Icon</li>
                                <li>1000+ Custom Font Icon</li>
                                <li>6 Month Free Premium Support</li>
                                <li class="note">+ All future update releases for Free</li>
                            </ul>
                            <div class="intro-featured-action"><a href="https://1.envato.market/e0y3g" class="btn btn-lg btn-primary" target="_blank">Purchase Now for $24</a></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="intro-featured-card right">
                            <h2 class="title text-primary">Request Feature</h2>
                            <p>Missing anything or need more features to complete your project? Or you have something specific in your mind? We’re happy for any new ideas or features. </p>
                            <div class="intro-featured-action"><a href="https://themeforest.net/user/softnio#contact" target="_blank" class="btn btn-secondary"><span>Let Us Know</span><em class="icon ni ni-arrow-long-right"></em></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>