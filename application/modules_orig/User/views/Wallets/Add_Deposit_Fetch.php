<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                 = empty($errorClass) ? ' error' : $errorClass;
$controlClass               = empty($controlClass) ? 'span6' : $controlClass;
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$fieldData = array(
    'errorClass'            => $errorClass,
    'controlClass'          => $controlClass,
    'userAccount'           => $userAccount,
);
?>
<?php //echo form_open('User/Wallets/Add_Deposit', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off'));?>
<form class="form-horizontal" id="track_wallet_deposit">
<div class="modal-header">
	<h3 class="modal-title" id="exampleModalLabel">Track Deposited Funds</h3>
	<button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="nk-block pt-1">
		<div class="row">
			<div class="col-lg-12">
				<fieldset>
					<?php
                    Template::block('User/Wallets/Add_Deposit/user_fields', 'User/Wallets/Add_Deposit/user_fields', $fieldData);
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
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
<script type="text/javascript">
const trackDepositForm		= document.querySelector("#track_wallet_deposit");
const trackDepositSubmit	= {};
if (trackDepositForm) {
    trackDepositForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		trackDepositForm.querySelectorAll(".form-control").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            trackDepositSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(trackDepositSubmit);
        console.log(JSON.stringify(trackDepositSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Transaction'); ?>", {
			
			method: "POST",
			body: JSON.stringify(trackDepositSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
		   $('#transactionModal').modal('toggle')
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
