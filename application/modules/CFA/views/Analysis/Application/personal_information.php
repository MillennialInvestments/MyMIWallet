<input class="<?php e($controlInput); ?>" type="hidden" id="app_type" name="app_type" value="<?php echo set_value('app_type', isset($user) ? $user->app_type : $appType); ?>" />
<input class="<?php e($controlInput); ?>" type="hidden" id="referral_code" name="referral_code" value="<?php echo set_value('referral_code', isset($user) ? $user->referral_code : $cfaReferralCode); ?>" />
<div class="<?php e($controlGroup); ?> <?php echo form_error('id') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="first_name">First Name</label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : ''); ?>" />
        <span class="help-inline"><?php echo form_error('first_name'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('middle_name') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="middle_name">Middle Name <small class="text-muted">(Optional)</small></label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="middle_name" name="middle_name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : ''); ?>" />
        <span class="help-inline"><?php echo form_error('middle_name'); ?></span>
    </div>
</div>
<div class="<?php e($controlGroup); ?> <?php echo form_error('last_name') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="last_name">Last Name</label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : ''); ?>" />
        <span class="help-inline"><?php echo form_error('last_name'); ?></span>
    </div>
</div>
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
<div class="<?php e($controlGroup); ?> <?php echo form_error('email') ? $errorClass : ''; ?>">
	<label class="<?php e($controlLabel); ?> " for="email">Email</label>
	<div class="<?php e($controlClass); ?> ">
		<input class="<?php e($controlInput); ?>" type="tel" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
		<span class="help-inline"><?php echo form_error('email'); ?></span>
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
    $countryFieldId = true;
    $stateFieldId   = true;

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
        echo '<script>';
        Assets::add_js(
            $this->load->view(
                'CFA/Analysis/Application/country_state_js',
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
        echo '</script>';
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