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
//Get User ID
$userID                     = $this->uri->segment(2);
if (!empty($userID)) {
    $this->db->from('bf_users');
    $this->db->where('id', $userID);
    $getActCode                 = $this->db->get()->result_array();
    $actCode                    = $getActCode[0]['activate_hash'];
} else {
    $actCode                    = '';
}
?>
<div class="nk-block">
    <div class="row justify-content-center g-gs">
        <div class="col-12">
            <div class="nk-block-head nk-block-head-lg wide border-bottom">
                <div class="nk-block-head-content">
                    <div class="card">
                        <div class="card-inner text-center">
                            <i class="icon icon-lg ni ni-account-setting"></i>
                            <h3 class="nk-block-title fw-normal"><?php echo lang('us_activate'); ?></h3>
                            <div class="nk-block-des">
                                <p class="lead">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

            <div class="<?php echo $formGroup; ?> <?php echo iif(form_error('code'), 'error') ;?>">
                <label class="<?php echo $formLabel; ?>" for="code"><?php echo lang('us_activate_code'); ?></label>
                <div class="<?php echo $formConCol; ?>">
                    <input class="<?php echo $formContro; ?>" type="text" id="code" name="code" value="<?php echo set_value('code', isset($user) ? $user->code : $actCode); ?>" />
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input class="btn btn-primary" type="submit" name="activate" value="<?php echo lang('us_confirm_activate_code') ?>"  />
                </div>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>
<section class="cid-s0KKUOB7cY border-bottom pb-0" id="header01-m">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-8 col-lg-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
                        <div class="page-header">
                            <h1><?php echo lang('us_activate'); ?></h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
