<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$purchaseType       = $this->uri->segment(2);
$walletType         = $this->uri->segment(3);
$addModalTitle      = 'Manually Add ' . $walletType . ' Wallet';
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'purchaseType'	=> $purchaseType,
    'walletType'	=> $walletType,
);
?>
<div class="modal-header">
	<h3 class="modal-title" id="useCoinModalLabel"><?= $addModalTitle; ?></h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div> 
<div class="modal-body">
	<form class="form-horizontal" id="add_user_wallet">
		<fieldset>
			<?php
            Template::block('User/Wallets/Add/user_fields', 'User/Wallets/Add/user_fields', $fieldData);
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
					<input class="btn btn-primary" type="submit" name="register" id="addWalletSubmit" value="Submit" />
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
const addWalletForm		    = document.querySelector("#add_user_wallet");
const addWalletSubmit	    = {};
if (addWalletForm) { 
    addWalletForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		addWalletForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addWalletSubmit[inputField.name] = inputField.value;
        });  
        addWalletForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addWalletSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(addWalletSubmit);
        // console.log(JSON.stringify(addWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Wallets/Link-Account/Confirm') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
