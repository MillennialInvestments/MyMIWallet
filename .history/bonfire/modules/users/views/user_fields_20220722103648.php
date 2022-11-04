<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$currentMethod 			= $this->router->method;
$errorClass     		= empty($errorClass) ? ' error' : $errorClass;
$registerClass  		= $currentMethod == 'register' ? ' required' : '';
$editSettings   		= $currentMethod == 'edit';
// Input Field Settings
$controlGroup 			= 'control-group form-row pb-3';
$controlLabel 			= 'control-label col-12 pt-2 required';
$controlClass 			= 'controls col-12';
$controlInput   		= 'form-control full-width';
$isBeta					= $this->config->item('beta');
$signup_date 			= date("n/j/Y");
$registerType 			= $this->uri->segment(1);
$preRegisterType 		= $this->uri->segment(2);
$getLastID 				= $this->user_model->get_last_id();
foreach ($getLastID->result_array() as $last) {
    $lastID				= $last['id'] + 1;
}
if ($isBeta === 1) {
    ?>                                                                                                                  
	<input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />
	<input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Beta'); ?>" />
	<input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '0'); ?>" />			
	<input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
	<input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
<?php
} elseif ($registerType === 'Partner') {
        ?>
	<input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />
	<input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />
	<input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '1'); ?>" />
	<input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
	<div class="<?php e($controlGroup); ?> <?php echo form_error('organization') ? $errorClass : ''; ?>">
		<label class="<?php e($controlLabel); ?>" for="organization">Name of Organization</label>
		<div class="<?php e($controlClass); ?>">
			<input class="<?php echo $controlInput; ?>" type="text" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : ''); ?>" />
			<span class="help-inline"><?php echo form_error('organization'); ?></span>
		</div>
	</div>
<?php
    } elseif ($registerType === 'Investor') {
        ?>                                          		
    <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />		
	<input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />				
	<input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '0'); ?>" />																						
	<input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '1'); ?>" />
	<input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
<?php
    } else {
        ?>
	<input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />		
	<input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />
	<input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '0'); ?>" />			
	<input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
	<input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
<?php
    }
?>
<style>
	.form-control {min-height: 40px !important; margin-top: 0px !important; background-color: #ededed !important;}
</style>
<input type="hidden" id="signup_date" name="signup_date" value="<?php echo set_value('signup_date', isset($user) ? $user->signup_date : $signup_date); ?>" />
<div class="<?php e($controlGroup); ?> <?php echo form_error('account_type') ? $errorClass : ''; ?>">
    <label class="control-label col-sm-4 col-md-12 pt-2 required" for="email">
		Account Type<br>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="account_type_personal" name="account_type" value="<?php echo set_value('account_type', isset($user) ? $user->account_type : 'Personal'); ?>"> Personal Account <small>- an Individual Account</small>
		</div>
		<div class="form-radio">
			<input class="mt-2" type="radio" id="account_type_business" name="account_type" value="<?php echo set_value('account_type', isset($user) ? $user->account_type : 'Business'); ?>"> Business Account <small>- a Business or Partner Account</small>
		</div>
    </label>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('email') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="email"><?php echo lang('bf_email'); ?> Address</label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
        <span class="help-inline"><?php echo form_error('email'); ?></span>
    </div>
</div>
<?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')) : ?>
<div class="<?php e($controlGroup); ?><?php echo form_error('username') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="username"><?php echo lang('bf_username'); ?></label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="username" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : ''); ?>" />
        <span class="help-inline"><?php echo form_error('username'); ?></span>
    </div>
</div>
<?php endif; ?>
<div class="<?php e($controlGroup); ?> <?php echo form_error('password') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> <?php echo $registerClass; ?>" for="password"><?php echo lang('bf_password'); ?></label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="password" id="password" name="password" value="" />
        <span class="help-inline"><?php echo form_error('password'); ?></span>
        
    </div>
</div>
<div class="<?php e($controlGroup); ?>">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<p class="help-block"><?php echo isset($password_hints) ? $password_hints : ''; ?></p>
	</div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> <?php echo $registerClass; ?>" for="pass_confirm">Password <small>(Confirm)</small></label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="password" id="pass_confirm" name="pass_confirm" value="" />
    </div>
</div>
<?php if ($editSettings) : ?>
<div class="<?php e($controlGroup); ?> <?php echo form_error('force_password_reset') ? $errorClass : ''; ?>">
    <div class="controls col-sm-9">
        <label class="checkbox" for="force_password_reset">
            <input type="checkbox" id="force_password_reset" name="force_password_reset" value="1" <?php echo set_checkbox('force_password_reset', empty($user->force_password_reset)); ?> />
            <?php echo lang('us_force_password_reset'); ?>
        </label>
    </div>
</div>
<?php
endif;
?>
<div class="<?php e($controlGroup); ?> <?php echo form_error('referral_code') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="referral_code">Referral Code <small>(Optional)</small></label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="referral_code" name="referral_code" value="<?php echo set_value('referral_code', isset($user) ? $user->referral_code : ''); ?>" />
        <span class="help-inline"><?php echo form_error('referral_code'); ?></span>
    </div>
</div>
<small class="text-muted">
We are committed to complying with all U.S. regulations that help prevent, detect and remediate unlawful behavior by customers and virtual currency developers when using the Millennial Investment's MyMI Wallet trading platform or any of the company’s other services. 
MyMI Wallet is also not a regulated exchange under U.S. securities laws. 
By registering an account, you are agreeing our <a href="">Terms &</a>
</small>
