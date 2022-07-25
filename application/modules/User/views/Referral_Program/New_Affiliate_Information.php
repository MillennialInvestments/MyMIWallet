<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    $errorClass   = empty($errorClass) ? ' error' : $errorClass;
    $controlClass = empty($controlClass) ? 'span6' : $controlClass;
    $fieldData = array(
        'errorClass'    => $errorClass,
        'controlClass'  => $controlClass,
    );
?>
<?php
    $this->db->from('bf_quantities');
    $quantities = $this->db->get();
?>
<?php echo form_open('Referral_Program/New_Affiliate_Information', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
	<fieldset>
		<?php Template::block('New_Affiliate_Information/user_fields', 'New_Affiliate_Information/user_fields', $fieldData); ?>
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
		<div class="control-group">
			<div class="controls ml-3">
				<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
			</div>
		</div>
	</fieldset>
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
    <div class="alert alert-error fade in">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
