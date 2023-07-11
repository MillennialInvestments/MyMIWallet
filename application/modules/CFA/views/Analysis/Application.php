<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
date_default_timezone_set('America/Chicago');
$date                                       = date("F jS, Y");
$hostTime                                   = date("g:i A");
$time                                       = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod                              = $this->router->fetch_method();
// print_r($_SESSION['allSessionData']); 
$meta_fields	                            = Template::get('meta_fields');
$redirectURL                                = $this->agent->referrer(); 
$errorClass  		                        = empty($errorClass) ? ' error' : $errorClass;
$controlGroup                               = 'control-group form-row pb-3';
$controlLabel                               = 'control-label col-sm-12 col-md-4 pt-2 mb-0';
$controlClass                               = 'controls col-sm-12 col-md-8';
$controlInput                               = 'form-control full-width';
$beta                                       = $this->config->item('beta');
$appType                                    = $this->uri->segment(2);
$cfaReferralCode                            = $this->uri->segment(4);
if (!empty($_SESSION['user_id'])) {
    $cuID                                   = $_SESSION['user_id'];
} else {
    $cuID                                   = $this->input->ip_address();
}
if ($appType === 'Advisor') {
    // print_r($_SESSION); 
    $pageTitle                              = 'CFA Advisor Analysis';
    $pageSubtitle                           = 'Become a Registered Certified Financial Advisor & Planner at MyMI Wallet to access our community of members that you could serve today in building a better tomorrow.';
    $pageOverviewTitle                      = 'CFA Application';
    $applicationType                        = 'Advisor Application';
    if (!empty($cfaReferralCode)) {
        $logComment                         = $cuID . ' has submitted a CFA Partner Application that was referred by ' . $cfa_name . ' at ' . $cfa_company;
    } else {
        $logComment                         = $cuID . ' has submitted a CFA Partner Application and needs to be referred to an Advisor.';
    }
    $fieldData 			                    = array(
        'appType'                           => $appType,
        'date'                              => $date,
        'hostTime'                          => $hostTime,
        'time'                              => $time,
        'beta'                              => $beta,
        'currentMethod'                     => $currentMethod,
        'controlGroup'                      => $controlGroup,
        'controlClass'                      => $controlClass,
        'controlInput'                      => $controlInput,
        'controlLabel'                      => $controlLabel,
        'errorClass'                        => $errorClass,
        'cfaReferralCode'                   => $cfaReferralCode,
        'redirectURL'                       => $redirectURL,
        'frontend_only'                     => true,
    );
} elseif ($appType === 'Client') {
    // print_r($_SESSION); 
    $pageTitle                              = 'CFA Client Analysis';
    $pageSubtitle                           = 'Comprehensive Client Assessment: A CFA\'s Guide to Understanding and Addressing the Unique Financial Needs of Each Client';
    $pageOverviewTitle                      = 'CFA Application';
    // $getCFAInfo                             = $this->advisor_model->get_cfa_advisor_info($cfaReferralCode); 
    $cfa_id                                 = '';
    $cfa_name                               = '';
    $cfa_company                            = '';
    $applicationType                        = 'Client Application';
    if (!empty($cfaReferralCode)) {
        $logComment                         = $cuID . ' has submitted a CFA Analysis Application with ' . $cfa_name . ' at ' . $cfa_company;
    } else {
        $logComment                         = $cuID . ' has submitted a CFA Analysis Application and needs to be referred to an Advisor.';
    }
    $fieldData 			                    = array(
        'appType'                           => $appType,
        'date'                              => $date,
        'hostTime'                          => $hostTime,
        'time'                              => $time,
        'beta'                              => $beta,
        'currentMethod'                     => $currentMethod,
        'controlGroup'                      => $controlGroup,
        'controlClass'                      => $controlClass,
        'controlInput'                      => $controlInput,
        'controlLabel'                      => $controlLabel,
        'errorClass'                        => $errorClass,
        'cfaReferralCode'                   => $cfaReferralCode,
        'cfa_id'                            => $cfa_id,
        'redirectURL'                       => $redirectURL,
        'frontend_only'                     => true,
    );
}
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type($applicationType) //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment($logComment) //Token identify Action
     ->log(); //Add Database Entry
