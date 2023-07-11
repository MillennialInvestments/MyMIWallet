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
<form class="form-horizontal" id="cfa_customer_analysis">
    <?php
        echo '
        <fieldset>
            <h3 class="intro-subheading-lead pb-3">Personal Information</h3>
            ';
            Template::block('Marketing/Blog/Subscribe/user_fields', 'Marketing/Blog/Subscribe/user_fields', $fieldData);
        echo '
        </fieldset>
        ';
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
<script type="text/javascript"> 
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
