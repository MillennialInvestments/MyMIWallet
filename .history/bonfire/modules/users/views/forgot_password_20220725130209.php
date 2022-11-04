<?php 
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
                                    <h3 class="nk-block-title fw-normal">Forgot Pa</h3>
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
                                                <?php echo lang('us_reset_note'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="row justify-content-center g-gs">
                                        <div class="col-8">
                                            <?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
                                                <div class="<?php echo $formGroup; ?> <?php echo iif(form_error('email'), 'error'); ?>">
                                                    <label class="<?php echo $formLabel; ?>" for="email"><?php echo lang('bf_email'); ?></label>
                                                    <div class="<?php echo $formConCol; ?>">
                                                        <input class="<?php echo $formControl; ?>" type="text" name="email" id="email" value="<?php echo set_value('email') ?>" />
                                                    </div>
                                                </div>
                                                <div class="<?php echo $formGroup; ?>">
                                                    <div class="<?php echo $formConCol; ?>">
                                                        <input class="btn btn-primary" type="submit" name="send" value="<?php e(lang('us_send_password')); ?>" />
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
