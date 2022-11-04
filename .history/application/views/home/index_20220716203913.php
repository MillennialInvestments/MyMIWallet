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
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics, and optimize your investment decisions. 
                            Utilize our <a href="<?php echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity and more at MyMI Wallet. 
                        </p>
                        <p>
                            To us, you are not just an investor, you are a <a href="<?php echo site_url('Knowledge-Base/MyMi'); ?>">Partner</a> in the Future to Come.
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
<div class="intro-section intro-feature bg-white" id="features">
    <div class="container container-ld">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Comprehensive Feature</span>
                    <h2 class="intro-heading-lead title">Features Overview</h2>
                    <div class="intro-section-desc">
                        <p>Create your web application amazing and more professional with this super user-friendly dashboard template. DashLite comes with all essential features that always you or your developers looking for. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row intro-feature-list">
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <circle cx="27.5" cy="39.5" r="4.5" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                    <circle cx="23.5" cy="39.5" r="4.5" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                    <line x1="19" y1="67" x2="37" y2="67" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <path d="M29.36,15H63.91A6.12,6.12,0,0,1,70,21.14V53.86A6.12,6.12,0,0,1,63.91,60H9.09A6.12,6.12,0,0,1,3,53.86V21.14A6.12,6.12,0,0,1,9.09,15H29.36Z" fill="#eff1ff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M34.36,20H68.91A6.12,6.12,0,0,1,75,26.14V58.86A6.12,6.12,0,0,1,68.91,65H14.09A6.12,6.12,0,0,1,8,58.86V26.14A6.12,6.12,0,0,1,14.09,20H34.36Z" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <rect x="14" y="25" width="67" height="45" rx="6" ry="6" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <line x1="19" y1="53" x2="31" y2="53" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="35" y1="53" x2="41" y2="53" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="19" y1="58" x2="31" y2="58" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="35" y1="58" x2="41" y2="58" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <rect x="71" y="31" width="4" height="6" fill="#c4cefe"></rect>
                                    <rect x="64" y="31" width="4" height="6" fill="#c4cefe"></rect>
                                    <rect x="58" y="31" width="4" height="6" fill="#c4cefe"></rect>
                                    <circle cx="72.5" cy="60.5" r="14.5" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                    <circle cx="73" cy="61" r="11" fill="#e3e7fe"></circle>
                                    <path d="M70,59V57.52a3,3,0,0,1,6,0V59" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M68.33,59h9.34A1.3,1.3,0,0,1,79,60.27v4.46A1.3,1.3,0,0,1,77.67,66H68.33A1.3,1.3,0,0,1,67,64.73V60.27A1.3,1.3,0,0,1,68.33,59Z" fill="#6576ff"></path>
                                    <ellipse cx="73" cy="61.74" rx="1.11" ry="1.12" fill="#fff"></ellipse>
                                    <path d="M72.5,62.38h1a0,0,0,0,1,0,0v1.5a.5.5,0,0,1-.5.5h0a.5.5,0,0,1-.5-.5v-1.5A0,0,0,0,1,72.5,62.38Z" fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Wallets</h4>
                                <p>It’s written with well code structure as clean & commented.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <path d="M40.74,5.16l38.67,9.23a6,6,0,0,1,4.43,7.22L70.08,80a6,6,0,0,1-7.17,4.46L24.23,75.22A6,6,0,0,1,19.81,68L33.56,9.62A6,6,0,0,1,40.74,5.16Z" fill="#eff1ff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M50.59,6.5,11.18,11.73a6,6,0,0,0-5.13,6.73L13.85,78a6,6,0,0,0,6.69,5.16l39.4-5.23a6,6,0,0,0,5.14-6.73l-7.8-59.49A6,6,0,0,0,50.59,6.5Z" fill="#eff1ff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <rect x="15" y="15" width="54" height="70" rx="6" ry="6" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <line x1="42" y1="77" x2="58" y2="77" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <circle cx="38" cy="77" r="0.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10"></circle>
                                    <line x1="42" y1="72" x2="58" y2="72" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <circle cx="38" cy="72" r="0.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10"></circle>
                                    <line x1="42" y1="66" x2="58" y2="66" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <circle cx="38" cy="66" r="0.5" fill="#c4cefe" stroke="#c4cefe" stroke-miterlimit="10"></circle>
                                    <path d="M46,40l-15-.3V40A15,15,0,1,0,46,25h-.36Z" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M42,22A14,14,0,0,0,28,36H42V22" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <polyline points="33.47 30.07 28.87 23 23 23" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                    <polyline points="25 56 35 56 40.14 49" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Trade Tracker</h4>
                                <p>Built on top of awesome Bootstrap latest 5.1+ version.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="5" y="22" width="70" height="60" rx="7" ry="7" fill="#e3e7fe" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <path d="M12,23H68a6,6,0,0,1,6,6v6a0,0,0,0,1,0,0H6a0,0,0,0,1,0,0V29A6,6,0,0,1,12,23Z" fill="#b3c2ff"></path>
                                    <line x1="5" y1="35" x2="75" y2="35" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <rect x="15" y="8" width="70" height="60" rx="7" ry="7" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <path d="M22,9H78a6,6,0,0,1,6,6v6a0,0,0,0,1,0,0H16a0,0,0,0,1,0,0V15A6,6,0,0,1,22,9Z" fill="#e3e7fe"></path>
                                    <line x1="15" y1="22" x2="85" y2="22" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="61" y1="15" x2="68" y2="15" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="74" y1="15" x2="78" y2="15" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <polyline points="60.49 51.07 67.06 44.5 60.49 37.93" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                                    <polyline points="41.51 37.93 34.94 44.5 41.51 51.07" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                                    <line x1="54.55" y1="34.5" x2="47.45" y2="54.5" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></line>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Integrations</h4>
                                <p>Eye-catching and hand-crafted icons includes in design.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="9" y="21" width="55" height="39" rx="6" ry="6" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <line x1="17" y1="44" x2="25" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="30" y1="44" x2="38" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="42" y1="44" x2="50" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="17" y1="50" x2="36" y2="50" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <rect x="16" y="31" width="15" height="8" rx="1" ry="1" fill="#c4cefe"></rect>
                                    <path d="M76.79,72.87,32.22,86.73a6,6,0,0,1-7.47-4L17,57.71A6,6,0,0,1,21,50.2L65.52,36.34a6,6,0,0,1,7.48,4l7.73,25.06A6,6,0,0,1,76.79,72.87Z" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <polygon points="75.27 47.3 19.28 64.71 17.14 57.76 73.12 40.35 75.27 47.3" fill="#6576ff"></polygon>
                                    <path d="M30,77.65l-1.9-6.79a1,1,0,0,1,.69-1.23l4.59-1.3a1,1,0,0,1,1.23.7l1.9,6.78A1,1,0,0,1,35.84,77l-4.59,1.3A1,1,0,0,1,30,77.65Z" fill="#c4cefe"></path>
                                    <path d="M41.23,74.48l-1.9-6.78A1,1,0,0,1,40,66.47l4.58-1.3a1,1,0,0,1,1.23.69l1.9,6.78A1,1,0,0,1,47,73.88l-4.58,1.29A1,1,0,0,1,41.23,74.48Z" fill="#c4cefe"></path>
                                    <path d="M52.43,71.32l-1.9-6.79a1,1,0,0,1,.69-1.23L55.81,62A1,1,0,0,1,57,62.7l1.9,6.78a1,1,0,0,1-.69,1.23L53.66,72A1,1,0,0,1,52.43,71.32Z" fill="#c4cefe"></path>
                                    <ellipse cx="55.46" cy="19.1" rx="16.04" ry="16.1" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></ellipse>
                                    <ellipse cx="55.46" cy="19.1" rx="12.11" ry="12.16" fill="#e3e7fe"></ellipse><text transform="translate(50.7 23.72) scale(0.99 1)" font-size="16.12" fill="#6576ff" font-family="Nunito-Black, Nunito Black">$</text>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Assets</h4>
                                <p>Comes with a huge collection of pre-built pages &amp; screens.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <path d="M29,74H11a7,7,0,0,1-7-7V17a7,7,0,0,1,7-7H61a7,7,0,0,1,7,7V30" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    <path d="M11,11H61a6,6,0,0,1,6,6v4a0,0,0,0,1,0,0H5a0,0,0,0,1,0,0V17A6,6,0,0,1,11,11Z" fill="#e3e7fe"></path>
                                    <circle cx="11" cy="16" r="2" fill="#6576ff"></circle>
                                    <circle cx="17" cy="16" r="2" fill="#6576ff"></circle>
                                    <circle cx="23" cy="16" r="2" fill="#6576ff"></circle>
                                    <rect x="11" y="27" width="19" height="19" rx="1" ry="1" fill="#c4cefe"></rect>
                                    <path d="M33.8,53.79c.33-.43.16-.79-.39-.79H12a1,1,0,0,0-1,1V64a1,1,0,0,0,1,1H31a1,1,0,0,0,1-1V59.19a10.81,10.81,0,0,1,.23-2Z" fill="#c4cefe"></path>
                                    <line x1="36" y1="29" x2="60" y2="29" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="36" y1="34" x2="55" y2="34" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="36" y1="39" x2="50" y2="39" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="36" y1="44" x2="46" y2="44" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <rect x="4" y="21" width="64" height="2" fill="#6576ff"></rect>
                                    <rect x="36" y="56" width="38" height="24" rx="5" ry="5" fill="#fff" stroke="#e3e7fe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <rect x="41" y="60" width="12" height="9" rx="1" ry="1" fill="#c4cefe"></rect>
                                    <path d="M84.74,53.51,66.48,35.25a4.31,4.31,0,0,0-6.09,0l-9.13,9.13a4.31,4.31,0,0,0,0,6.09L69.52,68.73a4.31,4.31,0,0,0,6.09,0l9.13-9.13A4.31,4.31,0,0,0,84.74,53.51Zm-15-5.89L67,50.3a2.15,2.15,0,0,1-3,0l-4.76-4.76a2.16,2.16,0,0,1,0-3l2.67-2.67a2.16,2.16,0,0,1,3,0l4.76,4.76A2.15,2.15,0,0,1,69.72,47.62Z" fill="#6576ff"></path>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Asset Marketplace</h4>
                                <p>It’s includes 20+ components to power your application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
                                    <rect x="3.5" y="14" width="36" height="62" rx="2" ry="2" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <line x1="3.5" y1="22" x2="39.5" y2="22" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="3.5" y1="64" x2="39.5" y2="64" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="20.5" y1="18" x2="25.5" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="17.17" y1="18" x2="17.17" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <circle cx="21.5" cy="70" r="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                    <rect x="7.5" y="25" width="28" height="35" fill="#eff1ff"></rect>
                                    <rect x="10.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="16.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="22.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="28.5" y="40" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="50.5" y="14" width="36" height="62" rx="2" ry="2" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></rect>
                                    <line x1="50.5" y1="22" x2="86.5" y2="22" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="50.5" y1="64" x2="86.5" y2="64" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="67.5" y1="18" x2="72.5" y2="18" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <line x1="64.45" y1="17.86" x2="64.45" y2="17.86" fill="none" stroke="#c4cefe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                    <circle cx="68.5" cy="70" r="2" fill="none" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                    <rect x="54.5" y="25" width="28" height="35" fill="#eff1ff"></rect>
                                    <rect x="57.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="63.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="69.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <rect x="75.5" y="39" width="4" height="6" rx="2" ry="2" fill="#c4cefe"></rect>
                                    <ellipse cx="45.51" cy="44" rx="15.18" ry="15" fill="#fff" stroke="#6576ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></ellipse>
                                    <ellipse cx="45.51" cy="44" rx="11.13" ry="11" fill="#e3e7fe"></ellipse>
                                    <path d="M46,50.92s5.5-2.77,5.5-6.92V39.16L46,37.08l-5.5,2.08V44C40.5,48.15,46,50.92,46,50.92Z" fill="#6576ff"></path>
                                    <polyline points="48.04 42 44.56 46 42.98 44.18" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                                </svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">MyMI Asset Exchange</h4>
                                <p>Complete responsive & user-friendly to pleasing your user.</p>
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
                        <span class="overline-title">For More Info</span>
                        <h2 class="intro-heading-lead title">Announcements</h2>
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




<!-- <div id="preview" class="intro-section intro-apps text-center text-white bg-primary-dark">
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
</div> -->