// print_r($fieldData); 
?>
<div class="intro-banner pb-3 bg-dark">
    <div class="container pt-3">
        <div class="row justify-content-center pt-1">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc py-md-2 py-lg-5">
                            <div class="row">
                                <span class="overline-title">Introducing</span>
                                <h1 class="title text-white"><?php echo $pageTitle; ?></h1>
                                <h2 class="subttitle text-white pb-3">Submit Your Application</h2>
                                <!-- <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1> -->
                                <p class="text-light">
                                    <?php echo $pageSubtitle; ?>
                                </p>
                                <ul class="intro-action-group">
                                    <li><a href="#" class="link-to btn btn-lg btn-light">Get Started!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-none d-lg-block col-lg-6 col-xl-6 pl-5">
                <div class="intro-banner-wrap pt-lg-5">
                    <div class="intro-banner-inner">
                        <div class="intro-banner-desc pt-0">
                            <img class="img-fluid rounded" src="<?php echo base_url('assets/images/How_It_Works/Personal_Budgeting.jpg'); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-overview text-center bg-white pt-5">
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-xl-10">
                <div class="card card-bordered py-5 px-3">
                    <div class="card-body">
                        <div class="intro-section-title">
                            <span class="overline-title intro-section-subtitle"><?php echo $pageOverviewTitle; ?></span>
                            <div class="intro-section-desc">                            
                                <form class="form-horizontal" id="cfa_customer_analysis">
                                    <?php
                                    if ($appType === 'Advisor') {
                                        echo '
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-12 col-md-6 pr-5 border-right">
                                                    <h3 class="intro-subheading-lead pb-3">Personal Information</h3>
                                                ';
                                                    Template::block('CFA/Analysis/Application/personal_information', 'CFA/Analysis/Application/personal_information', $fieldData);
                                                echo '
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <h3 class="intro-subheading-lead pb-3">Employment Information</h3>
                                                    ';
                                                    Template::block('CFA/Analysis/Application/Advisors/employment_information', 'CFA/Analysis/Application/Advisors/employment_information', $fieldData);
                                                echo '
                                                    <div class="pricing-action mt-0">
                                                        <p class="sub-text"></p>
                                                        <input class="btn btn-primary" type="submit" name="register" id="analysisSubmit" value="Submit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        ';
                                    } elseif ($appType === 'Client') {
                                        echo '
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-12 col-md-6 border-lg-right">
                                                    <h3 class="intro-subheading-lead pb-3">Personal Information</h3>
                                                    ';
                                                    Template::block('CFA/Analysis/Application/personal_information', 'CFA/Analysis/Application/personal_information', $fieldData);
                                                echo '
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <h3 class="intro-subheading-lead pb-3">Employment Information</h3>
                                                    ';
                                                    Template::block('CFA/Analysis/Application/Clients/employment_information', 'CFA/Analysis/Application/Clients/employment_information', $fieldData);
                                                echo '
                                                    <div class="pricing-action mt-0">
                                                        <p class="sub-text"></p>
                                                        <input class="btn btn-primary" type="submit" name="register" id="analysisSubmit" value="Submit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        ';
                                    }
                                    ?>
                                    <fieldset>
                                        <?php
                                        // Allow modules to render custom fields. No payload is passed
                                        // since the user has not been created, yet.
                                        Events::trigger('render_user_form');
                                        ?>
                                        <!-- Start of User Meta -->
                                        <?php //$this->load->view('users/user_meta', array('frontend_only' => true));?>
                                        <!-- End of User Meta -->
                                    </fieldset>
                                <?php echo form_close(); ?>	
                                <?php if (validation_errors()) : ?>
                                <div class="alert alert-error fade in">
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
function showDiv(select){
    if(select.value=="Yes"){
        document.getElementById('recurring_fields').style.display = "block";
        const redirectURL                   = <?php echo '\'' . site_url('/Budget/Recurring-Account/Schedule') . '\'';?>;
    } else if (select.value=="No"){
        document.getElementById('recurring_fields').style.display = "none";
        const redirectURL                   = <?php echo '\'' . site_url('/Budget') . '\'';?>;
    }
} 

const addAccountForm		                = document.querySelector("#cfa_customer_analysis");
const addAccountSubmit	                    = {};
if (addAccountForm) { 
    addAccountForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		addAccountForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addAccountSubmit[inputField.name] = inputField.value;
        });  
        addAccountForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addAccountSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(addAccountSubmit);
        // console.log(JSON.stringify(addAccountSubmit));
        console.log(redirectURL);
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('CFA/Analysis/Application/Account_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addAccountSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data                  = await result;
            const accountID             = document.getElementById('account_id').value;
            const recurringAccount      = document.getElementById('recurring_account').value;
            console.log(recurringAccount); 
            location.href = <?php echo '\'' . $redirectURL . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
<?php $this->load->view('CFA/Analysis/Application/country_state_js'); ?>
