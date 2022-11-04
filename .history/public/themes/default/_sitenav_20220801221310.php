<?php
$currentUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserEmail 		= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$marketMovers			= date("F-jS-Y");
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
?>
<style>
.intro-navbar {
    background-color: #10006b;
}
.intro-navbar.scrolled {
  background-color: #fff !important;
  transition: background-color 200ms linear;
}
.intro-action {
    bottom 
}
.logo-light {
    opacity: 1; 
}
</style>
<div class="intro-navbar">
    <div class="container container-ld">
        <div class="intro-wrap row">
            <div class="intro-logo d-flex col-3">
                <a href="<?php echo site_url('/'); ?>" class="logo-link w-50">
                    <img class="logo-img logo-light img-fluid d-none d-sm-block" src="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" srcset="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" alt="MyMI Wallet - Investment Accounting/Analytical Software & Crypto Asset Marketplace/Exchange">
                    <img class="logo-img logo-dark img-fluid d-none d-sm-block" src="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" srcset="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" alt="MyMI Wallet - Investment Accounting/Analytical Software & Crypto Asset Marketplace/Exchange">
                    <img class="logo-img logo-dark img-fluid d-block d-sm-none" src="<?php echo base_url('assets/images/MyMI-Wallet.png'); ?>" srcset="<?php echo base_url('assets/images/MyMI-Wallet.png'); ?>" alt="MyMI Wallet - Investment Accounting/Analytical Software & Crypto Asset Marketplace/Exchange">
                </a>
            </div>
            <div class="intro-nav align-content-right col-9">
                <ul class="nav">
                    <!-- <li class="nav-item intro-nav-item">
                        <a href="#preview" class="link-to nav-link intro-nav-link">
                            <span class="d-none d-md-inline">All Preview</span> <span class="d-md-none">Preview</span> 
                        </a>
                    </li> -->
                    <li class="nav-item intro-nav-item">
                        <a href="#features" class="link-to nav-link intro-nav-link">Features</a>
                    </li>
                    <li class="nav-item d-none intro-nav-item">
                        <a href="<?php echo site_url('Knowledge-Base'); ?>" target="_blank" class="nav-link intro-nav-link">Docs</a>
                    </li>
                    <!-- <li class="nav-item intro-nav-item">
                        <a href="<?php //echo site_url('Invest'); ?>" target="_blank" class="nav-link intro-nav-link">Invest</a>
                    </li> -->
                    <li class="nav-item intro-nav-item d-lg-inline-flex">
                        <a href="<?php echo site_url('Customer-Support'); ?>" target="_blank" class="nav-link intro-nav-link">Need Help?</a>
                    </li>
                </ul>
                <div class="intro-action">
                    <a href="<?php echo site_url('/login'); ?>" class="btn btn-primary">
                        <span class="d-none d-md-block">Login</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>