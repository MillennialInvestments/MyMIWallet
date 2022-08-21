<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$date = date("F jS, Y");
$hostTime = date("g:i A");
$time = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';
// Set Form Config
$formGroup				= $this->config->item('form_container');
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
?>
<?php
// Set up Validation for whether or not we accept Third-Party Accounts
?>			
<hr>
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" class="form-control" name="wallet_sum" id="wallet_sum" value="<?php echo set_value('wallet_sum', isset($user) ? $user->wallet_sum : $walletFunds); ?>">	
<input type="hidden" class="form-control" name="type" id="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Fiat'); ?>">
<input type="hidden" class="form-control" name="broker" id="broker" value="<?php echo set_value('broker', isset($user) ? $user->broker : $walletBroker); ?>">
<input type="hidden" class="form-control" name="nickname" id="nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $walletNickname); ?>">
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Name of Bank</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="bank_name" id="bank_name" placeholder="Ex: Capital One Bank" value="<?php echo set_value('bank_name', isset($user) ? $user->bank_name : ''); ?>">	
	</div>
</div>	
<div class="<?php e($formGroup); ?> <?php echo form_error('account_type') ? $errorClass : ''; ?>">
    <label class="control-label col-sm-4 col-md-12 pt-2 required" for="account_type">
		Account Type<br>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="account_type" name="account_type" value="<?php echo set_value('account_type', isset($user) ? $user->account_type : 'Checking'); ?>"> Checking
		</div>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="account_type" name="account_type" value="<?php echo set_value('account_type', isset($user) ? $user->account_type : 'Savings'); ?>"> Savings
		</div>
    </label>
</div>
<div class="<?php e($formGroup); ?> <?php echo form_error('bank_account_owner') ? $errorClass : ''; ?>">
    <label class="control-label col-sm-4 col-md-12 pt-2 required" for="bank_account_owner">
		Is your name on the account?<br>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="bank_account_owner" name="bank_account_owner" value="<?php echo set_value('bank_account_owner', isset($user) ? $user->bank_account_owner : 'Yes'); ?>"> Yes
		</div>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="bank_account_owner" name="bank_account_owner" value="<?php echo set_value('bank_account_owner', isset($user) ? $user->bank_account_owner : 'No'); ?>"> No
		</div>
    </label>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Routing Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="routing_number" id="routing_number" placeholder="Ex: 123456789" value="<?php echo set_value('routing_number', isset($user) ? $user->routing_number : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="account_number" id="account_number" placeholder="Ex: 012345678910" value="<?php echo set_value('account_number', isset($user) ? $user->account_number : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Re-enter Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="verify_account" id="verify_account" value="<?php echo set_value('verify_account', isset($user) ? $user->verify_account : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Create Nickname for Account</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="nickname" id="nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> pt-3">
	<div class="col-md-4"></div>
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="col-6 px-1">                   
				<button type="button" class="btn btn-secondary btn-block" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
			</div>
			<div class="col-6 px-1">                   
				<input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Submit" />
			</div>
		</div>
	</div>
</div>
<hr>
<!--
<p style="font-size:0.65rem;">
By proceeding, you acknowledge and agree that your transaction is governed by the Terms of Service, the Terms of Service Addendum for Card Payments and the Privacy Policy. All transactions are final.	
</p>
<p style="font-size:0.65rem;">
Your card-issuing bank may charge a foreign transaction fee or another type of fee. Any fees charged by your bank are separate from and in addition to the card processing fee charged by Bittrex. By proceeding, you also acknowledge that you are solely responsible for paying any fees charged by your bank.
</p>
-->

