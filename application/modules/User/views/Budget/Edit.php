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
<div class="modal-header">
	<h3 class="modal-title" id="useCoinModalLabel"><?= $addModalTitle; ?></h3>
	<a href="<?php echo $this->agent->referrer(); ?>" class="close">
	  <span aria-hidden="true">&times;</span>
	</a>
</div> 
<div class="modal-body">
	<form class="form-horizontal" id="add_user_budgeting_account">
		<fieldset>
			<?php
                Template::block('User/Budget/' . $configMode . '/user_fields', 'User/Budget/' . $configMode . '/user_fields', $fieldData);
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
			<div class="control-group">
				<div class="controls ml-3">
					<input class="btn btn-primary" type="submit" name="register" id="addAccountSubmit" value="Submit" />
				</div>
			</div>
		</fieldset>
	<?php echo form_close(); ?>	
	<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
	<?php endif; ?>
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
            }
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
