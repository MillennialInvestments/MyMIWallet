<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$beta                                   = $this->config->item('beta');
$errorClass                             = empty($errorClass) ? ' error' : $errorClass;
$controlClass                           = empty($controlClass) ? 'span6' : $controlClass;
$walletType                             = $this->uri->segment(2);
// print_r($_SESSION);
$MyMIGoldCoinSum                        = $_SESSION['allSessionData']['userCoinData']['coinSum'];
$premium_wallet_cost                    = $this->config->item('wallet_cost');
$thisURL                                = $this->uri->uri_string(); 
$fieldData                              = array(
    'errorClass'                        => $errorClass,
    'controlClass'                      => $controlClass,
    'walletType'	                    => $walletType,
    'beta'                              => $beta,
);
$bankingIntegrationCost                 = $this->config->item('banking_integration_cost');
if ($walletType === 'Fiat') {
    $walletLink                         = 'Add-Wallet/Free/Fiat';
    $automatedWalletLink                = 'Purchase-Wallet/Fiat';
    $freeWalletLinkID                   = 'id="addDigitalWalletBtn" data-toggle="tab" href="#tabItem6"';
    $premiumWalletLinkID                = 'id="automatedIntegrationBtn" data-toggle="tab" href="#tabItem7"';
} elseif ($walletType === 'Digital') {
    $walletLink                         = 'Add-Wallet/Free/Digital';
    $automatedWalletLink                = 'Purchase-Wallet/Digital';
    $freeWalletLinkID                   = 'id="addDigitalWalletBtn" data-toggle="tab" href="#tabItem6"';
    $premiumWalletLinkID                = 'id="automatedIntegrationBtn" data-toggle="tab" href="#tabItem7"';
} else {
    $freeWalletLinkID                   = 'id="addDigitalWalletBtn" data-toggle="tab" href="#tabItem6"';
    $premiumWalletLinkID                = 'id="automatedIntegrationBtn" data-toggle="tab" href="#tabItem7"';
}
// $accountWallet                          = site_url('Wallets/Accounting/Add/Account');
$bankingWallet                          = site_url('Wallets/Banking/Add/Account');
// $ecommerceWallet                        = site_url('Wallets/eCommerce/Add/Account');
$investmentWallet                       = site_url('Wallets/Investment/Add/Account');
// $accountWallet                          = '';
// $bankingWallet                          = '';
// $ecommerceWallet                        = '';
// $investmentWallet                       = '';
?>
<!-- <ul class="nav nav-tabs">    
    <li class="nav-item">        
        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>nav</span></a>   
    </li>    
    <li class="nav-item">        
        <a class="nav-link" data-bs-toggle="tab" href="#tabItem6"><em class="icon ni ni-lock-alt"></em><span>nav</span></a>    
    </li>    
    <li class="nav-item">        
        <a class="nav-link" data-bs-toggle="tab" href="#tabItem7"><em class="icon ni ni-bell"></em><span>nav</span></a>    
    </li>    
    <li class="nav-item">        
        <a class="nav-link" data-bs-toggle="tab" href="#tabItem8"><em class="icon ni ni-link"></em><span>nav</span></a>    
    </li>
