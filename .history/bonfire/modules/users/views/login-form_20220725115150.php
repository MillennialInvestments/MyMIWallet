<h1 class="mbr-section-title mbr-bold pt-3 mb-3 pb-3 mbr-fonts-style card-title align-center display-5">LOGIN</h1>

<?php echo Template::message(); ?>

<?php
    if (validation_errors()) :
?>
<div class="row-fluid">
	<div class="span12">
		<div class="alert alert-error fade in">
		  <a data-dismiss="alert" class="close">&times;</a>
			<?php echo validation_errors(); ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>

	<div class="control-group form-row pb-3 <?php echo iif(form_error('login'), 'error') ;?>">
		<label class="col-4 pt-2">Email </label>
		<div class="controls col-8">
			<input class="form-control full-width" style="width: 95%" type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
		</div>
	</div>

	<div class="control-group form-row pb-3 <?php echo iif(form_error('password'), 'error') ;?>"> 
		<label class="col-4 pt-2">Password</label>
		<div class="controls col-8">
			<input class="form-control full-width" style="width: 95%" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
		</div>
	</div>

	<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
		<div class="control-group form-row pb-3">
			<div class="col-4"></div>
			<div class="controls col-8">
				<label class="checkbox" for="remember_me">
					<input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" />
					<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
				</label>
			</div>
		</div>
	<?php endif; ?>

	<div class="control-group form-row text-center pb-3">
		<div class="controls col-12">
			<input class="btn btn-large btn-primary" type="submit" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5" />
		</div>
	</div>
<?php echo form_close(); ?>   
<?php // show for Email Activation (1) only
    if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
<!-- Activation Block -->
		<p style="text-align: left" class="well">
			<?php echo lang('bf_login_activate_title'); ?><br />
			<?php
            $activate_str = str_replace('[ACCOUNT_ACTIVATE_URL]', anchor('/activate', lang('bf_activate')), lang('bf_login_activate_email'));
            $activate_str = str_replace('[ACTIVATE_RESEND_URL]', anchor('/resend-activation', lang('bf_activate_resend')), $activate_str);
            echo $activate_str; ?>
		</p>
<?php endif; ?>

<p style="text-align: center">
	<?php // if ( $site_open ) :?>
		<?php //echo anchor(REGISTER_URL, lang('us_sign_up'));?>
	<?php //endif;?>
	<?php
    if ($beta === 0) { 
        echo anchor('/Memberships', lang('us_sign_up')); 
    } else {
        
    }
    ?>

	<br/><?php echo anchor('/forgot-password', lang('us_forgot_your_password')); ?>
</p>

