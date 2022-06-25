<?php
$meta_fields	    = Template::get('meta_fields');
$pageURIA 	 	    = $this->uri->segment(1);
$pageURIB 	 	    = $this->uri->segment(2);
$cuID			    = $pageURIB;
$getUserInfo	    = $this->user_model->get_user_info($cuID);
foreach ($getUserInfo->result_array() as $userInfo) {
    $cuEmail	    = $userInfo['email'];
    $cuUsername	    = $userInfo['username'];
}
$currentMethod      = $this->router->method;
$errorClass         = empty($errorClass) ? ' error' : $errorClass;
$registerClass      = $currentMethod == 'register' ? ' required' : '';
$editSettings       = $currentMethod == 'edit';
$defaultLanguage    = isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone    = isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
// Input Field Settings
?>    
<style>
	.form-control {min-height: 40px !important; margin-top: 0px !important; background-color: #ededed !important;}
</style>
<input type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" />
<input type="hidden" id="user_email" name="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>" />
<input type="hidden" id="user_username" name="user_username" value="<?php echo set_value('user_username', isset($user) ? $user->user_username : $cuUsername); ?>" />
<input type="hidden" id="realize_id" name="realize_id" value="<?php echo set_value('realize_id', isset($user) ? $user->realize_id : $realizeID); ?>" />
<div class="row">
	<div class="col-12 col-md-3">
		<div class="<?php e($controlGroup); ?> <?php echo form_error('id') ? $errorClass : ''; ?>">
			<label class="<?php e($controlLabel); ?>" for="first_name">First Name</label>
			<div class="<?php e($controlClass); ?>">
				<input class="<?php echo $controlInput; ?>" type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : ''); ?>" />
				<span class="help-inline"><?php echo form_error('first_name'); ?></span>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="<?php e($controlGroup); ?> <?php echo form_error('middle_name') ? $errorClass : ''; ?>">
			<label class="<?php e($controlLabel); ?>" for="middle_name">Middle Name <small class="text-muted">(Optional)</small></label>
			<div class="<?php e($controlClass); ?>">
				<input class="<?php echo $controlInput; ?>" type="text" id="middle_name" name="middle_name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : ''); ?>" />
				<span class="help-inline"><?php echo form_error('middle_name'); ?></span>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="<?php e($controlGroup); ?> <?php echo form_error('last_name') ? $errorClass : ''; ?>">
			<label class="<?php e($controlLabel); ?>" for="last_name">Last Name</label>
			<div class="<?php e($controlClass); ?>">
				<input class="<?php echo $controlInput; ?>" type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : ''); ?>" />
				<span class="help-inline"><?php echo form_error('last_name'); ?></span>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="<?php e($controlGroup); ?> <?php echo form_error('name_suffix') ? $errorClass : ''; ?>">
			<label class="<?php e($controlLabel); ?>  required" for="name_suffix">Suffix</label>
			<div class="<?php e($controlClass); ?> ">
				<select name="name_suffix" class="<?php echo $controlInput; ?>" id="name_suffix" required="required" style="height: 40px; padding: 10px;">
					<?php
                        $type_values = array(
                            '.'					=> 'N/A',
                            'Jr.'				=> 'Jr.',
                            'II'				=> 'II',
                            'III'				=> 'III',
                            'IV'				=> 'IV',
                            'V'					=> 'V',
                        );
                        foreach ($type_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('name_suffix')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    ?>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('phone') ? $errorClass : ''; ?>">
	<label class="<?php e($controlLabel); ?> " for="phone">Phone</label>
	<div class="<?php e($controlClass); ?> ">
		<input class="<?php e($controlInput); ?>" type="tel" id="phone" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : ''); ?>" />
		<span class="help-inline"><?php echo form_error('phone'); ?></span>
	</div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('address') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="address">Address</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?>" type="text" id="address" name="address" value="<?php echo set_value('address', isset($user) ? $user->address : ''); ?>" />
        <span class="help-inline"><?php echo form_error('address'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('city') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="city">City</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?>" type="text" id="city" name="city" value="<?php echo set_value('city', isset($user) ? $user->city : ''); ?>" />
        <span class="help-inline"><?php echo form_error('city'); ?></span>
    </div>
</div>
<?php
if (! empty($meta_fields)) :
    $defaultCountry = 'US';
    $defaultState   = 'N/A';
    $countryFieldId = false;
    $stateFieldId   = false;

    $displayFrontend = isset($frontend_only) ? $frontend_only : false;
    $userIsAdmin     = isset($current_user) ? ($current_user->role_id == 1) : false;

    foreach ($meta_fields as $field) :
        $adminField = isset($field['admin_only']) ? $field['admin_only'] : false;
        // If this is an admin field and the user is not an admin, skip it.
        if ($adminField && ! $userIsAdmin) {
            continue;
        }

        // Unlike the other values, assume true if $field['frontend'] is not set.
        $frontField = isset($field['frontend']) ? $field['frontend'] : true;

        // If displaying the front end and this is not a frontend field, skip it.
        if ($displayFrontend && ! $frontField) {
            continue;
        }

        if ($field['form_detail']['type'] == 'dropdown') :
            echo form_dropdown(
                $field['form_detail']['settings'],
                $field['form_detail']['options'],
                set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : ''),
                $field['label']
            );
        elseif ($field['form_detail']['type'] == 'checkbox') :
?>
<div class="<?php e($controlGroup); ?> <?php echo form_error($field['name']) ? ' error' : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>
    <div class="<?php e($controlClass); ?> ">
        <?php
        echo form_checkbox(
    $field['form_detail']['settings'],
    $field['form_detail']['value'],
    $field['form_detail']['value'] == set_value(
                $field['name'],
                isset($user->{$field['name']}) ? $user->{$field['name']} : ''
            )
);
        ?>
    </div>
