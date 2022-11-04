<?php
/**
*/
// MyMI Gold Values
$MyMIGold_Value                         = $this->config->item('mymig_coin_value');
$MyMIGold_TierOne                       = $this->config->item('tier_one');
$MyMIGold_TierOneCost                   = $MyMIGold_Value * $MyMIGold_TierOne; 
$MyMIGold_TierTwo                       = $this->config->item('tier_two');
$MyMIGold_TierTwoCost                   = $MyMIGold_Value * $MyMIGold_TierTwo; 
$MyMIGold_TierThree                     = $this->config->item('tier_three');
$MyMIGold_TierThreeCost                 = $MyMIGold_Value * $MyMIGold_TierThree; 
$MyMIGold_TierFour                      = $this->config->item('tier_four');
$MyMIGold_TierFourCost                  = $MyMIGold_Value * $MyMIGold_TierFour; 
$MyMIGold_TierFive                      = $this->config->item('tier_five');
$MyMIGold_TierFiveCost                  = $MyMIGold_Value * $MyMIGold_TierFive; 
?>
<div class="nk-content nk-content-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="content-page">
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h4 class="nk-block-title fw-normal"><i class="icon icon-md ni ni-spark"></i> Account / Billing</h4>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row g-gs" id="overview">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal">Overview</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">
                                                This article will introduce you to our Account & Billing Polica.<br> 
                                                This article will cover a majority of what our Trade Tracker is designed to do by default, but we provide links to more in-depth information regarding certain functionality and tools.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="accoount-information"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h3 class="nk-block-title fw-normal">Account Information</h3>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row" id="managing-account-information"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal pb-3">Managing Your Account Information</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">   
                                                For most part, you can easily edit your personal account information via your <a href="<?php echo site_url('Investor-Profile'); ?>">Investor Profile</a>. 
                                                For any additional information that may be required such as <a href="#">KYC Verification Documentation</a>, Required Company Documentation for our Partner Program will be requested on a per-account basis. 
                                                All requests for information will be provided with notification via email (<a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>) and completing within the MyMI Wallet Dashboard. 
                                                Any documentation requested from any other communication could be potential of fraud and spam. Please disregard if this were ever to be the case.                             
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="partnership-integration"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h3 class="nk-block-title fw-normal">MyMI Partnerships</h3>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <?php $this->load->view('User/Knowledgebase/includes/Partnerships/full-content'); ?>
                <?php $this->load->view('User/Knowledgebase/includes/Partnerships/full-content'); ?>
                <div class="row" id="partnership-integration"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h3 class="nk-block-title fw-normal">MyMI Referral Program</h3>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <?php $this->load->view('User/Knowledgebase/includes/Referral_Program/getting_started'); ?>
                <?php $this->load->view('User/Knowledgebase/includes/Referral_Program/more_details'); ?>
                <div class="row" id="partnership-integration"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h3 class="nk-block-title fw-normal">KYC Verification</h3>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <?php $this->load->view('User/Knowledgebase/includes/KYC_Verification/getting_started'); ?>
                <?php $this->load->view('User/Knowledgebase/includes/KYC_Verification/more_details'); ?>
                <div class="row" id="billing-and-payment"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h3 class="nk-block-title fw-normal">Billing &amp; Payment</h3>
                                        <div class="nk-block-des">
                                            <p class="lead">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row" id="introduction-to-mymi-gold"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal pb-3">May We Introduce You To MyMI Gold?</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">   
                                                In order to provide our Investors and Partnerships with a seamless way to make purchases and even sell assets on our Marketplace and Exchange, we developed an In-App Coin to process those transactions. 
                                                <a href="#<?php // echo site_url(); ?>">MyMI Gold</a> was designed to be our In-App Cryptocurrency that Investors and Partners would utilize to purchase Premium Feature Add-Ons to add to their membership packages. 
                                                We wanted to take the opportunity to allow our members to develop customizable membership packages to only access the resources they need to conduct their investment accounting & analytical studies.                                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="how-is-mymi-gold-valued"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal pb-3">How is MyMI Gold Valued?</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">   
                                                MyMI Gold was developed as our Platform's Stablecoin Comparison, so the value of MyMI Gold is determined by a 1:1 Ratio to the Dollar ($USD). 
                                                MyMI Gold is currenlty sold in packages designed to ensure all members had the ability to access the tools they require. 
                                            </p>
                                            <p class="lead fs-14px">   
                                                MyMI Gold can be purchased in the following package amounts:
                                                <dl class="row">
                                                    <dt class="col-sm-3">$<?php echo $MyMIGold_TierOneCost; ?></dt>
                                                    <dd class="col-sm-9"><?php echo $MyMIGold_TierOne; ?> MyMI Gold</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-3">$<?php echo $MyMIGold_TierTwoCost; ?></dt>
                                                    <dd class="col-sm-9"><?php echo $MyMIGold_TierTwo; ?> MyMI Gold</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-3">$<?php echo $MyMIGold_TierThreeCost; ?></dt>
                                                    <dd class="col-sm-9"><?php echo $MyMIGold_TierThree; ?> MyMI Gold</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-3">$<?php echo $MyMIGold_TierFourCost; ?></dt>
                                                    <dd class="col-sm-9"><?php echo $MyMIGold_TierFour; ?> MyMI Gold</dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-3">$<?php echo $MyMIGold_TierFiveCost; ?></dt>
                                                    <dd class="col-sm-9"><?php echo $MyMIGold_TierFive; ?> MyMI Gold</dd>
                                                </dl>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="billing-and-payment-schedule"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal pb-3">Billing &amp; Payment Schedule</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">        
                                                Premium Features are purchased on a <strong>Month-to-Month Basis</strong> (a recurring cost) and what our members are required to pay on a monthly basis is determined by the Premium Features activated on their account, 
                                                along with the Total Number of each Premium Feature(s) the member has purchased.                   
                                            </p>
                                            <p class="lead fs-14px">        
                                                Invoicing for all Premium Features is conducted on the <strong>14th of every month</strong> and automatic payments are setup to obtain funds to cover the cost of those Premium Features on the <strong>15th of every month</strong>. 
                                                The allocation of funds will first check the <strong>MyMI Gold Balance</strong> of a member's account first and retrieve the required amount of funds in MyMI Gold first. 
                                                If the user doesn't not have enough to cover the cost of their Monthly Recurring Premium Feature Costs, the member will be notified to purchase additional MyMI Gold to cover that expense.                   
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="payment-history"></div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="card">
                                    <div class="card-inner text-left">
                                        <h5 class="nk-block-title fw-normal pb-3">Payment History</h5>
                                        <div class="nk-block-des">
                                            <p class="lead fs-14px">        
                                                You can review your Payment History by visiting your <a href="<?php echo site_url('Investor-Profile'); ?>">Investor Profile</a> and selecting the <a href="<?php echo site_url('Investor-Profile'); ?>">Billing / Payment</a> tab to view and manage your billing and payment history.   
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><a href="<?php echo site_url('Knowledge-Base/Types-Of-Accounts'); ?>">View Billing &amp; Payment History</a></li>
                                                </ul>                  
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('User/Knowledgebase/includes/Assets/asset_distribution'); ?>
                <?php $this->load->view('User/Knowledgebase/includes/Customer_Support/header'); ?>
                <?php $this->load->view('User/Knowledgebase/includes/Customer_Support/contact_support'); ?>
            </div>
        </div>
    </div>
</div>