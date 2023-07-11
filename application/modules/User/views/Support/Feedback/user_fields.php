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
$thisURL                        = $this->uri->uri_string();
// Current User Information
$cuID 						    = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail					    = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuUsername					    = $_SESSION['allSessionData']['userAccount']['cuUsername'];
$cuUserType					    = $_SESSION['allSessionData']['userAccount']['cuUserType'];
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
<h4 class="card-title">Provide Your Feedback</h4>
<p class="card-description"> Please fill out information below</p>			
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
<input type="hidden" class="form-control" name="comm_type" id="comm_type" value="<?php echo set_value('comm_type', isset($user) ? $user->comm_type : 'Feedback'); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">	
<input type="hidden" class="form-control" name="current_url" id="current_url" value="<?php echo set_value('current_url', isset($user) ? $user->current_url : $thisURL); ?>">	

<div class="<?php echo $formGroup; ?> mb-2">
    <label for="topic" class="<?php echo $formLabel; ?>">Topic</label>
    <div class="<?php echo $formConCol; ?>">
        <?php 
            echo '
            <select name="topic" class="' . $formControl . '" id="topic" required="required">
                <option>Select-An-Option</option>
                ';  							
                        
                $department_type_values = array(
                    'Account'           => 'Account',
                    'Assets'            => 'Assets',
                    'Billing'           => 'Billing',
                    'Development'       => 'Exchange',
                    'Exchange'          => 'Exchange',
                    'Investor'          => 'Investor',
                    'Partner'           => 'Partner',
                    'Security'          => 'Security',
                    'Transaction'       => 'Transaction',
                );
                foreach($department_type_values as $value => $display_text)
                {
                    $selected = ($value == $this->input->post('topic')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                } ;
            echo '</select>';
        ?>						
    </div>
</div>  
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-3 form-label" for="default-01">Provide Your Feedback</label>    
	<div class="col-9">       
		<textarea class="form-control no-resize" name="details" id="details" rows="10" placeholder="Enter Account details" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>	
	</div>
</div>
