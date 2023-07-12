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
.intro-action .btn {
    line-height: .75rem; 
}
.logo-light {
    opacity: 1; 
}
</style>
<div class="intro-navbar">
    <div class="container container-xl">
        <div class="intro-wrap row">
            <div class="intro-logo d-flex col-md-3 col-lg-4">
                <a href="<?php echo site_url('/'); ?>" class="logo-link w-100 mt-md-1">
                    <img class="logo-img logo-light img-fluid d-none d-md-block" src="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" srcset="<?php echo base_url('assets/images/Millennial-Investments.png'); ?>" alt="MyMI Wallet - Investment Accounting/Analytical Software & Crypto Asset Marketplace/Exchange">
                    <img class="logo-img logo-dark img-fluid d-block d-md-none" src="<?php echo base_url('assets/images/MyMI-Wallet.png'); ?>" srcset="<?php echo base_url('assets/images/MyMI-Wallet.png'); ?>" alt="MyMI Wallet - Investment Accounting/Analytical Software & Crypto Asset Marketplace/Exchange">
                </a>
            </div>
            <div class="d-md-none col-lg-2"></div>
            <div class="intro-nav align-items-right col-md-9 col-lg-6">
                <ul class="nav mt-1 pl-1">
                    <!-- <li class="nav-item intro-nav-item">
                        <a href="#preview" class="link-to nav-link intro-nav-link">
                            <span class="d-none d-md-inline">All Preview</span> <span class="d-md-none">Preview</span> 
                        </a>
                    </li> -->
                    <li class="nav-item intro-nav-item">
                        <a href="<?php echo site_url(''); ?>" class="link-to nav-link intro-nav-link">Home</a>
                    </li>
                    <li class="nav-item intro-nav-item">
                        <a href="<?php echo site_url(''); ?>#features" class="link-to nav-link intro-nav-link">Features</a>
                    </li>
                    <!-- <li class="nav-item intro-nav-item">
                        <a href="<?php echo site_url(''); ?>#howitworks" class="link-to nav-link intro-nav-link">How It Works</a>
                    </li> -->
                    <!-- Removed How It Works Link -->
                    <!-- Added dropdown menu for Resources with sub-links -->
                    <li class="intro-nav-item nav-item dropdown">
                    <a class="intro-nav-link nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Resources
                    </a>
                    <div class="dropdown-menu" aria-labelledby="resourcesDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('/Blog'); ?>">Blog</a>
                        <a class="dropdown-item" href="<?php echo site_url('/How-It-Works'); ?>">How It Works</a>
                        <a class="dropdown-item" href="<?php echo site_url('/Knowledgebase'); ?>">Knowledgebase</a>
                    </div>
                    </li>

                    <!-- <li class="nav-item d-none intro-nav-item">
                        <a href="<?php //echo site_url('Knowledge-Base'); ?>" target="_blank" class="nav-link intro-nav-link">Docs</a>
                    </li> -->
                    <!-- <li class="nav-item intro-nav-item">
                        <a href="<?php //echo site_url('Invest'); ?>" target="_blank" class="nav-link intro-nav-link">Invest</a>
                    </li> -->
                    <li class="nav-item intro-nav-item d-lg-inline-flex">
                        <a href="<?php echo site_url('Customer-Support'); ?>" target="_blank" class="nav-link intro-nav-link">Need Help?</a>
                    </li>
                </ul>
                <?php 
                if (!empty($currentUserID)) {
                    echo '
                    <div class="intro-action pt-1">
                        <a href="' . site_url('/Dashboard') . '" class="btn btn-primary">
                            <span>ACCOUNT</span>
                        </a>
                    </div>
                    ';
                } else {
                    echo '
                    <div class="intro-action pt-1">
                        <a href="' . site_url('/login') . '" class="btn btn-primary">
                            <span>LOGIN</span>
                        </a>
                    </div>
                    ';
                }
                // if (!empty($currentUserID)) {
                //     echo '
                //     <div class="intro-action pt-1">
                //         <a href="' . site_url('/Dashboard') . '" class="btn btn-primary">
                //             <span>ACCOUNT</span>
                //         </a>
                //         <a href="' . site_url('/logout') . '" class="btn btn-primary">
                //             <span>LOGOUT</span>
                //         </a>
                //     </div>
                //     ';
                // } else {
                //     echo '
                //     <div class="intro-action pt-1">
                //         <a href="' . $btnURL . '" class="btn btn-primary">
                //             <span>JOIN</span>
                //         </a>
                //         <a href="' . site_url('/login') . '" class="btn btn-primary">
                //             <span>LOGIN</span>
                //         </a>
                //     </div>
                //     ';
                // }
                ?>
            </div>
        </div>
    </div>
</div>