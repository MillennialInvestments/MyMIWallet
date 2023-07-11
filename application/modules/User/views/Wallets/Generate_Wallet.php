<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
<<<<<<< HEAD
$errorClass             = empty($errorClass) ? ' error' : $errorClass;
$controlClass           = empty($controlClass) ? 'span6' : $controlClass;
$fieldData              = array(
    'errorClass'        => $errorClass,
    'controlClass'      => $controlClass,
);
$userAccount            = $_SESSION['allSessionData']['userAccount'];
$cuID                   = $userAccount['cuID'];
$beta                   = $this->config->item('beta');
// $this->mymilogger
//      ->user($cuID) //Set UserID, who created this  Action
//      ->beta($beta) //Set whether in Beta or nto
//      ->type('Wallets') //Entry type like, Post, Page, Entry
//      ->controller($this->router->fetch_class())
//      ->method($this->router->fetch_method())
//      ->url($this->uri->uri_string())
//      ->full_url(current_url())
//      ->comment('Generate Address') //Token identify Action
//      ->log(); //Add Database Entry
=======
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
?>
<form class="form-horizontal" id="generate_digibyte_wallet_address">
<div class="modal-header">
	<h3 class="modal-title" id="exampleModalLabel">Create Your MyMI Wallet Address</h3>
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
                    Template::block('Generate_Wallet/user_fields', 'Generate_Wallet/user_fields', $fieldData);
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
<script src="<?php echo base_url('assets/js/BitcoinJS-lib/bitcoinjs.min.js'); ?>"></script>								
<script type="text/javascript">
const generateWalletAddress		= document.querySelector("#generate_digibyte_wallet_address");
const generateWalletAddressSubmit	= {};
if (generateWalletAddress) {
    generateWalletAddress.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		generateWalletAddress.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            generateWalletAddressSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(generateWalletAddressSubmit);
        console.log(JSON.stringify(generateWalletAddressSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Generator'); ?>", {
			
			method: "POST",
			body: JSON.stringify(generateWalletAddressSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
		   $("#transactionModal").hide();
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
