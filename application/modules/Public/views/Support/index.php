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
@media (min-width: 1540px) {
    .intro-featured-card {
        padding: 50px;
    }
}
</style>
<<<<<<< HEAD
<div class="intro-section intro-purchase bg-white">
=======
<div class="intro-section intro-purchase bg-lighter">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center pt-5">
                    <span class="overline-title">Get Support Today</span>
                    <h2 class="intro-heading-lead intro-title">Contact Support</h2>
                    <div class="intro-section-desc">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row intro-featured-block align-items-center no-gutters pt-0" style="max-width: 100%;">
                    <div class="col-12 col-sm-6 pr-5">
                        <div class="intro-featured-card left text-white" style="margin-top:-100px;" >
                            <?php $this->load->view('User/Support/Request'); ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 pl-5">
                        <div class="intro-featured-card right">
                            <?php $this->load->view('User/Support/FAQs'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-gs pt-5">
            <div class="col-xl-12">
                <div class="nk-block-head nk-block-head-lg wide-md">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><span>Guides &amp; Tutorials</span></div>
                        <h2 class="nk-block-title fw-normal">Suggested Tutorials</h2>
                        <div class="nk-block-des">
                            <p class="lead"></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner p-0">
                        <div class="nk-block-content">
                            <?php $this->load->view('User/Knowledgebase/Tutorials'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>