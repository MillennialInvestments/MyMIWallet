
<div class="<?php e($controlGroup); ?> <?php echo form_error('email') ? $errorClass : ''; ?>">
	<label class="<?php e($controlLabel); ?> " for="email">Email</label>
	<div class="<?php e($controlClass); ?> ">
		<input class="<?php e($controlInput); ?>" type="tel" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
		<span class="help-inline"><?php echo form_error('email'); ?></span>
	</div>
</div>