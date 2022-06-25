<?php
$cuID					 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				 					= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuWalletID				 					= isset($current_user->wallet_id) && ! empty($current_user->wallet_id) ? $current_user->wallet_id : '';
$cuType					 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
if ($cuType === 'Beta') {
    $cuBeta									= 'Yes';
} else {
    $cuBeta									= 'No';
}
$pageURIA 	 								= $this->uri->segment(1);
$pageURIB 	 								= $this->uri->segment(2);
$pageURIC 	 								= $this->uri->segment(3);
$pageURID 	 								= $this->uri->segment(4);
$pageURIE 	 								= $this->uri->segment(5);
$currentMethod 								= $this->router->method;
$errorClass     							= empty($errorClass) ? ' error' : $errorClass;
$registerClass  							= $currentMethod == 'register' ? ' required' : '';
$editSettings   							= $currentMethod == 'edit';
$defaultLanguage							= isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone 							= isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
// Input Field Settings
$controlGroup 								= 'control-group form-row pb-3';
$controlLabel 								= 'control-label col-sm-4 col-md-4 col-lg-4 pt-2';
$controlClass 								= 'controls col-sm-8 col-md-8 col-lg-8 pl-3';
$controlInput   							= 'form-control full-width';
?>  
<div class="<?php e($controlGroup); ?> <?php echo form_error('total') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Click Here To Generate New Wallet Address:</label>
    <div class="<?php e($controlClass); ?> text-center pt-2">
		<a class="btn btn-primary btn-sm text-white" onclick="createWalletAddressDGB()">Generate</a>
    </div>
</div>                                                  
<input class="<?php e($controlInput); ?>" type="hidden" id="redirectURL" name="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $this->uri->uri_string()); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : $cuBeta); ?>" /> 
<div class="<?php e($controlGroup); ?> <?php echo form_error('private_key') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="private_key">
		Private Key	
	</label>
    <div class="<?php e($controlClass); ?>">
		<input class="<?php e($controlInput); ?>" type="text" id="private_key" name="private_key" value="<?php echo set_value('private_key', isset($user) ? $user->private_key : ''); ?>" />
		<p class="help-text">Store Your Private Key somewhere safe and secure.</p>
    </div>
</div>  
<div class="<?php e($controlGroup); ?> <?php echo form_error('public_key') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="public_key">Public Key</label>
    <div class="<?php e($controlClass); ?>">
		<input class="<?php e($controlInput); ?>" type="text" id="public_key" name="public_key" value="<?php echo set_value('public_key', isset($user) ? $user->public_key : ''); ?>" />
    </div>
</div>
<div class="control-group" style="border:none;">
	<div class="controls ml-3">
		<input class="btn btn-primary" type="submit" name="register" id="generateWalletAddressSubmit" value="Save" />
	</div>
</div>

