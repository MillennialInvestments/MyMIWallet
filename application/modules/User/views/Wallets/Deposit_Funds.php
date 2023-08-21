<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   				= empty($errorClass) ? ' error' : $errorClass;
$controlClass 				= empty($controlClass) ? 'span6' : $controlClass;
$redirectURL                = 'Exchange';
$fieldData = array(
    'errorClass'    		=> $errorClass,
    'controlClass'  		=> $controlClass,
    'redirectURL'			=> $redirectURL,
    'cuID'					=> $_SESSION['allSessionData']['userAccount']['cuID'],
    'cuEmail'				=> $_SESSION['allSessionData']['userAccount']['cuEmail'],
    'walletID'				=> $_SESSION['allSessionData']['userAccount']['walletID'],
    'walletAmount'			=> $_SESSION['allSessionData']['userAccount']['walletAmount'],
    'walletInitialAmount'	=> $_SESSION['allSessionData']['userAccount']['walletInitialAmount'],
    'depositAmount'			=> $_SESSION['allSessionData']['userAccount']['depositAmount'],
    'withdrawAmount'		=> $_SESSION['allSessionData']['userAccount']['withdrawAmount'],
    'walletBroker'			=> $_SESSION['allSessionData']['userAccount']['walletBroker'],
    'walletNickname'		=> $_SESSION['allSessionData']['userAccount']['walletNickname'],
);
?>  
<?php echo form_open('Deposit-Funds', array('class' => "form-horizontal", 'id' => "deposit-funds-form", 'autocomplete' => 'off')); ?>  
<div class="modal-header">
	<h3 class="modal-title" id="exampleModalLabel">Deposit Funds (USD)</h3>
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
								<strong>Important debit card information</strong> 
							</p>
							<ul style="list-style:circle; font-size:0.75rem">
								<li>Your card-issuing bank may charge a foreign transaction fee or another type of fee.</li>
								<li>You can trade immediately after your deposit has been verified.</li>
								<li>Learn more about funding your account with debit cards.</li>
							</ul>	 						
						</div>
					</div>
				</div>
				<div class="nk-block pt-1">
					<div class="row">
						<div class="col-lg-12">
							<fieldset>
								<?php
                                Template::block('User/Wallets/Deposit_Funds/user_fields', 'User/Wallets/Deposit_Funds/user_fields', $fieldData);
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
