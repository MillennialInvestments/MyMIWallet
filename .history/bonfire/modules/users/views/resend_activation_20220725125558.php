
<div class="intro-section intro-overview text-center bg-lighter pt-5 pb-0">
    <div class="container-fluid">
        <div class="card">
            <div class="card-inner text-center">
                <div class="nk-block py-5">
                    <div class="row justify-content-center g-gs py-5">
                        <div class="col-12 py-5">
                            <div class="nk-block-head nk-block-head-lg wide">
                                <div class="nk-block-head-content">
                                    <i class="icon icon-lg ni ni-account-setting"></i>
                                    <h3 class="nk-block-title fw-normal"><?php echo lang('us_activate_resend'); ?></h3>
                                    <div class="nk-block-des">
                                        <p class="lead">
                                        </p>
                                    </div>
                                </div>
                                <div class="card-inner text-center">
                                    <?php if (validation_errors()) { ?>
                                    <div class="row justify-content-center g-gs">
                                        <div class="col-8">
                                            <div class="alert alert-error fade in">
                                            <a data-dismiss="alert" class="close">&times;</a>
                                                <?php echo validation_errors(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="row justify-content-center g-gs">
                                        <div class="col-8">
                                            <div class="well shallow-well">
                                                <?php echo lang('us_user_activate_note'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="row justify-content-center g-gs">
                                        <div class="col-8">
                                            <?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>

                                                <div class="control-group <?php echo iif(form_error('email'), 'error') ;?>">
                                                    <label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
                                                    <div class="controls">
                                                        <input class="span6" type="text" name="email" id="email" value="<?php echo set_value('email') ?>" />
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input class="btn btn-primary" type="submit" name="send" value="<?php echo lang('us_activate_code_send') ?>"  />
                                                    </div>
                                                </div>

                                            <?php echo form_close(); ?>
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
</div>
<div class="page-header">
	<h1><?php echo lang('us_activate_resend'); ?></h1>
</div>

<?php if (validation_errors()) { ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php } else { ?>

	<div class="well shallow-well">
		<?php echo lang('us_activate_resend_note'); ?>
	</div>
<?php } ?>
<div class="row-fluid">
	<div class="span8 offset2">

<?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>

	<div class="control-group <?php echo iif(form_error('email'), 'error') ;?>">
		<label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
		<div class="controls">
			<input class="span6" type="text" name="email" id="email" value="<?php echo set_value('email') ?>" />
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<input class="btn btn-primary" type="submit" name="send" value="<?php echo lang('us_activate_code_send') ?>"  />
		</div>
	</div>

<?php echo form_close(); ?>

	</div>
</div>
