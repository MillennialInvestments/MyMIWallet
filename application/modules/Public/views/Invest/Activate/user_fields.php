<?php
$pageURIA 	 		= $this->uri->segment(1);
$pageURIB 	 		= $this->uri->segment(2);
$pageURIC 	 		= $this->uri->segment(3);
$pageURID 	 		= $this->uri->segment(4);
$pageURIE 	 		= $this->uri->segment(5);
$currentMethod 		= $this->router->method;
$errorClass     	= empty($errorClass) ? ' error' : $errorClass;
$registerClass  	= $currentMethod == 'register' ? ' required' : '';
$editSettings   	= $currentMethod == 'edit';
$cuID	 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
// Input Field Settings
$controlGroup 		= 'control-group form-row pb-3';
$controlLabel 		= 'control-label col-sm-4 col-md-2 col-lg-2 pt-2';
$controlClass 		= 'controls col-sm-8 col-md-8 col-lg-8 pl-3';
$controlInput   	= 'form-control full-width';
?>    

<input class="<?php e($controlInput); ?>" type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" /> 
<div class="<?php e($controlGroup); ?> <?php echo form_error('wallet_id') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">
    </label>
    <div class="<?php e($controlClass); ?>">
		<input class="btn btn-primary" type="submit" name="register" id="submit" value="Activate" />
    </div>
</div>


