<?php
$currentUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserEmail 		= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$marketMovers			= date("F-jS-Y");
$beta                   = $this->config->item('beta'); 
if ($beta === 0) {
    $registrationURL    = site_url('/Free/register'); 
} elseif ($beta === 1) {
    $registrationURL    = site_url('/Beta/register'); 
}
?>

<div class="intro-navbar">
    <div class="container container-ld">
        <div class="intro-wrap">
            <div class="intro-logo"><a href="./" class="logo-link"><img class="logo-img logo-light" src="<?php echo base/images/logo.png" srcset="/images/logo2x.png 2x" alt="DashLite Template"><img class="logo-img logo-dark" src="/images/logo-dark.png" srcset="/images/logo-dark2x.png 2x" alt="DashLite Template"></a></div>
            <div class="intro-nav">
                <ul class="nav">
                    <li class="nav-item intro-nav-item"><a href="#preview" class="link-to nav-link intro-nav-link"><span class="d-none d-md-inline">All Preview</span> <span class="d-md-none">Preview</span> </a></li>
                    <li class="nav-item intro-nav-item"><a href="#features" class="link-to nav-link intro-nav-link">Features</a></li>
                    <li class="nav-item intro-nav-item"><a href="https://docs.dashlite.net/html/" target="_blank" class="nav-link intro-nav-link">Docs</a></li>
                    <li class="nav-item intro-nav-item d-none d-lg-inline-flex"><a href="https://themeforest.net/user/softnio#contact" target="_blank" class="nav-link intro-nav-link">Need Help?</a></li>
                </ul>
                <div class="intro-action"><a href="https://1.envato.market/e0y3g" class="btn btn-primary" target="_blank"><span class="d-none d-md-block">Purchase Now</span><em class="d-md-none icon ni ni-dashlite"></em></a></div>
            </div>
        </div>
    </div>
</div>