</ul> -->
<div class="tab-content">    
    <div class="tab-pane active" id="tabItem5">     
        <div class="modal-header">
            <h3 class="modal-title" id="useCoinModalLabel">Select Wallet Integration</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">    
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Starter</h4>
                                    <p class="sub-text">Manually Connect and Manage Your Wallet (Investment Account)</p>
                                </div>
                                <div class="card-text">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="h4 fw-500">FREE</span>
                                            <span class="sub-text">Per Wallet</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="h4 fw-500">Unlimited</span>
                                            <span class="sub-text">Wallets</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <!-- <ul class="pricing-features">
                                    <li><span class="w-50">Min Deposit</span> - <span class="ms-auto">$250</span></li>
                                    <li><span class="w-50">Max Deposit</span> - <span class="ms-auto">$1,999</span></li>
                                    <li><span class="w-50">Deposit Return</span> - <span class="ms-auto">Yes</span></li>
                                    <li><span class="w-50">Total Return</span> - <span class="ms-auto">125%</span></li>
                                </ul> -->
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" <?php echo $freeWalletLinkID; ?>>Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Premium</h4>
                                    <p class="sub-text">Utilize Our Automated Integration Service to connect your financial investment accounts!</p>
                                </div>
                                <div class="card-text">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="h4 fw-500"><?php echo $bankingIntegrationCost; ?> <small>MyMIG</small></span>
                                            <span class="sub-text">Per Wallet</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="h4 fw-500">Monthly</span>
                                            <span class="sub-text">Renewal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <!-- <ul class="pricing-features">
                                    <li><span class="w-50">Min Deposit</span> - <span class="ms-auto">$2,000</span></li>
                                    <li><span class="w-50">Max Deposit</span> - <span class="ms-auto">$4,999</span></li>
                                    <li><span class="w-50">Deposit Return</span> - <span class="ms-auto">Yes</span></li>
                                    <li><span class="w-50">Total Return</span> - <span class="ms-auto">200%</span></li>
                                </ul> -->
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" <?php echo $premiumWalletLinkID; ?>>Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div>
            </div><!-- .nk-block -->
        </div>
    </div>    
    <div class="tab-pane" id="tabItem6">        
        <div class="modal-header">
            <h3 class="modal-title" id="useCoinModalLabel">Select Wallet Integration</h3>
            <a class="btn mt-1"  data-toggle="tab" href="#tabItem5"><em class="icon ni ni-arrow-left"></em> Go Back</a>  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <br>
        </div> 
        <div class="modal-body">    
            <div class="nk-block">
                <div class="row justify-content g-gs">
                    <?php 
                    /*
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Accounting</h4>
                                    <p class="sub-text"></p>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" href="<?php echo $accountWallet; ?>">Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col --> 
                    */ ?>
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Banking</h4>
                                    <p class="sub-text"></p>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" href="<?php echo $bankingWallet; ?>">Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->    
                    <?php 
                    /* 
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">E-Commerce</h4>
                                    <p class="sub-text"></p>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" href="<?php echo $ecommerceWallet; ?>">Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->   
                    */
                    ?>
                    <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Investments</h4>
                                    <p class="sub-text"></p>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" href="<?php echo $investmentWallet; ?>">Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->  
                    <!-- <div class="col-12 col-md-6">
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Investments</h4>
                                    <p class="sub-text"></p>
                                </div>
                                !-- <div class="card-text">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="h4 fw-500"><?php // echo $bankingIntegrationCost; ?> <small>MyMIG</small></span>
                                            <span class="sub-text">Per Wallet</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="h4 fw-500">Monthly</span>
                                            <span class="sub-text">Renewal</span>
                                        </div>
                                    </div>
                                </div> --
                            </div>
                            <div class="pricing-body">
                                !-- <ul class="pricing-features">
                                    <li><span class="w-50">Min Deposit</span> - <span class="ms-auto">$2,000</span></li>
                                    <li><span class="w-50">Max Deposit</span> - <span class="ms-auto">$4,999</span></li>
                                    <li><span class="w-50">Deposit Return</span> - <span class="ms-auto">Yes</span></li>
                                    <li><span class="w-50">Total Return</span> - <span class="ms-auto">200%</span></li>
                                </ul> --
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-outline-primary" <?php // echo $premiumWalletLinkID; ?>>Choose this plan</a>
                                </div>
                            </div>
                        </div>
                    </div>!-- .col -->    
                    <?php //$this->load->view($automatedWalletLink); ?>
                </div>    
            </div>    
        </div>    
    </div>    
    <div class="tab-pane" id="tabItem7">        
        <a class="btn mt-1"  data-toggle="tab" href="#tabItem5"><em class="icon ni ni-arrow-left"></em> Go Back</a>      
        <?php //$this->load->view($automatedWalletLink); ?>
    </div>     
    <div class="tab-pane" id="tabItem8">        
        <a class="btn mt-1"  data-toggle="tab" href="#tabItem5"><em class="icon ni ni-arrow-left"></em> Go Back</a>      
        <?php //$this->load->view($automatedWalletLink); ?>
    </div>    
</div>
