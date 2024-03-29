<?php 
$date = date("F jS, Y");
$hostTime = date("g:i A");
$time = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';
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
                                    <h3 class="nk-block-title fw-normal"><?php echo lang('us_activate'); ?></h3>
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
                                        <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['allSessionData']['userAccount']['cuID']; ?>" />
                                        <div class="<?php echo $formGroup; ?>">
                                            <label class="<?php echo $formLabel; ?>" for="password"><?php echo lang('bf_password'); ?></label>
                                            <div class="<?php echo $formConCol; ?>">
                                                <input class="<?php echo $formControl; ?>" type="password" name="password" id="password" value="" placeholder="Password...." />
                                                <p class="help-block"><?php echo lang('us_password_mins'); ?></p>
                                            </div>
                                        </div>
                                        <div class="<?php echo $formGroup; ?>">
                                            <label class="<?php echo $formLabel; ?>" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
                                            <div class="<?php echo $formConCol; ?>">
                                                <input class="<?php echo $formControl; ?>" type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" />
                                            </div>
                                        </div>
                                        <div class="<?php echo $formGroup; ?>">
                                            <div class="<?php echo $formConCol; ?>">
                                                <input class="btn btn-primary" type="submit" name="set_password" id="submit" value="<?php e(lang('us_set_password')); ?>"  />
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
<div class="nk-block">
    <div class="card">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg pt-3">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Reset Your Password</h4>
                            <div class="nk-block-des">
                                <p>To keep your account secured, update your password.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">        
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-error fade in">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['allSessionData']['userAccount']['cuID']; ?>" />
                        <div class="<?php echo $formGroup; ?>">
                            <label class="<?php echo $formLabel; ?>" for="password"><?php echo lang('bf_password'); ?></label>
                            <div class="<?php echo $formConCol; ?>">
                                <input class="<?php echo $formControl; ?>" type="password" name="password" id="password" value="" placeholder="Password...." />
                                <p class="help-block"><?php echo lang('us_password_mins'); ?></p>
                            </div>
                        </div>
                        <div class="<?php echo $formGroup; ?>">
                            <label class="<?php echo $formLabel; ?>" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
                            <div class="<?php echo $formConCol; ?>">
                                <input class="<?php echo $formControl; ?>" type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" />
                            </div>
                        </div>
                        <div class="<?php echo $formGroup; ?>">
                            <div class="<?php echo $formConCol; ?>">
                                <input class="btn btn-primary" type="submit" name="set_password" id="submit" value="<?php e(lang('us_set_password')); ?>"  />
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>