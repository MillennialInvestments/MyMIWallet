<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$fieldData = array(
    'errorClass'   		 	=> $errorClass,
    'controlClass' 		 	=> $controlClass,
    'redirectURL'			=> $this->uri->uri_string(),
    'cuID'					=> $userAccount['cuID'],
    'cuEmail'				=> $userAccount['cuEmail'],
    'walletID'				=> $userAccount['walletID'],
);
?>  
<?php echo form_open('Wallets/Connect-Bank-Account', array('class' => "form-horizontal", 'id' => "deposit-funds-form", 'autocomplete' => 'off')); ?>  
<?php 
if ($this->uri->string(3) === 'Modal') {
?>
<div class="modal fade" id="createBankAccountModal" tabindex="-1" aria-labelledby="createBankAccountModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Connect a Bank Account</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
		</div>
	</div>
</div>	
<?php     
} else {
?>

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
<?php 
}
?>
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
