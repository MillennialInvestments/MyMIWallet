<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$beta                           = $this->config->item('beta'); 
$errorClass                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                   = empty($controlClass) ? 'span6' : $controlClass;
$featureType                    = $this->uri->segment(1); 
$walletType			            = $this->uri->segment(2);
$cuUserType                     = $_SESSION['allSessionData']['userAccount']['cuUserType'];
$cuID           		        = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRealizeID    		        = $_SESSION['allSessionData']['userAccount']['cuRealizeID'];
if ($featureType === 'Purchase-Wallet') {
    $featureTypeText            = 'Wallets - Purchase';
    if ($walletType === 'Fiat') {
        $featureRedirectURL     = 'Wallets/Link-Account/Brokerage/Fiat';
    } elseif ($walletType === 'Digital') {
        $featureRedirectURL     = 'Wallets/Link-Account/Brokerage/Digital';
    }
} else {
    
}

$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type($featureTypeText) //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment($walletType) //Token identify Action
     ->log(); //Add Database Entry
$fieldData = array(
    'errorClass'                => $errorClass,
    'controlClass'              => $controlClass,
    'featureType'	            => $featureType,
    'walletType'	            => $walletType,
    'redirect_url'              => $featureRedirectURL,
);
?>
<!-- User/views/Wallets/Purchase Form -->
<div class="modal-body">
<form class="form-horizontal" id="purchase_order_form">
	<fieldset>
		<?php
        Template::block('User/Wallets/Purchase/user_fields', 'User/Wallets/Purchase/user_fields', $fieldData);
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
		<div class="modal-footer">
			<input class="btn btn-primary" type="submit" name="purchaseWalletSubmit" id="purchaseWalletSubmit" value="Purchase" />
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
const purchaseWalletForm		= document.querySelector("#purchase_order_form");
const purchaseWalletSubmit		= {};
if (purchaseWalletForm) {
    purchaseWalletForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		purchaseWalletForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            purchaseWalletSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(purchaseWalletSubmit);
        console.log(JSON.stringify(purchaseWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Feature_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(purchaseWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           	const data = await result;
		    location.href = <?php echo '\'' . $featureRedirectURL . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
