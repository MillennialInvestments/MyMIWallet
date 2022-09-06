<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$date                           = date("F jS, Y");
$hostTime                       = date("g:i A");
$time                           = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod                  = $this->router->fetch_method();

$errorClass                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass                  = $currentMethod == 'register' ? ' required' : '';
$editSettings                   = $currentMethod == 'edit';
// Current User Information
$cuID 						    = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail					    = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuUsername					    = $_SESSION['allSessionData']['userAccount']['cuUsername'];
$cuUserType					    = $_SESSION['allSessionData']['userAccount']['cuUserType'];
$walletID					    = $_SESSION['allSessionData']['userAccount']['walletID'];
// Set Form Config
$formGroup				        = $this->config->item('form_container');
$formLabel				        = $this->config->item('form_label');
$formConCol				        = $this->config->item('form_control_column');
$formControl			        = $this->config->item('form_control');
$formSelect				        = $this->config->item('form_select');
$formSelectPicker		        = $this->config->item('form_selectpicker');
$formText				        = $this->config->item('form_text');
$formCustomText			        = $this->config->item('form_custom_text');

?>                              
<h4 class="card-title">Account Information</h4>
<p class="card-description"> Please fill out the information below</p>			
<hr>
<?php
if ($cuUserType === 'Beta') {
    ?>
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">	
<input type="hidden" class="form-control" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
<input type="hidden" class="form-control" name="account_type" id="account_type" value="<?php echo set_value('account_type', isset($user) ? $user->type : $accountType); ?>">

<div class="<?php echo $formGroup; ?> mb-2">    
	<label for="category" class="<?php echo $formLabel; ?>"><?php echo $accountType; ?> Account Type</label>
	<div class="<?php echo $formConCol; ?>">

        <select name="category" class="<?php echo $formSelectPicker; ?>" id="category" required="required" style="height: 40px; padding: 10px;">
            <option value="N/A">Select-A-Category</option>
            <?php
                $category_values = array(
                    'Webull'   		 		=> 'Webull',
                );
                foreach ($category_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('category')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Account Nickname <span class="text-muted">(Optional)</span></label>    
	<div class="<?php echo $formConCol; ?>">       
		<input type="text" class="<?php echo $formControl; ?>" name="nickname" id="nickname" placeholder="Enter Account Nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label for="interval" class="<?php echo $formLabel; ?>"><?php echo $accountType; ?> Interval</label>
	<div class="<?php echo $formConCol; ?>">

        <select name="interval" class="<?php echo $formSelectPicker; ?>" id="interval" required="required" style="height: 40px; padding: 10px;">
            <option value="N/A">Select-An-Interval</option>
            <?php
                    $interval_values = array(
                        'Daily'   		 		=> 'Daily',
                        'Weekly'   		 		=> 'Weekly',
                        'Bi-Weekly'   		    => 'Bi-Weekly',
                        'Monthly'   		    => 'Monthly',
                        'Quarterly'   		    => 'Quarterly',
                        'Annually'   		    => 'Annually',
                    );
                foreach ($interval_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('interval')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
	</div>
</div>
