<?php
// Set Form Config
$formGroup				= $this->config->item('form_container') . ' input-group';
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker') . ' dis-selectpicker';
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
$cuFullName             = $cuFirstName . ' ' .  $cuMiddleName . ' ' . $cuLastName . ' ' . $cuNameSuffix; 
$cuFullAddress          = $cuAddress . ', ' . $cuCity . ', ' . $cuState . ', ' . $cuCountry . ' ' . $cuZipCode; 
?>
<style>
    .dis-selectpicker{
        display: block !important;
    }
</style>
<div class="card card-bordered h-100">
    <div class="card-inner-group">
        <div class="card-inner card-inner-md">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Financial Assessment</h6>
                </div>
                <div class="card-tools me-n1">
                    <div class="drodown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="nk-wg-action">
                <div class="nk-wg-action-content full-width">
                    <div class="tab-content">
                        <div id="account-checklist" class="tab-pane fade active show">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Account Setup & Progress</h4>
                                        <div class="nk-block-des">
                                            <p>Complete your Account Setup to access of the MyMI Wallet Features available!</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <?php // print_r($userAssessment); ?>
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Your Current Progress</h6>
                                    </div>            
                                    <!-- Account Information data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Stage</strong></span>
                                            <span class="data-value w-50" id="pbt"><strong>Status</strong></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <!-- <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a> -->
                                        </div>
                                    </div>    
                                    <!-- Account Information data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Account Information</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#account-information"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Banking Accounts data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Banking Accounts</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#banking-summary"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Credit Accounts data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Credit Accounts</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#credit-summary"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Debt Accounts data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Debt Accounts</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#debt-accounts"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Investment Accounts data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Investment Accounts</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#investment-summary"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Risk Assessment data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Risk Assessment</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#financial-goals"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                    <!-- Experience & Knowledge data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-50"><strong>Experience/Knowledge Assessment</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white" data-toggle="tab" href="#investment-knowledge"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Get Started!</span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="account-information" class="tab-pane fade">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Account Information</h4>
                                        <div class="nk-block-des">
                                            <p>Basic info, like your name and address, that you use at MyMI Wallet.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <?php
                                $meta_fields = Template::get('meta_fields');
                                $pageURIA = $this->uri->segment(1);
                                $pageURIB = $this->uri->segment(2);
                                $cuID = $pageURIB;
                                $getUserInfo = $this->user_model->get_user_info($cuID);
                                foreach ($getUserInfo->result_array() as $userInfo) {
                                    $cuEmail = $userInfo['email'];
                                    $cuUsername = $userInfo['username'];
                                }
                                $currentMethod = $this->router->method;
                                $errorClass = empty($errorClass) ? ' error' : $errorClass;
                                $registerClass = $currentMethod == 'register' ? ' required' : '';
                                $editSettings = $currentMethod == 'edit';
                                $defaultLanguage = isset($user->language) ? $user->language : strtolower(settings_item('language'));
                                $defaultTimezone = isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
                            ?>
                            <style>
                                .form-control {
                                    min-height: 40px !important;
                                    margin-top: 0 !important;
                                    background-color: #ededed !important
                                }
                            </style>
                            <input id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" type="hidden">
                            <input id="user_email" name="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>" type="hidden">
                            <input id="user_username" name="user_username" value="<?php echo set_value('user_username', isset($user) ? $user->user_username : $cuUsername); ?>" type="hidden">
                            <div class="<?php e($formGroup); ?><?php echo form_error('first_name') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="first_name">First Name</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="first_name" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>" class="<?php e($formControl); ?>" type="tel">
                                    <span class="help-inline"><?php echo form_error('first_name'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('middle_name') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="middle_name">Middle Name <small class="text-muted">(Optional)</small></label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="middle_name" name="middle_name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>" class="<?php e($formControl); ?>" type="tel">
                                    <span class="help-inline"><?php echo form_error('middle_name'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('last_name') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="last_name">Last Name</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="last_name" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>" class="<?php e($formControl); ?>" type="tel">
                                    <span class="help-inline"><?php echo form_error('last_name'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('name_suffix') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>required" for="name_suffix">Suffix</label>
                                <div class="<?php e($formConCol); ?>">
                                    <select class="<?php echo $formControl; ?>" id="name_suffix" name="name_suffix" required style="height:40px;padding:10px">
                                        <?php
                                        $type_values = array('.' => 'N/A', 'Jr.' => 'Jr.', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V',);
                                        foreach ($type_values as $value => $display_text) {
                                            $selected = ($value == $this->input->post('name_suffix')) ? ' selected="selected"' : "";
                                            echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('phone') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="phone">Phone</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="phone" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>" class="<?php e($formControl); ?>" type="tel">
                                    <span class="help-inline"><?php echo form_error('phone'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('address') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="address">Address</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="address" name="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>" class="<?php e($formControl); ?>">
                                    <span class="help-inline"><?php echo form_error('address'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('city') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="city">City</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="city" name="city" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>" class="<?php e($formControl); ?>">
                                    <span class="help-inline"><?php echo form_error('city'); ?></span>
                                </div>
                            </div>
                            <?php
                                if (!empty($meta_fields)) :
                                    $defaultCountry = 'US';
                                    $defaultState = 'N/A';
                                    $countryFieldId = false;
                                    $stateFieldId = false;
                                    $displayFrontend = isset($frontend_only) ? $frontend_only : false;
                                    $userIsAdmin = isset($current_user) ? ($current_user->role_id == 1) : false;
                                    foreach ($meta_fields as $field) :
                                        $adminField = isset($field['admin_only']) ? $field['admin_only'] : false;
                                        if ($adminField && !$userIsAdmin) {
                                            continue;
                                        }
                                        $frontField = isset($field['frontend']) ? $field['frontend'] : true;
                                        if ($displayFrontend && !$frontField) {
                                            continue;
                                        }
                                        if ($field['form_detail']['type'] == 'dropdown') :
                                            echo form_dropdown($field['form_detail']['settings'], $field['form_detail']['options'], set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : ''), $field['label']);
                                        elseif ($field['form_detail']['type'] == 'checkbox') :
                            ?>
                            <div class="<?php e($formGroup); ?><?php echo form_error($field['name']) ? ' error' : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>
                                <div class="<?php e($formConCol); ?>">
                                    <?php echo form_checkbox($field['form_detail']['settings'], $field['form_detail']['value'], $field['form_detail']['value'] == set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : '')); ?>
                                </div>
                            </div>
                            <?php
                                elseif ($field['form_detail']['type'] == 'state_select' && is_callable('state_select')) :
                                    $stateFieldId = $field['name'];
                                    $stateValue = isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultState;
                            ?>
                            <div class="<?php e($formGroup); ?><?php echo form_error($field['name']) ? ' error' : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="<?php echo $field['name']; ?>"><?php echo lang('user_meta_state'); ?></label>
                                <div class="<?php e($formConCol); ?>">
                                    <?php echo state_select(set_value($field['name'], $stateValue), $defaultState, $defaultCountry, $field['name'], 'span6 chzn-select form-control full-width'); ?>
                                </div>
                            </div>
                                    <?php
                                    elseif ($field['form_detail']['type'] == 'country_select' && is_callable('country_select')) :
                                        $countryFieldId = $field['name'];
                                        $countryValue = isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultCountry;
                                    ?>
                                        <div class="<?php e($formGroup); ?><?php echo form_error($field['name']) ? ' error' : ''; ?>">
                                            <label class="<?php e($formLabel); ?>" for="<?php echo $field['name']; ?>"><?php echo lang('user_meta_country'); ?></label>
                                            <div class="<?php e($formConCol); ?>">
                                                <?php echo country_select(set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultCountry), $defaultCountry, $field['name'], 'span6 chzn-select form-control full-width'); ?>
                                            </div>
                                        </div>
                                    <?php
                                    else :
                                        $form_method = "form_{$field['form_detail']['type']}";
                                        if (is_callable($form_method)) {
                                            echo $form_method($field['form_detail']['settings'], set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : ''), $field['label']);
                                        }
                                    endif;
                                endforeach;
                                if (!empty($countryFieldId) && !empty($stateFieldId)) {
                                    Assets::add_js($this->load->view('country_state_js', array('country_name' => $countryFieldId, 'country_value' => $countryValue, 'state_name' => $stateFieldId, 'state_value' => $stateValue,), true), 'inline');
                                }
                            endif;
                            ?>
                            <div class="<?php e($formGroup); ?><?php echo form_error('zipcode') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="zipcode">Zipcode</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="zipcode" name="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>" class="<?php e($formControl); ?>">
                                    <span class="help-inline"><?php echo form_error('zipcode'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('timezones') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>required" for="timezones"><?php echo lang('bf_timezone'); ?></label>
                                <div class="<?php e($formConCol); ?>">
                                    <?php echo timezone_menu(set_value('timezones', isset($user) ? $user->timezone : $defaultTimezone), $formControl, 'timezones', array('id' => 'timezones')); ?>
                                    <span class="help-inline"><?php echo form_error('timezones'); ?></span>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('language') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>required" for="language">Language</label>
                                <div class="<?php e($formConCol); ?>">
                                    <select class="<?php echo $formControl; ?>" id="language" name="language" required style="height:40px;padding:10px">
                                        <?php
                                        if (!empty($cuLanguage)) {
                                            $language_values = array('English' => 'English (Default)', 'Arabic' => 'Arabic', 'Chinese' => 'Chinese', 'English' => 'English', 'French' => 'French', 'German' => 'German', 'Italian' => 'Italian', 'Japanese' => 'Japanese', 'Polish' => 'Polish', 'Portuguese' => 'Portuguese', 'Russian' => 'Russian', 'Spanish' => 'Spanish', 'Turkisk' => 'Turkisk',);
                                            foreach ($language_values as $value => $display_text) {
                                                $selected = ($value == $this->input->post('language')) ? ' selected="selected"' : "";
                                                echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
                                            }
                                        } else {
                                            $language_values = array('English' => 'English (Default)', 'Arabic' => 'Arabic', 'Chinese' => 'Chinese', 'English' => 'English', 'French' => 'French', 'German' => 'German', 'Italian' => 'Italian', 'Japanese' => 'Japanese', 'Polish' => 'Polish', 'Portuguese' => 'Portuguese', 'Russian' => 'Russian', 'Spanish' => 'Spanish', 'Turkisk' => 'Turkisk',);
                                            foreach ($language_values as $value => $display_text) {
                                                $selected = ($value == $this->input->post('language')) ? ' selected="selected"' : "";
                                                echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
                                           }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('advertisement') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="advertisement">How did you hear about us?</label>
                                <div class="<?php e($formConCol); ?>">
                                    <select class="form-control" id="advertisement" name="advertisement" required>
                                        <option>Select-An-Option</option>
                                        <?php
                                        $type_values = array('Email' => 'Email', 'Discord' => 'Discord', 'Facebook' => 'Facebook', 'Google' => 'Google', 'StockTwits' => 'StockTwits', 'Twitter' => 'Twitter', 'Word-Of-Mouth' => 'Word-Of-Mouth',);
                                        foreach ($type_values as $value => $display_text) {
                                            $selected = ($value == $this->input->post('advertisement')) ? ' selected="selected"' : "";
                                            echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="nk-block-head nk-block-head-lg pt-3">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Generate MyMI Wallet Address</h4>
                                        <div class="nk-block-des">
                                            <p>Create your MyMI Wallet to handle your transactions and more.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="<?php e($formGroup); ?><?php echo form_error('total') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="zipcode">Click Here To Generate New Wallet Address:</label>
                                <div class="col-9"><a class="btn btn-primary btn-sm text-white" onclick="createWalletAddressDGB()">Generate</a></div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('private_key') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="private_key">Private Key</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="private_key" name="private_key" value="<?php echo set_value('private_key', isset($user) ? $user->private_key : $cuPrivateKey); ?>" class="<?php e($formControl); ?>">
                                    <p class="help-text">Store Your Private Key somewhere safe and secure.</p>
                                </div>
                            </div>
                            <div class="<?php e($formGroup); ?><?php echo form_error('public_key') ? $errorClass : ''; ?>">
                                <label class="<?php e($formLabel); ?>" for="public_key">Public Key</label>
                                <div class="<?php e($formConCol); ?>">
                                    <input id="public_key" name="public_key" value="<?php echo set_value('public_key', isset($user) ? $user->public_key : $cuPublicKey); ?>" class="<?php e($formControl); ?>">
                                </div>
                            </div>
                        </div>
                        <div id="account-information-old" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Account Information</h4>
                                        <div class="nk-block-des">
                                            <p>Basic info, like your name and address, that you use at MyMI Wallet.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <form class="form-horizontal" id="updateInvestorProfileForm">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">Basic Contact Information</h6>
                                        </div>            
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
                                        <div class="data-item">
                                            <div class="data-col" id="col_email">
                                                <span class="data-label w-25">Email</span>
                                                <span class="data-value w-100" id="email"><?php echo $cuEmail; ?></span>
                                                <input type="hidden" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="email_Switch(event, document.getElementById('col_email'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Email data-item -->
                                        <script>
                                            function email_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('email').innerText;
                                                let input               = document.getElementById('email').innerText;
                                                // let element             = document.getElementById('col_email');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Email</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="email" id="email" placeholder="Enter Email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();

                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'email_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('email').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function email_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_email');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Email</span>
                                                <span class="data-value w-100" id="email"><?php echo $cuEmail; ?></span>
                                                <input type="hidden" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                                                `;
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'email_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_username">
                                                <span class="data-label w-25">Display Name</span>
                                                <span class="data-value w-100" id="username"><?php echo $cuUsername; ?></span>
                                                <input type="hidden" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="username_Switch(event, document.getElementById('col_username'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Display data-item -->
                                        <script>
                                            function username_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('username').innerText;
                                                let input               = document.getElementById('username').innerText;
                                                // let element             = document.getElementById('col_username');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Display Name</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="username" id="username" placeholder="Enter Display Name" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'username_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('username').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function username_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_username');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Display Name</span>
                                                <span class="data-value w-100" id="username"><?php echo $cuUsername; ?></span>
                                                <input type="hidden" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                                                `;
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'username_Reset(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_first_name">
                                                <span class="data-label w-25">First Name</span>
                                                <span class="data-value w-100" id="first_name"><?php echo $cuFirstName; ?></span>
                                                <input type="hidden" name="first_name" id="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="first_name_Switch(event, document.getElementById('col_first_name'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- First Name data-item -->
                                        <script>
                                            function first_name_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('first_name').innerText;
                                                let input               = document.getElementById('first_name').innerText;
                                                // let element             = document.getElementById('col_first_name');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">First Name</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="first_name" id="first_name" placeholder="Enter Display Name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'first_name_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('first_name').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function first_name_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_first_name');

                                                element.innerHTML = `
                                                <span class="data-label w-25">First Name</span>
                                                <span class="data-value w-100" id="first_name"><?php echo $cuFirstName; ?></span>
                                                <input type="hidden" name="first_name" id="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                                                `;
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'first_name_Reset(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_middle_name">
                                                <span class="data-label w-25">Middle Name</span>
                                                <span class="data-value w-100" id="middle_name"><?php echo $cuMiddleName; ?></span>
                                                <span class="d-none" id="middle_name">middle_name</span>
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="middle_name_Switch(event, document.getElementById('col_middle_name'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Middle Name data-item -->
                                        <script>
                                            function middle_name_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('middle_name').innerText;
                                                let input               = document.getElementById('middle_name').innerText;
                                                // let element             = document.getElementById('col_middle_name');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Middle Name</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="middle_name" id="middle_name" placeholder="Enter Display Name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'middle_name_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('middle_name').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function middle_name_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_middle_name');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Middle Name</span>
                                                <span class="data-value w-100" id="middle_name"><?php echo $cuMiddleName; ?></span>
                                                <input type="hidden" name="middle_name" id="middle_name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>">	
                                                `;
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'middle_name_Reset(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_last_name">
                                                <span class="data-label w-25">Last Name</span>
                                                <span class="data-value w-100" id="last_name"><?php echo $cuLastName; ?></span>
                                                <input type="hidden" name="last_name" id="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="last_name_Switch(event, document.getElementById('col_last_name'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Last Name data-item -->
                                        <script>
                                            function last_name_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('last_name').innerText;
                                                let input               = document.getElementById('last_name').innerText;
                                                // let element             = document.getElementById('col_last_name');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Last Name</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="last_name" id="last_name" placeholder="Enter Display Name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'last_name_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('last_name').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function last_name_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_last_name');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Last Name</span>
                                                <span class="data-value w-100" id="last_name"><?php echo $cuLastName; ?></span>
                                                <input type="hidden" name="last_name" id="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                                                `;
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'last_name_Reset(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_name_suffix">
                                                <span class="data-label w-25">Suffix</span>
                                                <span class="data-value w-100" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                                                <input type="hidden" name="name_suffix" id="name_suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="name_suffix_Switch(event, document.getElementById('col_name_suffix'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Name Suffix data-item -->
                                        <script>
                                            function name_suffix_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('name_suffix').innerText;
                                                let input               = document.getElementById('name_suffix').innerText;
                                                // let element             = document.getElementById('col_name_suffix');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Name Suffix</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="name_suffix" id="name_suffix" placeholder="Enter Name Suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'name_suffix_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('name_suffix').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function name_suffix_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_name_suffix');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Suffix</span>
                                                <span class="data-value w-100" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                                                <input type="hidden" name="name_suffix" id="name_suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'name_suffix_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_phone">
                                                <span class="data-label w-25">Phone</span>
                                                <span class="data-value w-100" id="phone"><?php echo $cuPhone; ?></span>
                                                <input type="hidden" name="phone" id="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="phone_Switch(event, document.getElementById('col_phone'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Phone data-item -->
                                        <script>
                                            function phone_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('phone').innerText;
                                                let input               = document.getElementById('phone').innerText;
                                                // let element             = document.getElementById('col_phone');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Phone</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'phone_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('phone').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function phone_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_phone');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Phone</span>
                                                <span class="data-value w-100" id="phone"><?php echo $cuPhone; ?></span>
                                                <input type="hidden" name="phone" id="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'phone_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_address">
                                                <span class="data-label w-25">Address</span>
                                                <span class="data-value w-100" id="address"><?php echo $cuAddress; ?></span>
                                                <input type="hidden" name="address" id="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="address_Switch(event, document.getElementById('col_address'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Street Address data-item -->
                                        <script>
                                            function address_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('address').innerText;
                                                let input               = document.getElementById('address').innerText;
                                                // let element             = document.getElementById('col_address');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Address</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="address" id="address" placeholder="Enter Address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'address_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('address').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function address_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_address');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Address</span>
                                                <span class="data-value w-100" id="address"><?php echo $cuAddress; ?></span>
                                                <input type="hidden" name="address" id="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'address_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_city">
                                                <span class="data-label w-25">City</span>
                                                <span class="data-value w-100" id="city"><?php echo $cuCity; ?></span>
                                                <input type="hidden" name="city" id="city" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="city_Switch(event, document.getElementById('col_city'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- City data-item -->
                                        <script>
                                            function city_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('city').innerText;
                                                let input               = document.getElementById('city').innerText;
                                                // let element             = document.getElementById('col_city');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">City</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'city_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('city').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function city_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_city');

                                                element.innerHTML = `
                                                <span class="data-label w-25">City</span>
                                                <span class="data-value w-100" id="city"><?php echo $cuCity; ?></span>
                                                <input type="hidden" name="city" id="city" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'city_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_state">
                                                <span class="data-label w-25">State</span>
                                                <span class="data-value w-100" id="state"><?php echo $cuState; ?></span>
                                                <input type="hidden" name="state" id="state" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="state_Switch(event, document.getElementById('col_state'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- State data-item -->
                                        <script>
                                            function state_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('state').innerText;
                                                let input               = document.getElementById('state').innerText;
                                                // let element             = document.getElementById('col_state');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">State</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="state" id="state" placeholder="Enter State" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'state_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('state').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function state_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_state');

                                                element.innerHTML = `
                                                <span class="data-label w-25">State</span>
                                                <span class="data-value w-100" id="state"><?php echo $cuState; ?></span>
                                                <input type="hidden" name="state" id="state" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'state_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_country">
                                                <span class="data-label w-25">Country</span>
                                                <span class="data-value w-100" id="country"><?php echo $cuCountry; ?></span>
                                                <input type="hidden" name="country" id="country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="country_Switch(event, document.getElementById('col_country'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Country data-item -->
                                        <script>
                                            function country_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('country').innerText;
                                                let input               = document.getElementById('country').innerText;
                                                // let element             = document.getElementById('col_country');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Country</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="country" id="country" placeholder="Enter Country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'country_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('country').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function country_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_country');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Country</span>
                                                <span class="data-value w-100" id="country"><?php echo $cuCountry; ?></span>
                                                <input type="hidden" name="country" id="country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'country_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_zipcode">
                                                <span class="data-label w-25">Zip Code</span>
                                                <span class="data-value w-100" id="zipcode"><?php echo $cuZipCode; ?></span>
                                                <input type="hidden" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onClick="zipcode_Switch(event, document.getElementById('col_zipcode'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div><!-- Zip Code data-item -->
                                        <script>
                                            function zipcode_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('zipcode').innerText;
                                                let input               = document.getElementById('zipcode').innerText;
                                                // let element             = document.getElementById('col_zipcode');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Zip Code</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="zipcode" id="zipcode" placeholder="Enter Zip Code" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'zipcode_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('zipcode').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function zipcode_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_zipcode');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Zip Code</span>
                                                <span class="data-value w-100" id="zipcode"><?php echo $cuZipCode; ?></span>
                                                <span class="d-none" id="zipcode">zipcode</span>
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'zipcode_Switch(event, this)');
                                            }
                                        </script>
                                        <div class="data-item">
                                            <div class="data-col" id="col_zipcode">
                                                <span class="data-label w-25"></span>
                                                <span class="data-value w-100" id="zipcode"></span>
                                                <input type="hidden" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <input class="btn btn-primary btn-sm" type="submit" name="submit" id="submit" value="Submit" />
                                            </div>
                                        </div><!-- Zip Code data-item -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="kyc-verification" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">KYC Verification</h4>
                                        <div class="nk-block-des">
                                            <p>Basic info, like your name and address, that you use at MyMI Wallet.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <form class="form-horizontal" id="updateInvestorProfileForm">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">Identification Verification</h6>
                                        </div>            
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">                                        
                                        <!-- Full Name data-item -->
                                        <div class="data-item">
                                            <div class="data-col" id="col_fullname">
                                                <span class="data-label w-25">Full Name</span>
                                                <span class="data-value w-100" id="fullname"><?php echo $cuFullName; ?></span>
                                                <input id="fullname" name="fullname" type="hidden" value="<?php echo set_value('fullname', isset($user) ? $user->fullname : $cuFullName); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="fullname_Switch(event, document.getElementById('col_fullname'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function fullname_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('fullname').innerText;
                                                let input               = document.getElementById('fullname').innerText;
                                                // let element             = document.getElementById('col_email');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Full Name</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="fullname" id="fullname" placeholder="Enter Full Name" value="<?php echo set_value('fullname', isset($user) ? $user->fullname : $cuFullName); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'fullname_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('fullname').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function fullname_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_fullname');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Full Name</span>
                                                <span class="data-value w-100" id="fullname"><?php echo $cuEmail; ?></span>
                                                <input type="hidden" name="fullname" id="fullname" value="<?php echo set_value('fullname', isset($user) ? $user->fullname : $cuFullName); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'fullname_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Date of Birth data-item -->
                                        <div class="data-item">
                                            <div class="data-col" id="col_dob">
                                                <span class="data-label w-25">Date of Birth</span>
                                                <span class="data-value w-100" id="dob"><?php echo $cuDOB; ?></span>
                                                <input id="dob" name="dob" type="hidden" value="<?php echo set_value('dob', isset($user) ? $user->dob : $cuDOB); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="dob_Switch(event, document.getElementById('col_dob'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function dob_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('dob').innerText;
                                                let input               = document.getElementById('dob').innerText;
                                                // let element             = document.getElementById('col_dob');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Date of Birth</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="date" class="<?php echo $formControl; ?>" name="dob" id="dob" placeholder="Enter Date of Birth" value="<?php echo set_value('dob', isset($user) ? $user->dob : $cuDOB); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'dob_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('dob').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function dob_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_dob');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Date of Birth</span>
                                                <span class="data-value w-100" id="dob"><?php echo $cuDOB; ?></span>
                                                <input type="hidden" name="dob" id="dob" value="<?php echo set_value('dob', isset($user) ? $user->dob : $cuDOB); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'dob_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Social Security Number data-item -->	
                                        <div class="data-item">
                                            <div class="data-col" id="col_ssn">
                                                <span class="data-label w-25">Social Security Number</span>
                                                <span class="data-value w-100" id="ssn"><?php echo $cuSSN; ?></span>
                                                <input id="ssn" name="ssn" type="hidden" value="<?php echo set_value('ssn', isset($user) ? $user->ssn : $cuSSN); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="ssn_Switch(event, document.getElementById('col_ssn'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function ssn_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('ssn').innerText;
                                                let input               = document.getElementById('ssn').innerText;
                                                // let element             = document.getElementById('col_ssn');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Social Security Number</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="password" class="<?php echo $formControl; ?>" name="ssn" id="ssn" placeholder="Enter Social Security Number" value="<?php echo set_value('ssn', isset($user) ? $user->ssn : $cuSSN); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'ssn_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('ssn').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function ssn_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_ssn');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Social Security Number</span>
                                                <span class="data-value w-100" id="ssn"><?php echo $cuSSN; ?></span>
                                                <input type="hidden" name="ssn" id="ssn" value="<?php echo set_value('ssn', isset($user) ? $user->ssn : $cuSSN); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'ssn_Switch(event, this)');
                                            }
                                        </script>
                                        <script>
                                            // $(document).ready(function(){
                                            //     $('#ssn').mask('XXX-XX-XXXX');
                                            // });
                                        </script>
                                        <?php
                                        // !! Use the function below to encrypt this before sending to Database 
                                        // $ssn = $_POST['ssn'];

                                        // // Validate SSN format
                                        // if (!preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $ssn)) {
                                        //     echo "Invalid SSN format. Please enter a valid SSN.";
                                        //     exit;
                                        // }
                                        
                                        // // Encrypt SSN before storing it
                                        // $encryptedSsn = openssl_encrypt($ssn, 'aes-256-cbc', $encryptionKey, 0, $iv);
                                        
                                        // // Now you can store $encryptedSsn in your database
                                        ?>
                                        <!-- Residential Address data-item -->
                                        <div class="data-item">
                                            <div class="data-col" id="col_address">
                                                <span class="data-label w-25">Residential Address</span>
                                                <span class="data-value w-100" id="address"><?php echo $cuFullAddress; ?></span>
                                                <input id="address" name="address" type="hidden" value="<?php echo set_value('address', isset($user) ? $user->address : $cuFullAddress); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="address_Switch(event, document.getElementById('col_address'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function address_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('address').innerText;
                                                let input               = document.getElementById('address').innerText;
                                                // let element             = document.getElementById('col_address');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Residential Address</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="address" id="address" placeholder="Enter Residential Address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuFullAddress); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'address_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('address').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function address_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_address');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Residential Address</span>
                                                <span class="data-value w-100" id="address"><?php echo $cuFullAddress; ?></span>
                                                <input type="hidden" name="address" id="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuFullAddress); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'address_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Mailing Address data-item -->
                                        <div class="data-item">
                                            <div class="data-col" id="col_mailing_address">
                                                <span class="data-label w-25">Mailing Address</span>
                                                <span class="data-value w-100" id="mailing_address"><?php echo $cuMailingAddress; ?></span>
                                                <input id="mailing_address" name="mailing_address" type="hidden" value="<?php echo set_value('mailing_address', isset($user) ? $user->mailing_address : $cuMailingAddress); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="mailing_address_Switch(event, document.getElementById('col_mailing_address'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function mailing_address_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('mailing_address').innerText;
                                                let input               = document.getElementById('mailing_address').innerText;
                                                // let element             = document.getElementById('col_mailing_address');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Mailing Address</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="mailing_address" id="mailing_address" placeholder="Enter Mailing Address" value="<?php echo set_value('mailing_address', isset($user) ? $user->mailing_address : $cuMailingAddress); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'mailing_address_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('mailing_address').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function mailing_address_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_mailing_address');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Mailing Address</span>
                                                <span class="data-value w-100" id="mailing_address"><?php echo $cuMailingAddress; ?></span>
                                                <input type="hidden" name="mailing_address" id="mailing_address" value="<?php echo set_value('mailing_address', isset($user) ? $user->mailing_address : $cuMailingAddress); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'mailing_address_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Employment Information data-item -->	
                                        <div class="data-item">
                                            <div class="data-col" id="col_employment_info">
                                                <span class="data-label w-25">Employment Information</span>
                                                <span class="data-value w-100" id="employment_info"><?php echo $cuEmployment; ?></span>
                                                <input id="employment_info" name="employment_info" type="hidden" value="<?php echo set_value('employment_info', isset($user) ? $user->employment_info : $cuEmployment); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="employment_info_Switch(event, document.getElementById('col_employment_info'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function employment_info_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('employment_info').innerText;
                                                let input               = document.getElementById('employment_info').innerText;
                                                // let element             = document.getElementById('col_employment_info');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Employment Information</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <select class="<?php echo $formSelectPicker; ?>" style="display:block !important;" id="employment_info" name="employment_info">
                                                                    <option value="Employed">Employed</option>
                                                                    <option value="Unemployed">Unemployed</option>
                                                                    <option value="Self-Employed">Self-Employed</option>
                                                                </select>	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'employment_info_Reset(event, this)');
                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('employment_info').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function employment_info_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_employment_info');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Employment Information</span>
                                                <span class="data-value w-100" id="employment_info"><?php echo $cuEmployment; ?></span>
                                                <input type="hidden" name="employment_info" id="employment_info" value="<?php echo set_value('employment_info', isset($user) ? $user->employment_info : $cuEmployment); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'employment_info_Switch(event, this)');
                                            }
                                        </script>                      
                                        <!-- Occupation data-item -->
                                        <div class="data-item">
                                            <div class="data-col" id="col_occupation">
                                                <span class="data-label w-25">Occupation</span>
                                                <span class="data-value w-100" id="occupation"><?php echo $cuOccupation; ?></span>
                                                <input id="occupation" name="occupation" type="hidden" value="<?php echo set_value('occupation', isset($user) ? $user->occupation : $cuOccupation); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="occupation_Switch(event, document.getElementById('col_occupation'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function occupation_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('occupation').innerText;
                                                let input               = document.getElementById('occupation').innerText;
                                                // let element             = document.getElementById('col_email');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Occupation</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <input type="text" class="<?php echo $formControl; ?>" name="occupation" id="occupation" placeholder="Enter Occupation" value="<?php echo set_value('occupation', isset($user) ? $user->occupation : $cuOccupation); ?>">	
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'occupation_Reset(event, this)');

                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('occupation').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function occupation_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_occupation');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Occupation</span>
                                                <span class="data-value w-100" id="occupation"><?php echo $cuEmail; ?></span>
                                                <input type="hidden" name="occupation" id="occupation" value="<?php echo set_value('occupation', isset($user) ? $user->occupation : $cuOccupation); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'occupation_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Salary data-item -->	 
                                        <div class="data-item">
                                            <div class="data-col" id="col_salary">
                                                <span class="data-label w-25">Salary</span>
                                                <span class="data-value w-100" id="salary"><?php echo $cuSalary; ?></span>
                                                <input id="salary" name="salary" type="hidden" value="<?php echo set_value('salary', isset($user) ? $user->salary : $cuSalary); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <a class="data-more" onclick="salary_Switch(event, document.getElementById('col_salary'))"><em class="icon ni ni-forward-ios"></em></a>
                                            </div>
                                        </div>
                                        <script>
                                            function salary_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt = document.getElementById('salary').innerText;
                                                let input = document.getElementById('salary').innerText;

                                                element.innerHTML = `
                                                    <span class="data-label w-25">Salary</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <select class="<?php echo $formSelectPicker; ?>" style="display:block !important;" id="salary" name="salary">
                                                                    <option value="Under $25,000">Under $25,000</option>
                                                                    <option value="$25,000 to $50,000">$25,000 to $50,000</option>
                                                                    <option value="$50,000 to $75,000">$50,000 to $75,000</option>
                                                                    <option value="$75,000 to $100,000">$75,000 to $100,000</option>
                                                                    <option value="$100,000 to $150,000">$100,000 to $150,000</option>
                                                                    <option value="$150,000 to $200,000">$150,000 to $200,000</option>
                                                                    <option value="$200,000 to $250,000">$200,000 to $250,000</option>
                                                                    <option value="$250,000 to $500,000">$250,000 to $500,000</option>
                                                                    <option value="Over $500,000">Over $500,000</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'salary_Reset(event, this)');

                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('salary').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function salary_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt = document.getElementById('old-text').innerHTML;

                                                element.innerHTML = `
                                                <span class="data-label w-25">Salary</span>
                                                <span class="data-value w-100" id="salary"><?php echo $cuSalary; ?></span>
                                                <input type="hidden" name="salary" id="salary" value="<?php echo set_value('salary', isset($user) ? $user->salary : $cuSalary); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'salary_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Proof of Identity data-item -->	 
                                        <div class="data-item">
                                            <div class="data-col" id="col_proof_identity">
                                                <span class="data-label w-25">Proof of Identity</span>
                                                <span class="data-value w-100" id="proof_identity"><?php echo $cuProofIdentity; ?></span>
                                                <input id="proof_identity" name="proof_identity" type="hidden" value="<?php echo set_value('proof_identity', isset($user) ? $user->proof_identity : $cuProofIdentity); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <span class="data-more" onclick="proof_identity_Switch(event, document.getElementById('col_proof_identity'))"><em class="icon ni ni-forward-ios"></em></span>
                                            </div>
                                        </div>
                                        <script>
                                            function proof_identity_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('proof_identity').innerText;
                                                let input               = document.getElementById('proof_identity').innerText;
                                                // let element             = document.getElementById('col_proof_identity');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Proof of Identity</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <select class="<?php echo $formSelectPicker; ?>" style="display:block !important;" id="proof_identity" name="proof_identity">
                                                                    <option value="Passport">Passport</option>
                                                                    <option value="Driver's License">Driver's License</option>
                                                                    <option value="National ID">National ID</option>
                                                                    <!-- Add more options as needed -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'proof_identity_Reset(event, this)');

                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('proof_identity').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function proof_identity_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_proof_identity');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Proof of Identity</span>
                                                <span class="data-value w-100" id="proof_identity"><?php echo $cuProofIdentity; ?></span>
                                                <input type="hidden" name="proof_identity" id="proof_identity" value="<?php echo set_value('proof_identity', isset($user) ? $user->proof_identity : $cuProofIdentity); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'proof_identity_Switch(event, this)');
                                            }
                                        </script>
                                        <!-- Proof of Address data-item -->	 
                                        <div class="data-item">
                                            <div class="data-col" id="col_proof_address">
                                                <span class="data-label w-25">Proof of Address</span>
                                                <span class="data-value w-100" id="proof_address"><?php echo $cuProofAddress; ?></span>
                                                <input id="proof_address" name="proof_address" type="hidden" value="<?php echo set_value('proof_address', isset($user) ? $user->proof_address : $cuProofAddress); ?>">
                                            </div>
                                            <div class="data-col data-col-end w-15">
                                                <s class="data-more" onclick="proof_address_Switch(event, document.getElementById('col_proof_address'))"><em class="icon ni ni-forward-ios"></em></s>
                                            </div>
                                        </div>
                                        <script>
                                            function proof_address_Switch(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('proof_address').innerText;
                                                let input               = document.getElementById('proof_address').innerText;
                                                // let element             = document.getElementById('col_proof_address');

                                                element.innerHTML       = `
                                                    <span class="data-label w-25">Proof of Address</span>
                                                    <span class="data-value w-100">
                                                        <span class="d-none" id="old-text">${txt}</span>
                                                        <span class="d-none" id="${input}">${input}</span>
                                                        <div class="<?php echo $formGroup; ?>">      
                                                            <div class="<?php echo $formConCol; ?>">       
                                                                <select class="<?php echo $formSelectPicker; ?>" style="display:block !important;" id="proof_address" name="proof_address">
                                                                    <option value="Passport">Passport</option>
                                                                    <option value="Driver's License">Driver's License</option>
                                                                    <option value="National ID">National ID</option>
                                                                    <!-- Add more options as needed -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                `;
                                                document.getElementsByTagName('input')[0].focus();
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'proof_address_Reset(event, this)');

                                                // Add event listener to stop propagation on the select dropdown
                                                document.getElementById('proof_address').addEventListener('click', function(e) {
                                                    e.stopPropagation();
                                                });
                                            }

                                            function proof_address_Reset(event, element) {
                                                event.stopPropagation();
                                                let txt                 = document.getElementById('old-text').innerHTML;
                                                // let element             = document.getElementById('col_proof_address');

                                                element.innerHTML = `
                                                <span class="data-label w-25">Proof of Address</span>
                                                <span class="data-value w-100" id="proof_address"><?php echo $cuProofAddress; ?></span>
                                                <input type="hidden" name="proof_address" id="proof_address" value="<?php echo set_value('proof_address', isset($user) ? $user->proof_address : $cuProofAddress); ?>">	
                                                `;
                                                // Change the onClick attribute
                                                element.setAttribute('onClick', 'proof_address_Switch(event, this)');
                                            }
                                        </script>  
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="features-activated" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">MyMI Features &amp; Services</h4>
                                        <div class="nk-block-des">
                                            <p>Choose the right features and solutions to manage your finances and investments.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Choose Your Features &amp; Services</h6>
                                    </div>            
                                    <!-- Personal Budgeting Tool data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-35"><strong>Personal Budgeting Tool</strong></span>
                                            <span class="data-value w-50" id="pbt"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- Wallet Integration data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_wi">
                                            <span class="data-label w-35"><strong>Wallet Integration</strong></span>
                                            <span class="data-value w-50" id="wi"><?php echo $account_informationStatus; ?></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- Balance Updates data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_bu">
                                            <span class="data-label w-35"><strong>Balance Updates</strong></span>
                                            <span class="data-value w-50" id="bu">5 MyMIG / Month</span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- Investments data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_investments">
                                            <span class="data-label w-35"><strong>Investments</strong></span>
                                            <span class="data-value w-50" id="investments">1.36 MyMIG / Account + 1 Monthly Update (0.36 MyMIG per Update)</span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- All-In-One Dashboard data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_dashboard">
                                            <span class="data-label w-35"><strong>All-In-One Dashboard</strong></span>
                                            <span class="data-value w-50" id="dashboard">20 MyMIG / Month</span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- Liabilities data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_liabilities">
                                            <span class="data-label w-35"><strong>Liabilities</strong></span>
                                            <span class="data-value w-50" id="liabilities">0.6 MyMI Gold / Account per Month</span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>

                                    <!-- Transactions data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_transactions">
                                            <span class="data-label w-35"><strong>Transactions</strong></span>
                                            <span class="data-value w-50" id="transactions">1 MyMIG / Month</span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="banking-summary" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Banking Summary</h4>
                                        <div class="nk-block-des">
                                            <p>Connect your financial banking and checking accounts to determine your Cash-on-Hand/Liquid Assets.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Connect Your Banking Accounts</h6>
                                    </div>            
                                    <?php 
                                    // print_r($userWallets['getUserWallets']['getUserBankingWallets']->result_array()); 
                                    if (!empty($userWallets['getUserWallets']['getUserBankingWallets']->result_array())) {
                                    foreach($userWallets['getUserWallets']['getUserBankingWallets']->result_array() as $bankingWallets) {
                                        echo '
                                        <!-- Personal Budgeting Tool data-item -->
                                        <div class="data-item border-bottom">
                                            <div class="data-col" id="col_pbt">
                                                <span class="data-label w-35"><strong>' . $bankingWallets['id'] . '</strong></span>                                                <span class="data-label w-35"><strong>' . $bankingWallets['bank_name'] . '</strong></span>
                                                <span class="data-label w-35"><strong>' . $bankingWallets['nickname'] . '</strong></span>
                                                <span class="data-label w-35"><strong>$' . $bankingWallets['balance'] . '</strong></span>
                                            </div>
                                            <div class="data-col data-col-end w-25">
                                                <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                } else {
                                    echo '
                                    <!-- Personal Budgeting Tool data-item -->
                                    <div class="data-item border-bottom">
                                        <div class="data-col" id="col_pbt">
                                            <span class="data-label w-35"><strong>-- Accounts Not Added --</strong></span>
                                        </div>
                                        <div class="data-col data-col-end w-25">
                                            <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Account!</span> </a>
                                        </div>
                                    </div>
                                    ';
                                }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="banking-wallets" class="tab-pane fade">
                        Banking Wallets
                        </div>
                        <div id="last-banking-update" class="tab-pane fade">
                        Banking Updates
                        </div>
                        <div id="banking-integration" class="tab-pane fade">
                        Banking Integrations
                        </div>
                        <div id="credit-summary" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Credit Summary</h4>
                                        <div class="nk-block-des">
                                            <p>Connect your financial banking and checking accounts to determine your Cash-on-Hand/Liquid Assets.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Connect Your Credit Accounts</h6>
                                    </div>            
                                    <?php 
                                    // /print_r($userWallets['getUserWallets']['getUserCreditWallets']->result_array());
                                    if (!empty($userWallets['getUserWallets']['getUserCreditWallets']->result_array())) {
                                        foreach($userWallets['getUserWallets']['getUserCreditWallets']->result_array() as $creditWallets) {
                                            echo '
                                            <!-- Personal Budgeting Tool data-item -->
                                            <div class="data-item border-bottom">
                                                <div class="data-col" id="col_pbt">
                                                    <span class="data-label w-35"><strong>' . $creditWallets['id'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>' . $creditWallets['nickname'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $creditWallets['credit_limit'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $creditWallets['available_balance'] . '</strong></span>
                                                </div>
                                                <div class="data-col data-col-end w-25">
                                                    <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    } else {
                                        echo '
                                        <!-- Personal Budgeting Tool data-item -->
                                        <div class="data-item border-bottom">
                                            <div class="data-col" id="col_pbt">
                                                <span class="data-label w-35"><strong>-- Accounts Not Added --</strong></span>
                                            </div>
                                            <div class="data-col data-col-end w-25">
                                                <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Account!</span> </a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="credit-wallets" class="tab-pane fade">
                        Credit Wallets
                        </div>
                        <div id="last-credit-update" class="tab-pane fade">
                        Last Credit Update
                        </div>
                        <div id="credit-integration" class="tab-pane fade">
                        Credit Integrations
                        </div>
                        <div id="debt-summary" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Debt Summary</h4>
                                        <div class="nk-block-des">
                                            <p>Connect your financial banking and checking accounts to determine your Cash-on-Hand/Liquid Assets.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Connect Your Debt Accounts</h6>
                                    </div>            
                                    <?php 
                                    // print_r($userWallets['getUserWallets']['getUserBankingWallets']->result_array()); 
                                    //print_r($userWallets['getUserWallets']['getUserDebtWallets']->result_array());
                                    if (!empty($userWallets['getUserWallets']['getUserDebtWallets']->result_array())) {
                                        foreach($userWallets['getUserWallets']['getUserDebtWallets']->result_array() as $debtWallets) {
                                            echo '
                                            <!-- Personal Budgeting Tool data-item -->
                                            <div class="data-item border-bottom">
                                                <div class="data-col" id="col_pbt">
                                                    <span class="data-label w-35"><strong>' . $debtWallets['id'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>' . $debtWallets['nickname'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $debtWallets['credit_limit'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $debtWallets['available_balance'] . '</strong></span>
                                                </div>
                                                <div class="data-col data-col-end w-25">
                                                    <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    } else {
                                        echo '
                                        <!-- Personal Budgeting Tool data-item -->
                                        <div class="data-item border-bottom">
                                            <div class="data-col" id="col_pbt">
                                                <span class="data-label w-35"><strong>-- Accounts Not Added --</strong></span>
                                            </div>
                                            <div class="data-col data-col-end w-25">
                                                <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Account!</span> </a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="debt-wallets" class="tab-pane fade">
                        Debt Wallets
                        </div>
                        <div id="last-debt-update" class="tab-pane fade">
                        Last Debt Update
                        </div>
                        <div id="debt-integration" class="tab-pane fade">
                        Debt Integration
                        </div>

                        <?php if ($investmentOperations === 1) { ?>
                        <div id="investment-summary" class="tab-pane fade">
                            <?php //$this->load->view('User/Budget/index/Investor_Assessment/personal_information'); ?>
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Investment Summary</h4>
                                        <div class="nk-block-des">
                                            <p>Connect your financial banking and checking accounts to determine your Cash-on-Hand/Liquid Assets.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Connect Your Investment Accounts</h6>
                                    </div>            
                                    <?php 
                                    //print_r($userWallets['getUserWallets']['getUserInvestmentWallets']->result_array());
                                    if (!empty($userWallets['getUserWallets']['getUserInvestmentWallets']->result_array())) {
                                        foreach($userWallets['getUserWallets']['getUserInvestmentWallets']->result_array() as $debtWallets) {
                                            echo '
                                            <!-- Personal Budgeting Tool data-item -->
                                            <div class="data-item border-bottom">
                                                <div class="data-col" id="col_pbt">
                                                    <span class="data-label w-35"><strong>' . $debtWallets['id'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>' . $debtWallets['nickname'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $debtWallets['amount'] . '</strong></span>
                                                    <span class="data-label w-35"><strong>$' . $debtWallets['net_worth'] . '</strong></span>
                                                </div>
                                                <div class="data-col data-col-end w-25">
                                                    <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Now!</span> </a>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    } else {
                                        echo '
                                        <!-- Personal Budgeting Tool data-item -->
                                        <div class="data-item border-bottom">
                                            <div class="data-col" id="col_pbt">
                                                <span class="data-label w-35"><strong>-- Accounts Not Added --</strong></span>
                                            </div>
                                            <div class="data-col data-col-end w-25">
                                                <a class="btn btn-primary btn-md text-white"><em class="icon ni ni-plus px-2 text-white"></em><span class="ml-2">Add Account!</span> </a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="last-investment-update" class="tab-pane fade">
                        Last Investment Update
                        </div>
                        <div id="brokerage-integration" class="tab-pane fade">
                        Brokerage Integration
                        </div>
                        <div id="financial-goals" class="tab-pane fade">
                        Financial Goals
                        </div>
                        <div id="time-horizon" class="tab-pane fade">
                        Time Horizon
                        </div>
                        <div id="financial-rating" class="tab-pane fade">
                        Financial Rating
                        </div>
                        <div id="investment-experience" class="tab-pane fade">
                        Investment Experience
                        </div>
                        <div id="investment-knowledge" class="tab-pane fade">
                        Investment Knowledge
                        </div>
                        <div id="market-sentiment" class="tab-pane fade">
                        Market Sentiment
                        </div>
                        <div id="investment-availability" class="tab-pane fade">
                        Investment Availability 
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
