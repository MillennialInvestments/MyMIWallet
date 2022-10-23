<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// print_r($_SESSION['allSessionData']); 
$errorClass                             = empty($errorClass) ? ' error' : $errorClass;
$controlClass                           = empty($controlClass) ? 'span6' : $controlClass;
$configMode                             = $this->uri->segment(2);
if ($configMode === 'Add') {
    $accountType                        = $this->uri->segment(3);
    $fieldData = array(
        'errorClass'                    => $errorClass,
        'controlClass'                  => $controlClass,
        'configMode'	                => $configMode,
        'userID'                        => '',
        'userEmail'                     => '',
        'userName'                      => '',
        'accountMonth'                  => '',
        'accountDay'                    => '',
        'accountYear'                   => '',
        'accountTime'                   => '',
        'accountName'                   => '',
        'accountNetAmount'              => '',
        'accountGrossAmount'            => '',
        'accountRecurringAccount'       => '',
        'accountType'                   => $accountType,
        'accountSourceType'             => '',
        'accountIntervals'              => '',
        'accountDesignatedDate'         => '',
        'accountWeeksLeft'              => '',
    );
} elseif ($configMode   === 'Edit') {
    $accountID                          = $this->uri->segment(3);
    $getAccountInfo                     = $this->budget_model->get_account_information($accountID); 
    foreach ($getAccountInfo->result_array() as $account) {
        $userID                         = $account['created_by']; 
        $userEmail                      = $account['created_by_email']; 
        $userName                       = $account['username'];
        $accountMonth                   = $account['month']; 
        $accountDay                     = $account['day']; 
        $accountYear                    = $account['year']; 
        $accountTime                    = $account['time']; 
        $accountName                    = $account['name']; 
        $accountNetAmount               = $account['net_amount']; 
        $accountGrossAmount             = $account['gross_amount']; 
        $accountRecurringAccount        = $account['recurring_account']; 
        $accountType                    = $account['account_type']; 
        $accountSourceType              = $account['source_type']; 
        $accountIntervals               = $account['intervals']; 
        $accountDesignatedDate          = $account['designated_date']; 
        $accountWeeksLeft               = $account['initial_weeks_left'];         
    }
    $fieldData = array(
        'errorClass'                    => $errorClass,
        'controlClass'                  => $controlClass,
        'configMode'	                => $configMode,
        'userID'                        => $userID,
        'userEmail'                     => $userEmail,
        'userName'                      => $userName,
        'accountMonth'                  => $accountMonth,
        'accountDay'                    => $accountDay,
        'accountYear'                   => $accountYear,
        'accountTime'                   => $accountTime,
        'accountName'                   => $accountName,
        'accountNetAmount'              => $accountNetAmount,
        'accountGrossAmount'            => $accountGrossAmount,
        'accountRecurringAccount'       => $accountRecurringAccount,
        'accountType'                   => $accountType,
        'accountSourceType'             => $accountSourceType,
        'accountIntervals'              => $accountIntervals,
        'accountDesignatedDate'         => $accountDesignatedDate,
        'accountWeeksLeft'              => $accountWeeksLeft,
        'accountType'	                => $accountType,
    );
}
// print_r($fieldData); 
$addModalTitle                          = $configMode . ' ' . $accountType . ' Account';
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
            Template::block('User/Budget/Add/user_fields', 'User/Budget/Add/user_fields', $fieldData);
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
        const redirectURL                   = <?php echo '\'' . site_url('/Budget/Recurring-Account/Schedule') . '\'';?>;
    } else{
        document.getElementById('recurring_fields').style.display = "none";
        const redirectURL                   = <?php echo '\'' . site_url('/Budget') . '\'';?>;
    }
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
            const result = await fetch("<?= site_url('User/Budget/Account_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addAccountSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
            const recurringAccount   = document.getElementById('recurring_account').value;
            console.log(recurringAccount); 
            if (recurringAccount == "Yes") {
		        location.href = <?php echo '\'' . site_url('/Budget/Recurring-Account/Schedule') . '\'';?>;
            } else {
		        location.href = <?php echo '\'' . site_url('/Budget/' . $accountType) . '\'';?>;
            }
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
