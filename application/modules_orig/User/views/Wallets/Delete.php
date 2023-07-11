<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                 = empty($errorClass) ? ' error' : $errorClass;
$controlClass               = empty($controlClass) ? 'span6' : $controlClass;
$beta                       = $this->config->item('beta');
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$cuID                       = $userAccount['cuID']; 
$cuEmail                    = $userAccount['cuEmail']; 
$pageURIA                   = $this->uri->segment(1);
$pageURIB                   = $this->uri->segment(2);
$pageURIC                   = $this->uri->segment(3);
$pageURID                   = $this->uri->segment(4);
$pageURIE                   = $this->uri->segment(5);
$accountType                = $pageURIA;
$walletID                   = $pageURIC;

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
    );
} elseif ($pageURIB === 'Delete') {
    $walletID               = $pageURIC;
    $addModalTitle          = 'Delete This Wallet?';
    $pageView               = 'User/Wallets/Delete/user_fields';
    $fieldData              = array(
        'errorClass'        => $errorClass,
        'controlClass'      => $controlClass,
        'walletID'          => $walletID,
    );
}
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
            Template::block($pageView, $pageView, $fieldData);
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
			<!-- <div class="control-group">
				<div class="controls ml-3">
					<input class="btn btn-primary" type="submit" name="register" id="deleteWalletSubmit" value="Submit" />
				</div>
			</div> -->
		</fieldset>
	<?php echo form_close(); ?>	
	<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
	<?php endif; ?>
</div>
<script type="text/javascript"> 
const deleteThisWallet		    = document.querySelector("#add_user_wallet");
const deleteWalletSubmit	    = {};
if (deleteThisWallet) { 
    deleteThisWallet.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		deleteThisWallet.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            deleteWalletSubmit[inputField.name] = inputField.value;
        });  
        deleteThisWallet.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            deleteWalletSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(deleteWalletSubmit);
        // console.log(JSON.stringify(deleteWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(deleteWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Wallets') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