</div>
<?php
        elseif ($field['form_detail']['type'] == 'state_select'
            && is_callable('state_select')
        ) :
            $stateFieldId = $field['name'];
            $stateValue = isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultState;
?>
<div class="<?php e($controlGroup); ?> <?php echo form_error($field['name']) ? ' error' : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="<?php echo $field['name']; ?>"><?php echo lang('user_meta_state'); ?></label>
    <div class="<?php e($controlClass); ?> ">
        <?php
        echo state_select(
    set_value($field['name'], $stateValue),
    $defaultState,
    $defaultCountry,
    $field['name'],
    'span6 chzn-select form-control full-width'
);
        ?>
    </div>
</div>
<?php
        elseif ($field['form_detail']['type'] == 'country_select'
            && is_callable('country_select')
        ) :
            $countryFieldId = $field['name'];
            $countryValue = isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultCountry;
?>
<div class="<?php e($controlGroup); ?> <?php echo form_error($field['name']) ? ' error' : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="<?php echo $field['name']; ?>"><?php echo lang('user_meta_country'); ?></label>
    <div class="<?php e($controlClass); ?> ">
        <?php
        echo country_select(
    set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : $defaultCountry),
    $defaultCountry,
    $field['name'],
    'span6 chzn-select form-control full-width'
);
        ?>
    </div>
</div>
<?php
        else :
            $form_method = "form_{$field['form_detail']['type']}";
            if (is_callable($form_method)) {
                echo $form_method(
                    $field['form_detail']['settings'],
                    set_value($field['name'], isset($user->{$field['name']}) ? $user->{$field['name']} : ''),
                    $field['label']
                );
            }
        endif;
    endforeach;
    if (! empty($countryFieldId) && ! empty($stateFieldId)) {
        Assets::add_js(
            $this->load->view(
                'country_state_js',
                array(
                    'country_name'  => $countryFieldId,
                    'country_value' => $countryValue,
                    'state_name'    => $stateFieldId,
                    'state_value'   => $stateValue,
                ),
                true
            ),
            'inline'
        );
    }
endif;
?>
<div class="<?php e($controlGroup); ?> <?php echo form_error('zipcode') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Zipcode</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?>" type="text" id="zipcode" name="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : ''); ?>" />
        <span class="help-inline"><?php echo form_error('zipcode'); ?></span>
    </div>
</div>

<div class="<?php e($controlGroup); ?> <?php echo form_error('timezones') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>  required" for="timezones"><?php echo lang('bf_timezone'); ?></label>
    <div class="<?php e($controlClass); ?> ">
        <?php
        echo timezone_menu(
    set_value('timezones', isset($user) ? $user->timezone : $defaultTimezone),
    $controlInput,
    'timezones',
    array('id' => 'timezones')
);
        ?>
        <span class="help-inline"><?php echo form_error('timezones'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('language') ? $errorClass : ''; ?>">
	<label class="<?php e($controlLabel); ?>  required" for="language">Language</label>
	<div class="<?php e($controlClass); ?> ">
		<select name="language" class="<?php echo $controlInput; ?>" id="language" required="required" style="height: 40px; padding: 10px;">
			<?php
                $language_values = array(
                    'English'					=> 'English (Default)',
                    'Arabic'					=> 'Arabic',
                    'Chinese'					=> 'Chinese',
                    'English'					=> 'English',
                    'French'					=> 'French',
                    'German'					=> 'German',
                    'Italian'					=> 'Italian',
                    'Japanese'					=> 'Japanese',
                    'Polish'					=> 'Polish',
                    'Portuguese'				=> 'Portuguese',
                    'Russian'					=> 'Russian',
                    'Spanish'					=> 'Spanish',
                    'Turkisk'					=> 'Turkisk',
                );
                foreach ($language_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('language')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
		</select>
	</div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('advertisement') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="advertisement">How did you hear about us?</label>
    <div class="<?php e($controlClass); ?> ">
		<select name="advertisement" class="form-control" id="advertisement" required="required">
			<option>Select-An-Option</option>
			<?php
                $type_values = array(
                    'Email'				=> 'Email',
                    'Discord'			=> 'Discord',
                    'Facebook'			=> 'Facebook',
                    'Google'			=> 'Google',
                    'StockTwits'		=> 'StockTwits',
                    'Twitter'			=> 'Twitter',
                    'Word-Of-Mouth'		=> 'Word-Of-Mouth',
                );
                foreach ($type_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('advertisement')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
		</select>
    </div>
</div>
<hr>
<h1 class="mbr-section-title mbr-bold mb-1 pb-3 mbr-fonts-style card-title display-7">Generate MyMI Wallet</h1>	    
<div class="<?php e($controlGroup); ?> <?php echo form_error('total') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Click Here To Generate New Wallet Address:</label>
    <div class="<?php e($controlClass); ?> pt-2">
        <a class="btn btn-primary btn-sm text-white" onclick="createWalletAddressDGB()">Generate</a>
    </div>
</div>                                         
<div class="<?php e($controlGroup); ?> <?php echo form_error('private_key') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="private_key">
        Private Key	
    </label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php e($controlInput); ?>" type="text" id="private_key" name="private_key" value="<?php echo set_value('private_key', isset($user) ? $user->private_key : ''); ?>" />
        <p class="help-text">Store Your Private Key somewhere safe and secure.</p>
    </div>
</div>  
<div class="<?php e($controlGroup); ?> <?php echo form_error('public_key') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="public_key">Public Key</label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php e($controlInput); ?>" type="text" id="public_key" name="public_key" value="<?php echo set_value('public_key', isset($user) ? $user->public_key : ''); ?>" />
    </div>
</div>     