<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$date                               = date("F jS, Y");
$hostTime                           = date("g:i A");
$time                               = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod                      = $this->router->fetch_method();

$errorClass                         = empty($errorClass) ? ' error' : $errorClass;
$controlClass                       = empty($controlClass) ? 'span4' : $controlClass;
$registerClass                      = $currentMethod == 'register' ? ' required' : '';
$editSettings                       = $currentMethod == 'edit';

// Set Form Config
$formGroup				            = $this->config->item('form_container');
$formLabel				            = $this->config->item('form_label');
$formConCol				            = $this->config->item('form_control_column');
$formControl			            = $this->config->item('form_control');
$formSelect				            = $this->config->item('form_select');
$formSelectPicker		            = $this->config->item('form_selectpicker');
$formText				            = $this->config->item('form_text');
$formCustomText			            = $this->config->item('form_custom_text');

?>                              
<h4 class="card-title">User Feedback: Recommendations & Suggestions</h4>
<p class="card-description"> Please fill out information below &amp; provide your feeback &amp; suggestions</p>			
<hr>
<input type="hidden" class="form-control" name="release_type" id="release_type" value="<?php echo set_value('release_type', isset($user) ? $user->release_type : $releaseType); ?>">	
<input type="hidden" class="form-control" name="release_number" id="release_number" value="<?php echo set_value('release_number', isset($user) ? $user->release_number : $releaseNumber); ?>">	
<?php
if ($this->config->item('beta') === 1) {
    ?>
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<?php
if (!empty($_SESSION['allSessionData']['userAccount'])) {
    // Current User Information
    $cuID 						    = $_SESSION['allSessionData']['userAccount']['cuID'];
    $cuEmail					    = $_SESSION['allSessionData']['userAccount']['cuEmail'];
    $cuFirstName				    = $_SESSION['allSessionData']['userAccount']['cuFirstName'];
    $cuLastName				        = $_SESSION['allSessionData']['userAccount']['cuLastName'];
    $cuUsername					    = $_SESSION['allSessionData']['userAccount']['cuUsername'];
    $cuUserType					    = $_SESSION['allSessionData']['userAccount']['cuUserType'];
} else {
    $cuID 						    = '';
    $cuEmail					    = '';
    $cuFirstName				    = '';
    $cuLastName				        = '';
    $cuUsername					    = '';
    $cuUserType					    = '';
}
?>

<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">		
<input type="hidden" class="form-control" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="<?php echo $formLabel; ?>" for="name">First/Last Name</label>    
	<div class="<?php echo $formConCol; ?>">       
		<input type="text" class="<?php echo $formControl; ?>" name="name" id="name" placeholder="Enter First/Last Name" value="<?php echo set_value('name', isset($user) ? $user->name : $cuFirstName . ' ' . $cuLastName); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="<?php echo $formLabel; ?>" for="email">Email</label>    
	<div class="<?php echo $formConCol; ?>">       
		<input type="text" class="<?php echo $formControl; ?>" name="email" id="email" placeholder="Enter Email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="<?php echo $formLabel; ?>" for="email">Topic of Suggestion</label>    
	<div class="<?php echo $formConCol; ?>">       
		<input type="text" class="<?php echo $formControl; ?>" name="topic" id="topic" placeholder="General Idea of Suggestion" value="<?php echo set_value('topic', isset($user) ? $user->topic : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="<?php echo $formLabel; ?>" for="details">Feedback/Issues/Suggestions</label>    
	<div class="<?php echo $formConCol; ?>">       
		<textarea type="textarea" rows="5" class="<?php echo $formControl; ?>" name="details" id="details" placeholder="Enter Suggestions Details Here" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>	
	</div>
</div>