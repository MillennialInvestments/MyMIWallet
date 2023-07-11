<?php
$currentUserID 			= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$beta                   = $this->config->item('beta'); 
<<<<<<< HEAD
$website_version        = $this->config->item('website_version');
$registerType           = $this->uri->segment(1);
if ($registerType === 'Investor') {
    $title		        = 'Register An Investor Account';
} else {
    $title		        = 'Register An Investor Account Free!';
};
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
$formData               = array(
    'title'             => $title,
    'registerType'      => $registerType,
);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
?>
<style>
    .intro-banner{
        background: url(<?php echo base_url('assets/images/MyMI-Walllet-Background.jpeg'); ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .intro-banner .version {background-color: #3E61BC;}
<<<<<<< HEAD
    .ad-font-md{font-size: 3rem !important;}
    .ad-font-lg{font-size: 5rem !important;}
</style>
<div class="intro-banner pb-3 bg-dark">
    <div class="container pt-3">
        <div class="row justify-content-center pt-1">
            <div class="col-md-12 col-lg-6 border-right-md">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc py-md-0 py-lg-5">
                            <div class="row">
                                <span class="overline-title">Introducing</span>
                                <h1 class="title text-white">MyMI Wallet <span class="version"><?php echo $website_version; ?></span> </h1>
                                <h2 class="subttitle text-white pb-3">Financial Solutions for<br>Personal Budgeting, Investment Portfolio Management, and Retirement Planning</h2>
                                <!-- <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1> -->
                                <p class="text-light">
                                Our financial services provide comprehensive solutions for personal budgeting, investing, and retirement planning. 
                                With our budgeting tools, you can track your spending and create a budget that works for you. 
                                Our investment services offer a range of solutions and retirement planning services to help you grow your wealth and secure your financial well-being. 
                                Get started today to learn more about our financial services and take control of your financial future.
                                    <!-- Our financial budgeting and forecasting tools are designed to help you manage your money and plan for the future. 
                                    <a href="#features">MyMI Wallet</a> make it easy to track your spending, create a budget, and see into your financial future.  -->
                                    <!-- We also provide features to help you make smart investments and plan for retirement. 
                                    Whether you want to save money, invest, or plan for the future, our tools can give you the information you need to make good financial decisions. 
                                    Give our tools a try and take control of your financial future. -->
                                </p>
                                <ul class="intro-action-group d-md-none d-lg-block">
                                    <li class="d-none"><a href="<?php echo $btnURL; ?>" class="btn btn-lg btn-primary"><?php echo $btnText; ?></a></li>
                                    <li><a href="<?php echo site_url('/Knowledge-Base'); ?>" class="link-to btn btn-lg btn-light">Learn More</a></li>
                                </ul>
=======
</style>
<!-- <div class="intro-banner bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc pt-5">
                            <div class="row">
                                <div class="col-12 col-sm-6 border-right">
                                    <span class="overline-title pt-5">Introducing</span>
                                    <h1 class="title text-white">MyMI Wallet <span class="version">v7.1.5</span> </h1>
                                    <ul class="intro-action-group mt-3">
                                        <li><a href="<?php echo $btnURL; ?>" class="btn btn-md btn-primary" target="_blank"><?php echo $btnText; ?></a></li>
                                        <li><a href="<?php echo site_url('/Knowledge-Base'); ?>" class="link-to btn btn-md btn-light">Learn More</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-6 pl-5">
                                    <h2 class="subttitle text-white pt-3 pb-3">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h2>
                                    <p class="text-light">
                                        A powerful Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange for Retail & Institutional Investors alike. 
                                        <strong class="text-white">MyMI Wallet</strong> comes with a variety of <a href="">Premium Features</a>, necessary to provide Investors with the Accounting & Analytical Tools and our <strong class="text-primary">Asset Marketplace & Exchanges</strong> that helps you to create your own <a href="">Digital Assets</a> to sell to intereseted potential investors. HI
                                    </p>
                                </div>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            <div class="col-md-12 col-lg-6 pl-lg-5">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner pt-5">
                        <div class="intro-banner-desc pt-md-0 pt-lg-5">
                            <div class="card rounded p-3">
                                <div class="card-body">
                                    <?php $this->load->view('users/register_form', $formData); ?>
                                </div>
                            </div>
                            <div id="features"></div>
                        </div>
=======
        </div>
    </div>
</div> -->
<div class="intro-banner bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc pt-5">
                            <span class="overline-title pt-5">Introducing</span>
                            <h1 class="title text-white">MyMI Wallet <span class="version">v7.1.5</span> </h1>
                            <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1>
                            <p class="text-light">
                                A powerful Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange for Retail & Institutional Investors alike. 
                                <strong class="text-white">MyMI Wallet</strong> comes with a variety of <a href="#features">Premium Features</a>, necessary to provide Investors with the Accounting & Analytical Tools and our <strong class="text-primary">Asset Marketplace & Exchanges</strong> that helps you to create your <a href="#features">Digital Assets</a> to sell to interested potential investors.</p>
                        </div>
                        <ul class="intro-action-group">
                            <li><a href="<?php echo $btnURL; ?>" class="btn btn-lg btn-primary"><?php echo $btnText; ?></a></li>
                            <li><a href="<?php echo site_url('/Knowledge-Base'); ?>" class="link-to btn btn-lg btn-light">Learn More</a></li>
                        </ul>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
<div class="intro-section intro-feature bg-white">
    <div class="container container-xl">
=======
<div class="intro-section intro-overview text-center bg-lighter pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">MyMI Wallet Overview</span>
                    <h2 class="intro-heading-lead">Accounting <span class="break-mb">&</span> Analytical Statistics</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics, and optimize your investment decisions. 
                            Utilize our <a href="<?php echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet. 
                        </p>
                        <p>
                            To us, you are not just an investor, you are a <a href="<?php echo site_url('Knowledge-Base/MyMI-Partnerships'); ?>">Partner</a> in the Future to Come.
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
                <li><a href="<?php echo $btnURL; ?>" class="link-to btn btn-lg btn-primary"><?php echo $btnText; ?></a></li>
                <li><a href="<?php echo site_url('Knowledge-Base/Getting-Started'); ?>" class="link-to btn btn-lg btn-round btn-outline-primary">Get Started</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="promotion" class="intro-section intro-section-sm intro-promo-iv text-white">
    <div class="container container-ld">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="g pe-md-4">
                <div class="w-max-750px">
                    <h3 class="title mb-3">Looking for Advanced Accounting & Analytical Investment System?</h3>
                    <p class="lead">We're thrilled to welcome you to our new Automated Application to manage your future investments. 
                        Interested in learning more?</p>
                </div>
            </div>
            <div class="g mt-4 mt-md-0"><a href="<?php echo site_url('Knowledge-Base/Trade-Tracker'); ?>" target="_blank" class="btn btn-lg btn-primary"><span>Learn More!</span></a></div>
        </div>
    </div>
</div>
<div class="intro-section intro-feature bg-white" id="features">
    <div class="container container-ld">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Comprehensive Feature</span>
                    <h2 class="intro-heading-lead title">Features Overview</h2>
                    <div class="intro-section-desc">
                        <p>Customize your Investor and Partner Memberships with our super user-friendly dashboard and investment management system. 
                            MyMI Wallet comes equipped with all the tools you need to enhance your future trading strategies.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
<<<<<<< HEAD
                <div class="row justify-content-center intro-feature-list">
                    <div class="col-md-10 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                            <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#B6E892;" d="M450.586,61.414C412.663,23.488,360.304,0,302.561,0c-12.853,0-23.273,10.42-23.273,23.273v93.069 c0,12.853,10.42,23.273,23.273,23.273c19.25,0,36.707,7.83,49.351,20.474c12.643,12.643,20.474,30.099,20.474,49.351 c0,12.853,10.42,23.273,23.273,23.273h93.069c12.853,0,23.273-10.42,23.273-23.273C512,151.696,488.51,99.337,450.586,61.414z"></path> <path style="fill:#3E61BC;" d="M395.633,279.262h-93.072c-12.853,0-23.273,10.42-23.273,23.273 c0,38.501-31.322,69.824-69.824,69.824c-19.25,0-36.704-7.83-49.349-20.474c-12.642-12.643-20.472-30.099-20.472-49.351 c0-38.501,31.322-69.823,69.821-69.823c12.853,0,23.273-10.42,23.273-23.273v-93.097c0-12.853-10.42-23.273-23.273-23.273 C93.964,93.069,0,187.035,0,302.535c0,57.75,23.493,110.116,61.42,148.044C99.348,488.509,151.713,512,209.464,512 c115.499,0,209.467-93.966,209.467-209.465C418.931,289.682,408.486,279.262,395.633,279.262z"></path> <path style="fill:#7ED63E;" d="M302.561,0c-12.853,0-23.273,10.42-23.273,23.273v93.069c0,12.853,10.42,23.273,23.273,23.273 c19.25,0,36.707,7.83,49.351,20.474l98.676-98.676C412.663,23.488,360.304,0,302.561,0z"></path> <path style="fill:#364A63;" d="M209.464,232.712c12.853,0,23.273-10.42,23.273-23.273v-93.097c0-12.853-10.42-23.273-23.273-23.273 C93.964,93.069,0,187.035,0,302.535c0,57.75,23.493,110.116,61.42,148.044l98.695-98.695 c-12.642-12.643-20.472-30.099-20.472-49.351C139.643,264.034,170.963,232.712,209.464,232.712z"></path> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Personal Financial Budgeting</h4>
                                <p>Our Personal Financial Budgeting tool provides users with a comprehensive and intuitive solution for managing their finances. From tracking expenses and creating a budget, to setting financial goals and monitoring progress, our tool is designed to help users take control of their money and achieve financial success.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.002 512.002" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#57565C;" d="M488.729,465.455H23.275c-12.853,0-23.273,10.42-23.273,23.273s10.42,23.273,23.273,23.273h465.455 c12.853,0,23.273-10.42,23.273-23.273S501.582,465.455,488.729,465.455z"></path> <path style="fill:#559BFB;" d="M511.917,21.6c-0.026-0.363-0.05-0.726-0.095-1.088c-0.043-0.377-0.107-0.748-0.171-1.119 c-0.064-0.386-0.127-0.773-0.213-1.156c-0.076-0.346-0.171-0.684-0.264-1.026c-0.102-0.388-0.206-0.776-0.33-1.161 c-0.112-0.344-0.244-0.68-0.372-1.018c-0.137-0.36-0.27-0.721-0.424-1.077c-0.154-0.355-0.331-0.7-0.503-1.046 c-0.161-0.323-0.315-0.645-0.49-0.962c-0.197-0.352-0.416-0.692-0.628-1.035c-0.186-0.296-0.369-0.596-0.571-0.886 c-0.225-0.324-0.467-0.635-0.707-0.946c-0.23-0.295-0.456-0.591-0.7-0.878c-0.237-0.279-0.489-0.546-0.74-0.815 c-0.282-0.299-0.565-0.597-0.866-0.886c-0.104-0.101-0.194-0.211-0.301-0.309c-0.155-0.143-0.323-0.262-0.481-0.4 c-0.315-0.278-0.636-0.549-0.962-0.807c-0.285-0.223-0.576-0.441-0.87-0.65c-0.321-0.23-0.645-0.45-0.976-0.661 c-0.318-0.203-0.639-0.399-0.967-0.586c-0.329-0.189-0.661-0.368-0.996-0.538c-0.34-0.174-0.683-0.34-1.032-0.496 c-0.344-0.154-0.69-0.298-1.041-0.434c-0.351-0.138-0.706-0.27-1.067-0.391c-0.36-0.121-0.721-0.231-1.086-0.334 c-0.365-0.102-0.734-0.199-1.106-0.284c-0.365-0.084-0.732-0.158-1.098-0.223c-0.389-0.07-0.782-0.129-1.178-0.18 c-0.355-0.045-0.711-0.084-1.067-0.112c-0.419-0.034-0.844-0.054-1.269-0.065c-0.208-0.005-0.408-0.031-0.616-0.031h-93.091 c-12.853,0-23.273,10.42-23.273,23.273s10.42,23.273,23.273,23.273h39.824L294.144,199.171l-60.475-60.475 c-4.473-4.473-10.628-6.932-16.898-6.813c-6.326,0.121-12.328,2.81-16.628,7.449L6.205,348.581 c-8.738,9.427-8.18,24.151,1.249,32.889c4.479,4.152,10.153,6.204,15.813,6.204c6.253,0,12.49-2.506,17.074-7.453l177.507-191.519 l60.483,60.483c4.475,4.475,10.606,6.934,16.904,6.813c6.327-0.121,12.33-2.814,16.631-7.457L465.456,82.663v33.702 c0,12.853,10.42,23.273,23.273,23.273c12.853,0,23.273-10.42,23.273-23.273V23.274c0-0.144-0.02-0.284-0.022-0.427 C511.972,22.428,511.946,22.014,511.917,21.6z"></path> <path style="fill:#3E61BC;" d="M233.669,138.697c-4.473-4.473-10.628-6.932-16.898-6.813c-6.326,0.121-12.328,2.81-16.628,7.449 L6.205,348.583c-8.738,9.427-8.18,24.151,1.249,32.889c4.479,4.152,10.153,6.204,15.813,6.204c6.253,0,12.49-2.506,17.074-7.453 l177.507-191.519l38.153,38.149v-65.825L233.669,138.697z"></path> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Investment Portfolio Management</h4>
                                <p>(COMING SOON!) Our Investment Portfolio Management tool provides advanced tools for tracking and analyzing their investments. With real-time market updates, investment alerts, and trade sharing features, users have the information they need to make informed investment decisions and achieve their financial goals.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-4">
                        <div class="intro-feature-item">
                            <div class="intro-feature-media">
                                <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#559bfb ;" d="M488.727,407.272H79.458l18.452-18.454c9.089-9.089,9.089-23.824,0-32.912 c-9.087-9.089-23.824-9.089-32.912,0L6.819,414.085c-0.543,0.543-1.058,1.116-1.545,1.711c-0.217,0.264-0.41,0.548-0.614,0.821 c-0.248,0.334-0.509,0.663-0.74,1.005c-0.222,0.331-0.416,0.681-0.621,1.022c-0.185,0.309-0.379,0.614-0.549,0.929 c-0.186,0.349-0.348,0.712-0.515,1.071c-0.157,0.331-0.321,0.656-0.461,0.991c-0.146,0.348-0.262,0.709-0.391,1.066 c-0.127,0.36-0.268,0.718-0.379,1.083c-0.107,0.357-0.188,0.725-0.279,1.088c-0.095,0.374-0.2,0.743-0.275,1.12 c-0.084,0.42-0.135,0.85-0.195,1.277c-0.045,0.326-0.107,0.647-0.14,0.974C0.04,429.001,0,429.768,0,430.545s0.04,1.544,0.116,2.299 c0.033,0.326,0.093,0.649,0.14,0.974c0.061,0.427,0.112,0.858,0.195,1.277c0.074,0.377,0.18,0.746,0.275,1.12 c0.092,0.363,0.171,0.731,0.279,1.088c0.11,0.365,0.251,0.723,0.379,1.083c0.129,0.355,0.245,0.717,0.391,1.064 c0.14,0.335,0.304,0.661,0.461,0.991c0.168,0.358,0.329,0.723,0.515,1.071c0.169,0.315,0.363,0.619,0.549,0.929 c0.206,0.343,0.4,0.692,0.621,1.022c0.23,0.343,0.49,0.672,0.74,1.005c0.206,0.273,0.399,0.557,0.614,0.821 c0.489,0.594,1.002,1.168,1.545,1.711l58.179,58.177c4.543,4.549,10.499,6.82,16.455,6.82s11.913-2.271,16.455-6.817 c9.089-9.087,9.089-23.824,0-32.912l-18.452-18.452h409.27c12.853,0,23.273-10.42,23.273-23.273S501.58,407.272,488.727,407.272z"></path> <path style="fill:#3E61BC;" d="M511.747,78.205c-0.061-0.436-0.113-0.877-0.2-1.305c-0.073-0.366-0.175-0.728-0.267-1.091 c-0.093-0.374-0.175-0.752-0.287-1.119c-0.107-0.354-0.244-0.701-0.368-1.05c-0.13-0.368-0.253-0.74-0.402-1.098 c-0.133-0.321-0.293-0.635-0.441-0.951c-0.175-0.372-0.343-0.751-0.537-1.112c-0.16-0.296-0.344-0.583-0.517-0.873 c-0.216-0.362-0.424-0.729-0.656-1.078c-0.209-0.313-0.447-0.613-0.673-0.917c-0.228-0.304-0.441-0.618-0.681-0.911 c-0.424-0.515-0.877-1.01-1.351-1.496c-0.064-0.065-0.118-0.138-0.185-0.205L447.001,6.817c-9.087-9.089-23.824-9.089-32.912,0 s-9.089,23.824,0,32.912l18.455,18.455H23.273C10.42,58.185,0,68.605,0,81.457s10.42,23.273,23.273,23.273h409.268l-18.451,18.452 c-9.089,9.089-9.089,23.824,0,32.912c4.544,4.544,10.499,6.817,16.455,6.817s11.913-2.271,16.455-6.817l58.16-58.162l0.022-0.02 c0.551-0.551,1.067-1.125,1.55-1.714c0.189-0.23,0.355-0.478,0.535-0.715c0.279-0.368,0.563-0.732,0.818-1.112 c0.206-0.309,0.386-0.635,0.579-0.953c0.199-0.332,0.408-0.659,0.59-0.999c0.177-0.33,0.329-0.676,0.489-1.016 c0.163-0.348,0.34-0.692,0.486-1.046c0.14-0.334,0.251-0.68,0.372-1.019c0.137-0.375,0.281-0.748,0.396-1.128 c0.104-0.344,0.18-0.7,0.27-1.049c0.098-0.386,0.205-0.768,0.284-1.157c0.081-0.41,0.13-0.829,0.189-1.244 c0.047-0.335,0.11-0.669,0.144-1.004c0.076-0.756,0.116-1.522,0.116-2.298c0-0.777-0.04-1.545-0.116-2.302 C511.853,78.835,511.791,78.522,511.747,78.205z"></path> <path style="fill:#64C37D;" d="M221.687,307.966c-3.187-3.314-6.197-6.445-10.709-6.445c-7.64,0-13.791,8.513-13.791,15.56 c0,12.667,19.503,30.872,50.578,33.258v7.942c0,6.066,5.396,11.002,12.026,11.002c5.688,0,12.024-4.518,12.024-11.002v-9.385 c27.415-5.59,43-25.311,43-54.837c0-38.415-26.036-50.831-43-57.2v-51.478c7.368,1.264,12.251,3.753,16.033,5.682 c3.126,1.593,5.826,2.97,8.87,2.97c8.392,0,13.545-9.069,13.545-15.569c0-12.964-21.203-19.433-38.448-21.194v-6.333 c0-6.495-6.336-11.02-12.024-11.02c-6.63,0-12.026,4.943-12.026,11.02v6.999c-29.345,3.91-46.029,21.568-46.029,49.116 c0,34.596,24.869,44.707,46.029,52.201v62.526C233.118,319.857,226.352,312.819,221.687,307.966z M271.061,268.764 c9.712,5.562,15.157,12.899,15.157,26.816c0,12.629-4.974,20.683-15.157,24.436V268.764z M230.077,205.54 c0-4.155,0-15.954,18.202-19.703v42.543C235.762,223.075,230.077,217.424,230.077,205.54z"></path> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Crypto Asset Marketplace/Exchange</h4>
                                <p>(IN DEVELOPMENT) Our Cryptocurrency Asset Creator, Marketplace, and Exchange provide users with a comprehensive solution for buying, selling, and trading cryptocurrency assets. With a user-friendly interface, advanced trading tools, and a secure platform, users can confidently buy, sell, and trade their crypto assets with ease.</p>
                            </div>
                        </div>
                    </div>
=======
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
                                <p>Manage and Track your financial banking and investment accounts.</p>
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
                                <p>Customized Analysis of your financial investment data.</p>
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
                                <p>Integrate all of your Brokerage Accounts into one dashboard.</p>
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
                                <p>Create your digital asset for your next investment project.</p>
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
                                <p>Privately sell your financial data and digital assets.</p>
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
                                <p>Offer your assets to the public by utilizing our crypto exchange.</p>
                            </div>
                        </div>
                    </div>
                    
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<div id="promotion" class="intro-section intro-section-sm intro-promo-iv text-white">
    <div class="container container-lg text-center">
        <div class="justify-content-between align-items-center">
            <div class="g pe-md-12">
                <div class="full-width">
                    <span class="overline-title">Connect With Us</span>
                    <h2 class="intro-heading-lead title pb-3">Stay Connected EVERYWHERE!</h2>
                    <p class="lead">
                        <a class="mx-3" href="<?php echo $this->config->item('facebook_page'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                        </a>
                        <a class="mx-3" href="<?php echo $this->config->item('facebook_group'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                        </a>
                        <a class="mx-3" href="<?php echo $this->config->item('linkedin'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                            </svg>
                        </a>
                        <a class="mx-3" href="<?php echo $this->config->item('twitter'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                            </svg>
                        </a>
                        <a class="mx-3" href="<?php echo $this->config->item('discord'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-discord ad-font-lg" viewBox="0 0 16 16">
                                <path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z"/>
                            </svg>
                        </a>
                        <a class="mx-3" href="<?php echo $this->config->item('youtube'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
            <!-- <div class="g mt-4 mt-md-0"><a href="<?php echo site_url('Knowledge-Base'); ?>" target="_blank" class="btn btn-lg btn-primary"><span>Learn More!</span></a></div> -->
            <div id="howitworks"></div>
        </div>
    </div>
</div>
<div class="intro-section intro-feature bg-white">
    <div class="container container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Comprehensive Guide</span>
                    <h2 class="intro-heading-lead title">How It Works?</h2>
                    <div class="intro-section-desc">
                        <p>Customize your Investor and Partner Memberships with our super user-friendly dashboard and investment management system. 
                            MyMI Wallet comes equipped with all the tools you need to enhance your future trading strategies.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row justify-content-center intro-feature-list">
                    <div class="col-sm-6 col-lg-4">
                        <a class="intro-feature-item" href="<?php echo site_url('/How-It-Works/Registering-An-Account'); ?>">
                            <div class="intro-feature-media">
                                <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.002 512.002" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#EFC27B;" d="M268.843,95.853c-3.266-8.172-7.596-15.805-12.842-22.714 c-17.794-23.442-45.942-38.617-77.576-38.617c-53.684,0-97.358,43.674-97.358,97.358s43.674,97.358,97.358,97.358 c31.634,0,59.781-15.174,77.576-38.616c5.246-6.91,9.576-14.542,12.842-22.716c4.461-11.152,6.94-23.302,6.94-36.026 C275.783,119.154,273.304,107.004,268.843,95.853z"></path> <path style="fill:#5286FA;" d="M355.331,430.934c-5.353-40.918-24.627-77.514-52.894-104.878 c-6.692-6.478-13.885-12.439-21.52-17.816c-7.874-5.547-16.213-10.476-24.95-14.71c-23.46-11.368-49.77-17.749-77.543-17.749 C80.041,275.781,0,355.822,0,454.205c0,12.853,10.42,23.273,23.273,23.273h155.152h155.152c12.853,0,23.273-10.42,23.273-23.273 C356.85,446.32,356.329,438.554,355.331,430.934z"></path> <path style="fill:#ECB45C;" d="M81.068,131.88c0,53.684,43.674,97.358,97.358,97.358V34.522 C124.742,34.522,81.068,78.196,81.068,131.88z"></path> <path style="fill:#<svg height=" 200px"="" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path style="fill:#CEE8FA;" d="M496.917,255.997H354.315c0-54.308-44.021-98.33-98.33-98.33V15.065 C389.055,15.065,496.917,122.927,496.917,255.997z"></path> <path style="fill:#CEE8FA;" d="M496.917,255.997H354.315c0,24.26-8.801,46.451-23.363,63.599 c17.065,38.815,39.438,89.739,59.78,136.163C454.8,412.458,496.917,339.149,496.917,255.997z"></path> </g> <path style="fill:#3E61BCE61BC;" d="M512,255.997c0-0.333-0.01-0.662-0.032-0.989c-0.003-0.926-0.032-1.845-0.045-2.768 c-0.017-1.111-0.024-2.223-0.054-3.33c-0.03-1.096-0.081-2.187-0.125-3.278c-0.044-1.087-0.08-2.177-0.137-3.26 c-0.059-1.112-0.139-2.217-0.212-3.325c-0.069-1.055-0.131-2.112-0.212-3.164c-0.089-1.129-0.199-2.253-0.301-3.378 c-0.093-1.025-0.179-2.052-0.284-3.074c-0.119-1.144-0.259-2.282-0.393-3.42c-0.116-0.993-0.224-1.99-0.352-2.979 c-0.149-1.161-0.322-2.314-0.486-3.468c-0.138-0.963-0.266-1.928-0.415-2.887c-0.181-1.17-0.384-2.332-0.581-3.497 c-0.158-0.936-0.307-1.876-0.476-2.807c-0.214-1.186-0.45-2.365-0.68-3.545c-0.176-0.902-0.343-1.806-0.528-2.703 c-0.248-1.201-0.518-2.395-0.784-3.592c-0.193-0.869-0.376-1.742-0.578-2.607c-0.283-1.213-0.587-2.416-0.887-3.623 c-0.208-0.84-0.408-1.683-0.625-2.518c-0.316-1.219-0.655-2.429-0.987-3.641c-0.224-0.814-0.44-1.633-0.671-2.445 c-0.352-1.23-0.726-2.451-1.094-3.671c-0.236-0.783-0.464-1.568-0.707-2.348c-0.387-1.236-0.796-2.463-1.201-3.692 c-0.25-0.757-0.489-1.517-0.747-2.271c-0.425-1.249-0.872-2.488-1.316-3.729c-0.257-0.721-0.506-1.445-0.771-2.163 c-0.464-1.26-0.95-2.509-1.433-3.762c-0.266-0.689-0.524-1.383-0.795-2.07c-0.498-1.258-1.019-2.506-1.537-3.754 c-0.277-0.67-0.546-1.344-0.829-2.01c-0.534-1.258-1.091-2.506-1.645-3.756c-0.286-0.644-0.563-1.295-0.855-1.936 c-0.572-1.26-1.165-2.508-1.757-3.756c-0.294-0.62-0.578-1.246-0.878-1.864c-0.613-1.266-1.246-2.521-1.88-3.777 c-0.297-0.587-0.584-1.18-0.884-1.764c-0.649-1.263-1.319-2.512-1.988-3.763c-0.304-0.569-0.599-1.143-0.908-1.708 c-0.685-1.257-1.391-2.502-2.097-3.745c-0.31-0.546-0.611-1.099-0.926-1.644c-0.723-1.252-1.466-2.493-2.208-3.732 c-0.315-0.525-0.62-1.055-0.939-1.578c-0.76-1.248-1.541-2.482-2.323-3.718c-0.318-0.501-0.626-1.009-0.947-1.507 c-0.799-1.243-1.618-2.472-2.439-3.7c-0.319-0.479-0.631-0.965-0.954-1.441c-0.834-1.231-1.687-2.448-2.541-3.664 c-0.325-0.464-0.643-0.933-0.971-1.394c-0.869-1.221-1.758-2.423-2.648-3.628c-0.328-0.444-0.649-0.896-0.981-1.338 c-0.903-1.204-1.826-2.395-2.749-3.583c-0.334-0.431-0.659-0.866-0.996-1.293c-0.939-1.194-1.898-2.372-2.86-3.548 c-0.334-0.409-0.661-0.825-0.998-1.233c-0.974-1.177-1.966-2.339-2.961-3.5c-0.339-0.394-0.668-0.796-1.009-1.189 c-1.004-1.158-2.026-2.297-3.051-3.437c-0.345-0.384-0.682-0.774-1.03-1.156c-1.036-1.136-2.088-2.258-3.143-3.376 c-0.349-0.37-0.691-0.748-1.043-1.117c-1.064-1.115-2.146-2.213-3.23-3.309c-0.355-0.36-0.704-0.726-1.063-1.084 c-1.093-1.093-2.205-2.166-3.318-3.239c-0.361-0.348-0.715-0.703-1.078-1.049c-1.121-1.067-2.261-2.118-3.4-3.167 c-0.367-0.337-0.727-0.682-1.096-1.018c-1.142-1.037-2.303-2.058-3.464-3.074c-0.379-0.333-0.753-0.673-1.133-1.004 c-1.173-1.015-2.362-2.01-3.552-3.005c-0.381-0.318-0.757-0.644-1.139-0.96c-1.203-0.992-2.422-1.966-3.643-2.935 c-0.384-0.306-0.76-0.617-1.144-0.92c-1.21-0.951-2.439-1.883-3.667-2.813c-0.408-0.309-0.81-0.626-1.221-0.933 c-1.228-0.918-2.473-1.817-3.718-2.714c-0.42-0.303-0.832-0.613-1.254-0.912c-1.248-0.888-2.512-1.755-3.777-2.621 c-0.431-0.295-0.855-0.598-1.287-0.89c-1.261-0.852-2.539-1.684-3.816-2.514c-0.447-0.289-0.887-0.589-1.335-0.876 c-1.269-0.814-2.551-1.605-3.835-2.396c-0.468-0.289-0.932-0.587-1.401-0.873c-1.287-0.783-2.588-1.541-3.89-2.302 c-0.477-0.278-0.948-0.566-1.427-0.843c-1.293-0.744-2.6-1.465-3.905-2.186c-0.5-0.277-0.993-0.563-1.496-0.835 c-1.31-0.712-2.634-1.401-3.957-2.091c-0.507-0.265-1.009-0.539-1.517-0.799c-1.313-0.673-2.639-1.323-3.965-1.973 c-0.531-0.26-1.058-0.533-1.593-0.79c-1.301-0.628-2.613-1.23-3.924-1.835c-0.57-0.263-1.135-0.537-1.708-0.796 c-1.313-0.593-2.636-1.164-3.96-1.736c-0.581-0.251-1.156-0.513-1.74-0.76c-1.337-0.566-2.685-1.108-4.034-1.651 c-0.581-0.233-1.155-0.479-1.737-0.709c-1.344-0.531-2.699-1.036-4.054-1.544c-0.598-0.224-1.189-0.459-1.788-0.679 c-1.317-0.483-2.646-0.941-3.974-1.403c-0.647-0.224-1.29-0.462-1.939-0.682c-1.299-0.44-2.609-0.855-3.917-1.275 c-0.686-0.22-1.367-0.453-2.056-0.667c-1.322-0.411-2.654-0.798-3.984-1.188c-0.683-0.202-1.362-0.414-2.049-0.61 c-1.292-0.367-2.595-0.709-3.896-1.057c-0.736-0.197-1.468-0.406-2.207-0.596c-1.305-0.336-2.619-0.646-3.932-0.962 c-0.741-0.178-1.475-0.369-2.219-0.54c-1.319-0.306-2.648-0.584-3.975-0.869c-0.747-0.16-1.489-0.334-2.238-0.488 c-1.27-0.26-2.55-0.494-3.828-0.735c-0.814-0.154-1.624-0.322-2.441-0.468c-1.258-0.226-2.526-0.423-3.79-0.629 c-0.843-0.137-1.681-0.289-2.527-0.418c-1.275-0.196-2.559-0.363-3.84-0.539c-0.843-0.116-1.683-0.247-2.529-0.354 c-1.278-0.163-2.565-0.297-3.849-0.441c-0.856-0.096-1.708-0.206-2.568-0.294c-1.308-0.132-2.624-0.238-3.938-0.351 c-0.843-0.072-1.68-0.16-2.524-0.224c-1.364-0.104-2.735-0.179-4.105-0.26c-0.802-0.048-1.6-0.111-2.402-0.154 c-1.43-0.072-2.866-0.114-4.302-0.164c-0.75-0.026-1.496-0.066-2.249-0.086c-2.19-0.056-4.386-0.084-6.589-0.084 c-8.314,0-15.053,6.741-15.053,15.053v128.552c-15.013,2.005-29.511,6.993-42.578,14.718c-34.389,20.33-55.752,57.751-55.752,97.663 c0,30.242,12.248,59.209,33.396,80.331l-36.494,37.24c-5.819,5.937-5.723,15.467,0.215,21.287c2.929,2.871,6.733,4.301,10.535,4.301 c3.903,0,7.805-1.51,10.752-4.517l47.729-48.704c0.032-0.032,0.057-0.066,0.087-0.099c0.149-0.155,0.287-0.324,0.43-0.486 c0.25-0.283,0.492-0.569,0.717-0.864c0.051-0.068,0.11-0.125,0.16-0.193c0.08-0.108,0.143-0.223,0.22-0.334 c0.166-0.239,0.327-0.479,0.476-0.726c0.111-0.182,0.215-0.366,0.319-0.551c0.14-0.251,0.272-0.504,0.396-0.762 c0.095-0.196,0.184-0.394,0.269-0.595c0.107-0.248,0.208-0.498,0.301-0.753c0.08-0.217,0.152-0.434,0.22-0.652 c0.077-0.244,0.148-0.488,0.212-0.733c0.059-0.229,0.113-0.458,0.161-0.688c0.051-0.245,0.098-0.491,0.135-0.736 c0.036-0.229,0.066-0.459,0.092-0.688c0.029-0.256,0.051-0.513,0.066-0.771c0.012-0.217,0.021-0.432,0.024-0.649 c0.005-0.275,0.002-0.549-0.009-0.825c-0.008-0.196-0.02-0.391-0.035-0.587c-0.023-0.295-0.054-0.59-0.095-0.884 c-0.024-0.173-0.05-0.345-0.08-0.516c-0.054-0.312-0.117-0.622-0.19-0.93c-0.036-0.154-0.075-0.306-0.117-0.458 c-0.086-0.318-0.182-0.632-0.289-0.944c-0.05-0.143-0.101-0.286-0.155-0.429c-0.116-0.309-0.242-0.614-0.381-0.915 c-0.066-0.146-0.135-0.289-0.206-0.434c-0.141-0.288-0.292-0.57-0.453-0.849c-0.089-0.155-0.182-0.307-0.277-0.459 c-0.161-0.257-0.33-0.512-0.509-0.763c-0.116-0.161-0.236-0.319-0.358-0.477c-0.182-0.233-0.369-0.464-0.566-0.689 c-0.135-0.154-0.275-0.304-0.417-0.452c-0.125-0.131-0.236-0.271-0.367-0.399c-0.095-0.093-0.199-0.172-0.297-0.262 c-0.128-0.119-0.26-0.233-0.393-0.348c-0.271-0.236-0.546-0.462-0.831-0.674c-0.045-0.033-0.084-0.072-0.129-0.105 c-21.39-15.65-34.16-40.796-34.16-67.261c0-29.318,15.698-56.809,40.967-71.747c12.76-7.544,27.39-11.53,42.31-11.53 c45.92,0,83.277,37.358,83.277,83.277c0,19.705-7.027,38.833-19.785,53.855c-15.879,18.698-39.021,29.422-63.493,29.422 c-8.314,0-15.053,6.741-15.053,15.053c0,8.312,6.739,15.053,15.053,15.053c25.561,0,50.051-8.586,69.828-24.069 c1.072,2.44,2.157,4.907,3.254,7.406c3.379,7.69,6.872,15.64,10.444,23.771c0.05,0.113,0.099,0.224,0.148,0.337 c2.576,5.865,5.192,11.822,7.83,17.831c0.415,0.945,0.829,1.891,1.246,2.839c0.534,1.218,1.072,2.44,1.608,3.662 c3.567,8.124,7.165,16.323,10.76,24.518c0.214,0.488,0.427,0.974,0.641,1.463c2.484,5.66,4.963,11.314,7.427,16.933 c0.137,0.312,0.272,0.622,0.408,0.932c0.732,1.668,1.46,3.328,2.189,4.99c-34.924,20.898-74.694,31.886-115.785,31.886 C131.434,481.878,30.105,380.548,30.105,255.997c0-94.89,59.929-180.29,149.125-212.51c7.818-2.824,11.867-11.452,9.044-19.272 c-2.824-7.817-11.451-11.872-19.272-9.044C67.917,51.686,0,148.467,0,255.997c0,141.15,114.835,255.986,255.985,255.986 c51.314,0,100.822-15.129,143.176-43.752c70.398-47.58,112.512-126.547,112.795-211.374C511.973,256.571,512,256.288,512,255.997z M367.597,236.003c-0.098-0.545-0.217-1.082-0.322-1.624c-0.211-1.087-0.423-2.172-0.664-3.248c-0.143-0.638-0.306-1.267-0.461-1.9 c-0.236-0.971-0.473-1.94-0.733-2.901c-0.181-0.664-0.376-1.322-0.567-1.981c-0.266-0.917-0.539-1.832-0.828-2.741 c-0.214-0.668-0.438-1.332-0.664-1.996c-0.301-0.887-0.611-1.77-0.933-2.648c-0.242-0.659-0.492-1.317-0.747-1.97 c-0.339-0.87-0.688-1.733-1.048-2.592c-0.269-0.643-0.539-1.284-0.819-1.921c-0.379-0.863-0.774-1.715-1.174-2.565 c-0.289-0.614-0.575-1.228-0.875-1.836c-0.431-0.875-0.881-1.736-1.332-2.598c-0.297-0.566-0.587-1.135-0.893-1.695 c-0.506-0.926-1.036-1.838-1.567-2.749c-0.278-0.477-0.546-0.962-0.832-1.436c-0.709-1.176-1.445-2.333-2.196-3.482 c-0.126-0.193-0.244-0.393-0.372-0.586c-0.888-1.34-1.805-2.658-2.747-3.957c-0.265-0.364-0.543-0.717-0.811-1.078 c-0.686-0.924-1.377-1.844-2.091-2.746c-0.369-0.467-0.753-0.92-1.129-1.38c-0.637-0.78-1.275-1.556-1.931-2.318 c-0.421-0.489-0.857-0.968-1.287-1.45c-0.635-0.712-1.273-1.421-1.925-2.116c-0.459-0.489-0.926-0.969-1.392-1.45 c-0.65-0.67-1.307-1.334-1.973-1.987c-0.485-0.474-0.972-0.942-1.466-1.409c-0.676-0.638-1.359-1.269-2.049-1.891 c-0.503-0.453-1.007-0.903-1.519-1.347c-0.707-0.614-1.426-1.218-2.15-1.815c-0.513-0.424-1.025-0.849-1.546-1.264 c-0.754-0.601-1.522-1.186-2.291-1.769c-0.509-0.384-1.012-0.774-1.526-1.15c-0.832-0.608-1.68-1.195-2.529-1.781 c-0.471-0.325-0.933-0.659-1.409-0.975c-1.027-0.686-2.073-1.347-3.123-2c-0.313-0.194-0.619-0.402-0.935-0.593 c-1.376-0.837-2.77-1.645-4.182-2.423c-0.324-0.178-0.656-0.342-0.981-0.516c-1.091-0.589-2.186-1.168-3.298-1.721 c-0.524-0.26-1.06-0.503-1.588-0.754c-0.929-0.444-1.857-0.887-2.798-1.305c-0.598-0.265-1.203-0.515-1.805-0.771 c-0.891-0.378-1.784-0.753-2.685-1.108c-0.638-0.251-1.283-0.489-1.925-0.729c-0.884-0.33-1.77-0.653-2.664-0.96 c-0.664-0.229-1.332-0.449-2.002-0.665c-0.891-0.288-1.785-0.566-2.685-0.832c-0.68-0.202-1.362-0.397-2.047-0.587 c-0.909-0.251-1.824-0.486-2.743-0.715c-0.686-0.17-1.371-0.342-2.062-0.5c-0.941-0.215-1.888-0.409-2.836-0.602 c-0.679-0.137-1.356-0.28-2.038-0.403c-1-0.184-2.008-0.34-3.018-0.497c-0.641-0.099-1.278-0.209-1.924-0.298 c-0.141-0.02-0.281-0.047-0.424-0.065V30.626c0.288,0.02,0.575,0.032,0.863,0.053c0.789,0.056,1.574,0.12,2.362,0.184 c1.01,0.081,2.02,0.164,3.027,0.259c0.781,0.074,1.561,0.157,2.341,0.238c1.005,0.105,2.011,0.214,3.014,0.331 c0.774,0.092,1.546,0.19,2.318,0.289c1.003,0.129,2.005,0.262,3.003,0.405c0.762,0.108,1.522,0.223,2.282,0.339 c1.004,0.154,2.007,0.313,3.006,0.479c0.75,0.125,1.498,0.254,2.246,0.387c1.001,0.178,2,0.361,2.999,0.552 c0.738,0.141,1.475,0.284,2.21,0.434c1.006,0.202,2.008,0.412,3.009,0.629c0.718,0.155,1.436,0.312,2.151,0.473 c1.01,0.229,2.016,0.467,3.02,0.707c0.703,0.169,1.406,0.339,2.106,0.515c1.013,0.254,2.023,0.519,3.03,0.787 c0.682,0.181,1.364,0.361,2.043,0.548c1.025,0.283,2.046,0.578,3.065,0.876c0.653,0.19,1.31,0.378,1.96,0.575 c1.043,0.315,2.082,0.641,3.119,0.971c0.62,0.197,1.242,0.39,1.859,0.593c1.07,0.349,2.134,0.715,3.199,1.081 c0.575,0.197,1.153,0.39,1.727,0.593c1.117,0.394,2.226,0.804,3.334,1.215c0.513,0.19,1.031,0.375,1.543,0.569 c1.191,0.452,2.374,0.92,3.555,1.391c0.421,0.169,0.847,0.33,1.269,0.501c1.343,0.545,2.675,1.106,4.004,1.677 c0.254,0.108,0.51,0.212,0.765,0.322c4.811,2.083,9.536,4.329,14.168,6.732c0.063,0.032,0.123,0.066,0.187,0.099 c1.462,0.759,2.913,1.534,4.356,2.324c0.283,0.155,0.561,0.316,0.843,0.473c1.218,0.673,2.431,1.353,3.634,2.049 c0.385,0.223,0.765,0.453,1.148,0.677c1.094,0.64,2.186,1.284,3.266,1.943c0.44,0.268,0.873,0.542,1.311,0.813 c1.016,0.628,2.032,1.258,3.038,1.903c0.471,0.303,0.938,0.611,1.407,0.915c0.963,0.628,1.927,1.257,2.88,1.898 c0.486,0.327,0.968,0.659,1.451,0.99c0.927,0.634,1.851,1.27,2.77,1.918c0.495,0.349,0.986,0.704,1.478,1.058 c0.894,0.643,1.787,1.287,2.67,1.942c0.5,0.37,0.995,0.744,1.492,1.117c0.867,0.653,1.731,1.31,2.589,1.975 c0.498,0.385,0.993,0.777,1.489,1.167c0.846,0.667,1.689,1.34,2.524,2.019c0.492,0.4,0.981,0.802,1.471,1.206 c0.826,0.683,1.65,1.373,2.467,2.067c0.486,0.414,0.971,0.829,1.454,1.246c0.808,0.698,1.611,1.404,2.41,2.115 c0.477,0.424,0.953,0.85,1.427,1.279c0.795,0.72,1.582,1.444,2.366,2.174c0.465,0.434,0.93,0.867,1.392,1.304 c0.778,0.738,1.55,1.481,2.318,2.229c0.455,0.443,0.909,0.884,1.359,1.331c0.769,0.762,1.529,1.531,2.288,2.303 c0.435,0.443,0.87,0.884,1.302,1.331c0.762,0.789,1.514,1.587,2.264,2.386c0.417,0.444,0.835,0.887,1.249,1.334 c0.756,0.817,1.499,1.645,2.243,2.475c0.394,0.44,0.792,0.878,1.182,1.319c0.76,0.861,1.508,1.731,2.255,2.604 c0.36,0.421,0.724,0.838,1.081,1.261c0.775,0.918,1.537,1.847,2.297,2.779c0.318,0.39,0.641,0.775,0.957,1.167 c0.811,1.007,1.609,2.026,2.404,3.047c0.251,0.324,0.509,0.643,0.757,0.966c0.903,1.174,1.791,2.359,2.67,3.551 c0.134,0.181,0.271,0.357,0.403,0.537c3.056,4.162,5.971,8.434,8.743,12.805c0.191,0.301,0.375,0.607,0.563,0.909 c0.717,1.142,1.428,2.29,2.125,3.446c0.269,0.446,0.528,0.899,0.795,1.347c0.605,1.021,1.209,2.041,1.799,3.072 c0.3,0.525,0.59,1.057,0.887,1.584c0.54,0.963,1.081,1.927,1.609,2.899c0.312,0.575,0.614,1.156,0.921,1.734 c0.497,0.935,0.992,1.87,1.475,2.812c0.315,0.614,0.622,1.233,0.93,1.85c0.459,0.915,0.917,1.829,1.362,2.752 c0.313,0.646,0.617,1.296,0.924,1.945c0.427,0.903,0.852,1.806,1.267,2.715c0.306,0.668,0.604,1.343,0.903,2.016 c0.4,0.902,0.799,1.803,1.188,2.711c0.295,0.686,0.583,1.377,0.872,2.067c0.375,0.899,0.747,1.8,1.111,2.705 c0.284,0.706,0.563,1.415,0.84,2.125c0.352,0.902,0.698,1.805,1.04,2.711c0.269,0.718,0.534,1.438,0.796,2.159 c0.33,0.906,0.653,1.815,0.972,2.728c0.256,0.732,0.509,1.466,0.757,2.202c0.307,0.908,0.607,1.818,0.902,2.731 c0.241,0.745,0.48,1.492,0.714,2.24c0.284,0.914,0.561,1.83,0.835,2.749c0.224,0.756,0.449,1.511,0.665,2.27 c0.263,0.921,0.518,1.845,0.771,2.77c0.208,0.763,0.415,1.525,0.616,2.291c0.244,0.932,0.476,1.868,0.707,2.804 c0.19,0.766,0.381,1.532,0.563,2.302c0.223,0.942,0.434,1.889,0.644,2.836c0.172,0.772,0.346,1.541,0.51,2.317 c0.202,0.956,0.391,1.916,0.581,2.878c0.152,0.771,0.309,1.541,0.455,2.315c0.182,0.978,0.351,1.961,0.521,2.944 c0.132,0.762,0.269,1.52,0.393,2.285c0.164,1.007,0.31,2.02,0.461,3.033c0.111,0.748,0.229,1.493,0.333,2.244 c0.146,1.057,0.274,2.118,0.405,3.179c0.087,0.709,0.184,1.415,0.265,2.127c0.135,1.185,0.25,2.377,0.367,3.567 c0.059,0.593,0.126,1.183,0.181,1.776c0.161,1.788,0.303,3.581,0.421,5.38H368.371C368.151,239.286,367.889,237.639,367.597,236.003 z M396.971,432.497c-2.547-5.807-5.11-11.654-7.678-17.505c-0.247-0.564-0.494-1.127-0.742-1.69c-0.738-1.68-1.474-3.36-2.211-5.04 c-0.643-1.466-1.285-2.931-1.928-4.395c-0.45-1.027-0.9-2.049-1.349-3.074c-0.996-2.27-1.99-4.535-2.983-6.798 c-0.79-1.8-1.579-3.599-2.366-5.392c-0.465-1.06-0.929-2.115-1.392-3.172c-0.829-1.889-1.656-3.772-2.481-5.649 c-0.313-0.715-0.626-1.427-0.939-2.139c-0.986-2.246-1.967-4.48-2.944-6.706c-0.184-0.42-0.37-0.841-0.554-1.26 c-7.422-16.901-14.565-33.153-21.062-47.934c10.702-15.027,17.571-32.456,20.021-50.693h113.005 C477.155,334.378,446.532,392.886,396.971,432.497z"></path> </g>;" d="M0.002,454.207c0,12.853,10.42,23.273,23.273,23.273h155.152V275.783 C80.043,275.783,0.002,355.824,0.002,454.207z"&gt;</path> <path style="fill:#EFC27B;" d="M333.722,34.525c-0.037,0.048-0.084,0.057-0.144-0.003c-31.634,0-59.781,15.174-77.576,38.617 c5.246,6.909,9.576,14.542,12.842,22.714c4.461,11.152,6.94,23.301,6.94,36.026s-2.479,24.875-6.94,36.026 c-3.266,8.172-7.596,15.805-12.842,22.716c17.794,23.442,45.942,38.616,77.576,38.616c53.684,0,97.358-43.674,97.358-97.358 C430.935,78.245,387.339,34.604,333.722,34.525z"></path> <path style="fill:#00E7F0;" d="M333.577,275.783c-26.954,0-53.524,6.116-77.608,17.749c8.737,4.234,17.076,9.163,24.95,14.71 c7.635,5.378,14.829,11.338,21.52,17.816c12.187,11.798,22.691,25.319,31.139,40.155c11.148,19.575,18.71,41.446,21.754,64.721 c0.998,7.62,1.519,15.386,1.519,23.273c0,12.853-10.42,23.273-23.273,23.273h155.151c12.853,0,23.273-10.42,23.273-23.273 C512.002,355.824,431.96,275.783,333.577,275.783z"></path> <path style="fill:#00D7DF;" d="M280.919,308.24c7.635,5.378,14.829,11.338,21.52,17.816c12.187,11.798,22.691,25.319,31.139,40.155 v-90.428c-26.954,0-53.524,6.116-77.608,17.749C264.704,297.766,273.043,302.695,280.919,308.24z"></path> <g> <path style="fill:#ECB45C;" d="M256.002,73.139c5.246,6.909,9.576,14.542,12.842,22.714c4.461,11.152,6.94,23.301,6.94,36.026 s-2.479,24.875-6.94,36.026c-3.266,8.172-7.596,15.805-12.842,22.716c17.794,23.442,45.942,38.616,77.576,38.616V34.522 C301.943,34.522,273.796,49.696,256.002,73.139z"></path> <path style="fill:#ECB45C;" d="M333.722,34.525c-0.048,0-0.096-0.003-0.144-0.003C333.639,34.584,333.684,34.573,333.722,34.525z"></path> </g> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Registering An Account</h4>
                                <p>Step-by-step guide to create your MyMI Account.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <a class="intro-feature-item" href="<?php echo site_url('/How-It-Works/Personal-Budgeting'); ?>">
                            <div class="intro-feature-media">
                            <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#B6E892;" d="M450.586,61.414C412.663,23.488,360.304,0,302.561,0c-12.853,0-23.273,10.42-23.273,23.273v93.069 c0,12.853,10.42,23.273,23.273,23.273c19.25,0,36.707,7.83,49.351,20.474c12.643,12.643,20.474,30.099,20.474,49.351 c0,12.853,10.42,23.273,23.273,23.273h93.069c12.853,0,23.273-10.42,23.273-23.273C512,151.696,488.51,99.337,450.586,61.414z"></path> <path style="fill:#3E61BC;" d="M395.633,279.262h-93.072c-12.853,0-23.273,10.42-23.273,23.273 c0,38.501-31.322,69.824-69.824,69.824c-19.25,0-36.704-7.83-49.349-20.474c-12.642-12.643-20.472-30.099-20.472-49.351 c0-38.501,31.322-69.823,69.821-69.823c12.853,0,23.273-10.42,23.273-23.273v-93.097c0-12.853-10.42-23.273-23.273-23.273 C93.964,93.069,0,187.035,0,302.535c0,57.75,23.493,110.116,61.42,148.044C99.348,488.509,151.713,512,209.464,512 c115.499,0,209.467-93.966,209.467-209.465C418.931,289.682,408.486,279.262,395.633,279.262z"></path> <path style="fill:#7ED63E;" d="M302.561,0c-12.853,0-23.273,10.42-23.273,23.273v93.069c0,12.853,10.42,23.273,23.273,23.273 c19.25,0,36.707,7.83,49.351,20.474l98.676-98.676C412.663,23.488,360.304,0,302.561,0z"></path> <path style="fill:#364A63;" d="M209.464,232.712c12.853,0,23.273-10.42,23.273-23.273v-93.097c0-12.853-10.42-23.273-23.273-23.273 C93.964,93.069,0,187.035,0,302.535c0,57.75,23.493,110.116,61.42,148.044l98.695-98.695 c-12.642-12.643-20.472-30.099-20.472-49.351C139.643,264.034,170.963,232.712,209.464,232.712z"></path> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Personal Budgeting</h4>
                                <p>Manage your income and expenses.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <a class="intro-feature-item" href="<?php echo site_url('/How-It-Works/Determining-Your-Financial-Goals'); ?>">
                            <div class="intro-feature-media">
                                <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.003 512.003" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path style="fill:#3E61BC;" d="M214.952,68.97c-18.228,0-33.006,14.778-33.006,33.006s14.778,33.006,33.006,33.006h264.045 c18.228,0,33.006-14.778,33.006-33.006S497.225,68.97,478.997,68.97C478.997,68.97,214.952,68.97,214.952,68.97z"></path> <path style="fill:#3E61BC;" d="M478.997,222.996H214.952c-18.228,0-33.006,14.778-33.006,33.006 c0,18.228,14.778,33.006,33.006,33.006h264.045c18.228,0,33.006-14.778,33.006-33.006S497.225,222.996,478.997,222.996z"></path> <path style="fill:#3E61BC;" d="M478.997,377.022H214.952c-18.228,0-33.006,14.778-33.006,33.006 c0,18.228,14.778,33.006,33.006,33.006h264.045c18.228,0,33.006-14.778,33.006-33.006 C512.003,391.799,497.225,377.022,478.997,377.022z"></path> </g> <g> <path style="fill:#3E61BC;" d="M120.671,240.971c-1.941-5.974-7.105-10.329-13.323-11.231l-21.98-3.195l-9.829-19.918 c-2.781-5.633-8.515-9.2-14.8-9.2c-6.28,0-12.018,3.567-14.8,9.2l-9.831,19.918l-21.977,3.195 c-6.216,0.904-11.383,5.257-13.323,11.231c-1.941,5.974-0.321,12.531,4.174,16.916l15.904,15.502l-3.756,21.894 c-1.063,6.19,1.483,12.448,6.564,16.14c2.876,2.09,6.278,3.153,9.701,3.153c2.625,0,5.263-0.627,7.677-1.895l19.663-10.337 l19.663,10.337c2.416,1.27,5.052,1.895,7.677,1.895c0.015,0,0.033,0,0.046,0c9.114-0.002,16.501-7.389,16.501-16.503 c0-1.384-0.169-2.731-0.491-4.016l-3.547-20.668l15.904-15.502C120.992,253.502,122.612,246.945,120.671,240.971z"></path> <path style="fill:#3E61BC;" d="M120.671,86.945c-1.941-5.974-7.105-10.329-13.323-11.231l-21.98-3.195l-9.829-19.918 c-2.781-5.633-8.515-9.2-14.8-9.2c-6.28,0-12.018,3.567-14.8,9.2l-9.831,19.918l-21.977,3.195 C7.915,76.618,2.749,80.971,0.808,86.945c-1.941,5.974-0.321,12.531,4.174,16.916l15.904,15.502l-3.756,21.894 c-1.063,6.19,1.483,12.447,6.564,16.14c2.876,2.09,6.278,3.153,9.701,3.153c2.625,0,5.263-0.627,7.677-1.895l19.663-10.337 l19.663,10.337c2.416,1.27,5.052,1.895,7.677,1.895c0.015,0,0.033,0,0.046,0c9.114,0,16.501-7.389,16.501-16.503 c0-1.384-0.169-2.731-0.491-4.016l-3.547-20.668l15.904-15.502C120.992,99.476,122.612,92.919,120.671,86.945z"></path> <path style="fill:#3E61BC;" d="M120.671,394.997c-1.941-5.974-7.105-10.329-13.323-11.231l-21.98-3.195l-9.829-19.918 c-2.781-5.633-8.515-9.2-14.8-9.2c-6.28,0-12.018,3.567-14.8,9.2l-9.831,19.918l-21.977,3.195 c-6.216,0.902-11.383,5.257-13.323,11.231s-0.321,12.531,4.174,16.916l15.904,15.502l-3.756,21.892 c-1.063,6.192,1.483,12.45,6.564,16.142c2.876,2.09,6.278,3.153,9.701,3.153c2.625,0,5.263-0.627,7.677-1.895l19.663-10.337 l19.663,10.337c2.416,1.27,5.052,1.895,7.677,1.895c0.015,0,0.033,0,0.046,0c9.114-0.002,16.501-7.389,16.501-16.503 c0-1.384-0.169-2.731-0.491-4.016l-3.547-20.668l15.904-15.502C120.992,407.528,122.612,400.971,120.671,394.997z"></path> </g> </g></svg>
                            </div>
                            <div class="intro-feature-info">
                                <h4 class="title">Determing Financial Goals</h4>
                                <p>Manage your income and expenses.</p>
                            </div>
                        </a>
                    </div>
=======
<!-- <div class="intro-section intro-upcoming bg-white">
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
</div> -->




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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
<div class="intro-section intro-overview text-center bg-white pt-5">
    <div class="container pt-5">
        <?php 
        /*
        <div class="row justify-content-center py-5">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">MyMI Wallet Overview</span>
                    <h2 class="intro-heading-lead">Personal Budgeting</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>
                        <!-- <p>
                            To us, you are not just another customer!<br>You are a <a href="<?php echo site_url($btnURL); ?>">Partner</a> in the Future of Your Financial Growth.
                        </p> -->
                        <?php //print_r($_SESSION['reporting']); ?>
=======
<div id="intro-layout" class="intro-section intro-preview bg-lighter">
    <div class="container-xl">
        <div class="row justify-content-center text-center">
            <div class="col-lg-7">
                <div class="intro-section-title">
                    <span class="intro-section-subtitle overline-title">Admin Tempalte Layout</span>
                    <h2 class="intro-heading-lead intro-title">Multipurpose Admin Dashboard</h2>
                    <div class="intro-section-desc">
                        <p>DashLite template included different layouts that fit into any application. Also all the layouts supported <strong>Dark Theme Mode</strong> & <strong>RTL Compatibility</strong>, which will give more power on your application.</p>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
        <div class="row justify-content-center  py-5">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h2 class="intro-heading-lead">Financial Forecasting</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>
                        <!-- <p>
                            To us, you are not just another customer!<br>You are a <a href="<?php echo site_url($btnURL); ?>">Partner</a> in the Future of Your Financial Growth.
                        </p> -->
                        <?php //print_r($_SESSION['reporting']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center  py-5">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h2 class="intro-heading-lead">Retirement Planning</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>
                        <!-- <p>
                            To us, you are not just another customer!<br>You are a <a href="<?php echo site_url($btnURL); ?>">Partner</a> in the Future of Your Financial Growth.
                        </p> -->
                        <?php //print_r($_SESSION['reporting']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center  py-5">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h2 class="intro-heading-lead">Investment Tools  <span class="break-mb">&</span> Resources</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>
                        <!-- <p>
                            To us, you are not just another customer!<br>You are a <a href="<?php echo site_url($btnURL); ?>">Partner</a> in the Future of Your Financial Growth.
                        </p> -->
                        <?php //print_r($_SESSION['reporting']); ?>
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
        */
        ?>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">MyMI Wallet Overview</span>
                    <h2 class="intro-heading-lead">Accounting <span class="break-mb">&</span> Analytical Statistics</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
<<<<<<< HEAD
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
                <li><a href="<?php echo $btnURL; ?>" class="link-to btn btn-lg btn-primary"><?php echo $btnText; ?></a></li>
                <li><a href="<?php echo site_url('Knowledge-Base/Getting-Started'); ?>" class="link-to btn btn-lg btn-round btn-outline-primary">Get Started</a></li>
            </ul>
        </div>
    </div>
</div>
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
