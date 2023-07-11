<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
<<<<<<< HEAD
$errorClass                 = empty($errorClass) ? ' error' : $errorClass;
$controlClass               = empty($controlClass) ? 'span6' : $controlClass;
$beta                       = $this->config->item('beta');
$trans_fee                  = $this->config->item('trans_fee');
$trans_percent              = $this->config->item('trans_percent');
$user_gas_fee               = $this->config->item('gas_fee');
$addModalTitle              = '';
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$cuID                       = $userAccount['cuID']; 
$cuEmail                    = $userAccount['cuEmail']; 
$walletID                   = $userAccount['walletID'];
$accountType                = $this->uri->segment(1);

$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type('Wallets') //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment('Add') //Token identify Action
     ->log(); //Add Database Entry
if ($accountType === 'Bank-Account') {
    $addModalTitle          = 'Manually Connect Bank Account';
    $pageView               = 'User/Wallets/Create_Bank_Account/user_fields';
    $redirectURL            = site_url('/Wallets');
    $fieldData = array(
        'errorClass'        => $errorClass,
        'controlClass'      => $controlClass,
        'redirectURL'       => $redirectURL,
        'cuID'              => $cuID,
        'cuEmail'           => $cuEmail,
        'walletID'          => $walletID,
        'beta'              => $beta,
    );
} elseif ($accountType === 'Add-Wallet') {
    $purchaseType           = $this->uri->segment(2);
    $walletType             = $this->uri->segment(3);
    $addModalTitle          = 'Add New ' . $walletType . ' Wallet';
    $pageView               = 'User/Wallets/Add/user_fields';
    $fieldData = array(
        'errorClass'        => $errorClass,
        'controlClass'      => $controlClass,
        'purchaseType'	    => $purchaseType,
        'walletType'	    => $walletType,
        'beta'              => $beta,
    );
} else {
    $purchaseType           = $this->uri->segment(2);
    $walletType             = $this->uri->segment(3);
    $addModalTitle          = 'Add New ' . $walletType . ' Wallet';
    $pageView               = 'User/Wallets/Add/user_fields';
    $fieldData = array(
        'errorClass'        => $errorClass,
        'controlClass'      => $controlClass,
        'purchaseType'	    => $purchaseType,
        'walletType'	    => $walletType,
        'beta'              => $beta,
        'user_trans_fee'    => $trans_fee,
        'trans_percent'     => $trans_percent,
        'user_gas_fee'      => $user_gas_fee,
    );
}
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
            Template::block($pageView, $pageView, $fieldData);
=======
            Template::block('User/Wallets/Add/user_fields', 'User/Wallets/Add/user_fields', $fieldData);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
