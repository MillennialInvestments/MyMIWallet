<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// print_r($_SESSION['allSessionData']); 
$errorClass                             = empty($errorClass) ? ' error' : $errorClass;
$controlClass                           = empty($controlClass) ? 'span6' : $controlClass;
$uriSegmentA                            = $this->uri->segment(1); 
$uriSegmentB                            = $this->uri->segment(2); 
$uriSegmentC                            = $this->uri->segment(3); 
$uriSegmentD                            = $this->uri->segment(4); 
if ($uriSegmentB === 'Recurring-Account') {
    $accountID                          = $uriSegmentD;
    $configMode                         = $uriSegmentC; 
} elseif ($uriSegmentB === 'Edit') {
    $accountID                          = $uriSegmentC;
    $configMode                         = $uriSegmentB;
} elseif ($uriSegmentB === 'Copy') { 
    $accountID                          = $uriSegmentC; 
    $configMode                         = $uriSegmentB;
}
$getAccountInfo                         = $this->budget_model->get_account_information($accountID); 
foreach ($getAccountInfo->result_array() as $account) {
    $userID                             = $account['created_by']; 
    $userEmail                          = $account['created_by_email']; 
    $userName                           = $account['username'];
    $accountMonth                       = $account['month']; 
    $accountDay                         = $account['day']; 
    $accountYear                        = $account['year']; 
    $accountTime                        = $account['time']; 
    $accountName                        = $account['name']; 
    $accountNetAmount                   = $account['net_amount']; 
    $accountGrossAmount                 = $account['gross_amount']; 
    $accountSummary                     = $account['account_summary'];
    $accountRecurringAccount            = $account['recurring_account']; 
    $accountRecurringPrimary            = $account['recurring_account_primary']; 
    $accountType                        = $account['account_type']; 
    $accountSourceType                  = $account['source_type']; 
    $accountIsDebt                      = $account['is_debt']; 
    // echo $accountIsDebt;
    if ($accountIsDebt === 1) {
        $accountIsDebtText              = 'Yes';
    } elseif ($accountIsDebt === 0) {
        $accountIsDebtText              = 'No'; 
    } else {
        $accountIsDebtText              = 'No';
    }
    // echo $accountIsDebtText;  
    $accountIntervals                   = $account['intervals']; 
    $accountDesignatedDate              = $account['designated_date']; 
    $accountWeeksLeft                   = $account['initial_weeks_left'];         
}
$beta                                   = $this->config->item('beta');
$userAccount                            = $_SESSION['allSessionData']['userAccount'];
$cuID                                   = $userAccount['cuID'];
if ($accountType === 'Income') {
} elseif ($accountType === 'Expense') {
}
$accountTypeAltText                     = $accountType;
$accountTypeAltURl                      = site_url('/Budget/Add/' . $accountType);
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type('Budget - ' . $configMode) //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment($accountType) //Token identify Action
     ->log(); //Add Database Entry
$fieldData = array(
    'errorClass'                        => $errorClass,
    'controlClass'                      => $controlClass,
    'configMode'	                    => $configMode,
    'userID'                            => $userID,
    'userEmail'                         => $userEmail,
    'userName'                          => $userName,
    'accountID'                         => $accountID,
    'accountMonth'                      => $accountMonth,
    'accountDay'                        => $accountDay,
    'accountYear'                       => $accountYear,
    'accountTime'                       => $accountTime,
    'accountName'                       => $accountName,
    'accountNetAmount'                  => $accountNetAmount,
    'accountGrossAmount'                => $accountGrossAmount,
    'accountRecurringAccount'           => $accountRecurringAccount,
    'accountRecurringPrimary'           => $accountRecurringPrimary,
    'accountType'                       => $accountType,
    'accountSourceType'                 => $accountSourceType,
    'accountIsDebt'                     => $accountIsDebt,
    'accountIsDebtText'                 => $accountIsDebtText,
    'accountIntervals'                  => $accountIntervals,
    'accountDesignatedDate'             => $accountDesignatedDate,
    'accountWeeksLeft'                  => $accountWeeksLeft,
    'accountType'	                    => $accountType,
);
// print_r($fieldData); 
$addModalTitle                          = $configMode . ' ' . $accountType . ' Account';
// print_r($fieldData); 
?>
<div class="nk-block">    
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><?= $addModalTitle; ?></h3>
                <div class="nk-block-des text-soft">
                    <p>Add Your <?= $accountType; ?> Account</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="<?php echo $accountTypeAltURl; ?>" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span><?php echo $accountTypeAltText; ?></span></a></li>
                            <li><a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-danger btn-dim btn-outline-primary"><em class="icon ni ni-cross"></em><span>Cancel</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="nk-content-body">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="nk-block nk-block-lg">   
                    <div class="card card-bordered pricing px-2">
                        <div class="pricing-head">
                            <div class="pricing-title">
                                <h4 class="card-title title">Account Information</h4>
                                <p class="sub-text">Please fill out information below!</p>
                            </div>
                        </div>
                        <div class="pricing-body">                               
                            <form class="form-horizontal" id="add_user_budgeting_account">
                                <fieldset>
                                    <?php
                                    if ($uriSegmentB === 'Copy') { 
                                        Template::block('User/Budget/' . $configMode . '/user_fields', 'User/Budget/Edit/user_fields', $fieldData);
                                    } else {
                                        Template::block('User/Budget/' . $configMode . '/user_fields', 'User/Budget/' . $configMode . '/user_fields', $fieldData);
                                    }
                                    ?>
                                </fieldset>
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
                                <fieldset>
                                    <div class="pricing-action mt-0">
                                        <p class="sub-text"></p>
                                        <input class="btn btn-primary btn-sm" type="submit" name="register" id="addAccountSubmit" value="Submit" />
                                    </div>
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
            <div class="col-lg-8 col-sm-6 col-12">
                <?php $this->load->view('User/Knowledgebase/Tutorials/Categories/Budget/Add'); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
function showDiv(select){
    if(select.value=="Yes"){
        document.getElementById('recurring_fields').style.display = "block";
        // const redirectURL                   = <?php //echo '\'' . site_url('/Budget/Recurring-Account/Schedule') . '\'';?>;
    } else if (select.value=="No"){
        document.getElementById('recurring_fields').style.display = "none";
        // const redirectURL                   = <?php //echo '\'' . site_url('/Budget') . '\'';?>;
    }
    // Temporary URL Redirect while waiting Recurring Schedule Override Feature - 11012022
    const redirectURL                       = <?php echo '\'' . site_url('/Budget') . '\'';?>;
} 

const addAccountForm		                = document.querySelector("#add_user_budgeting_account");
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
        console.log(redirectURL);
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Budget/Account_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addAccountSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data                          = await result;
            const accountID                     = document.getElementById('account_id').value;
            const formMode                      = document.getElementById('form_mode').value;
            const recurringAccountPrimary       = <?php echo '"' . $accountRecurringPrimary . '"'; ?>;
            console.log(recurringAccountPrimary); 
            if (formMode == 'Add') {
                if (recurringAccountPrimary == "Yes") {
                    location.href = <?php echo '\'' . site_url('/Budget/Recurring-Account/Schedule/' . $accountID) . '\'';?>;
                } else {
                    location.href = <?php echo '\'' . site_url('/Budget') . '\'';?>;
                }
            } else if (formMode == 'Edit') {
                location.href = <?php echo '\'' . site_url('/Budget') . '\'';?>;
            } else if (formMode == 'Copy') {
                location.href = <?php echo '\'' . site_url('/Budget') . '\'';?>;
            }
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
