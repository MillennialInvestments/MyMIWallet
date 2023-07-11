<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
<<<<<<< HEAD
$beta                           = $this->config->item('beta');
$userAccount                    = $_SESSION['allSessionData']['userAccount'];
$cuID                           = $userAccount['cuID'];
$cuEmail                        = $userAccount['cuEmail'];
$walletID                       = $userAccount['walletID'];
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type('Bank Account') //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment('Add') //Token identify Action
     ->log(); //Add Database Entry
$fieldData = array(
    'errorClass'                => $errorClass,
    'controlClass'              => $controlClass,
    'redirectURL'			    => $this->uri->uri_string(),
    'cuID'					    => $cuID,
    'cuEmail'				    => $cuEmail,
    'walletID'				    => $walletID,
=======
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$fieldData = array(
    'errorClass'   		 	=> $errorClass,
    'controlClass' 		 	=> $controlClass,
    'redirectURL'			=> $this->uri->uri_string(),
    'cuID'					=> $userAccount['cuID'],
    'cuEmail'				=> $userAccount['cuEmail'],
    'walletID'				=> $userAccount['walletID'],
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
);
?>  
<?php echo form_open('Wallets/Connect-Bank-Account', array('class' => "form-horizontal", 'id' => "deposit-funds-form", 'autocomplete' => 'off')); ?>  
<div class="modal-header">
	<h3 class="modal-title" id="exampleModalLabel">Connect a Bank Account</h3>
	<button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
    <div class="nk-block">
        <div class="row gy-gs">
            <div class="col-lg-12 col-xl-12">
                <div class="nk-block">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-head-content">
                            <p>
                                <strong>Why do I have to connect a Bank Account?</strong> 
                            </p>
                            <p>
                            Requiring saved electronic bank connections for ACH transfers helps us keep your account secure. We are verifying that you're an owner of the bank account and that the account added meets our electronic deposit requirements.
                            </p>	 						
                        </div>
                    </div>
                </div>
                <div class="nk-block pt-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <?php
                                Template::block('User/Wallets/Create_Bank_Account/user_fields', 'User/Wallets/Create_Bank_Account/user_fields', $fieldData);
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
        </div>
    </div>	
</div>	
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
