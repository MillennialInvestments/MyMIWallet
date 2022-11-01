<?php defined('BASEPATH') OR exit ('No direct script access allowed'); ?>
<?php 
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
	'errorClass'    => $errorClass,
	'controlClass'  => $controlClass,
);
?>
<div class="modal show active" id="addVideoModal" style="height: auto !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-white">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Create Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php echo form_open('Forms/Post/Add_Video', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
			<fieldset>
				<?php 
				Template::block('Add_Video/user_fields', 'Add_Video/user_fields', $fieldData);
				?>
			</fieldset>
			<fieldset>
				<?php
				// Allow modules to render custom fields. No payload is passed
				// since the user has not been created, yet.
				Events::trigger('render_user_form');
				?>
				<!-- Start of User Meta -->
				<?php //$this->load->view('users/user_meta', array('frontend_only' => true)); ?>
				<!-- End of User Meta -->
			</fieldset>
			<!--
			<fieldset>
				<div class="control-group">
					<div class="controls ml-3">
						<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
					</div>
				</div>
			-->
			<fieldset>
				<div class="modal-footer">
					<input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Post" />
				</div>
			</fieldset>	
			
			<?php echo form_close(); ?>		
		</div>
	</div>
</div>
		
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
