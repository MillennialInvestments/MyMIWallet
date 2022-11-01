<?php
//$this->load->view('Dashboard/includes/dashboard-navbar');

// Referral Application Approval Email
$controller = 'Forms/';
$directory = 'Alerts/Emails';
$email = 'Trade_Alert_Promotion';

// Referral Application Approval Email
//~ $controller = 'Referral_Program';
//~ $directory = 'Emails';
//~ $email = 'Affiliate_Approved';

// New Affiliate Application Notification
//~ $controller = 'Referral_Program';
//~ $directory = 'Emails';
//~ $email = 'New_Affiliate_Application';

// Account Not Activated Email
//~ $controller = 'Membership_Management';
//~ $directory = 'Emails';
//~ $email = 'Account_Not_Activated';


$emailLink = $controller . '/' . $directory . '/' . $email;
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
// Page SEO Overview
//$this->load->view('Web_Design/Page_SEO_Overview');
// Change this Link for Testing

$email_message_data = array(
    'user_id'						=> $user_id,
    'email'							=> $email,
    'name'							=> $name,
    'details'						=> $details,
);
$this->load->view($emailLink);
?>
<?php echo form_open('Web_Design/Test_Page_Email', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
	<fieldset>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Email Test Information</h4>
						<p class="card-description"> Please fill out information below</p>				
						<div class="form-group row">
							<label for="symbol" class="col-sm-3 col-form-label">Test Email Link:</label>
							<div class="col-sm-9">        						
								<input type="text" class="form-control" name="emailLink" id="emailLink" placeholder="Enter Test Email Link" value="<?php echo set_value('emailLink', isset($user) ? $user->emailLink : $emailLink); ?>">						
							</div>
						</div>
						<div class="form-group row">
							<div class="form-controls ml-3">
								<input class="btn btn-primary" type="submit" name="register" id="submit" value="Send Test Email" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</fieldset>

	<fieldset>
		<?php
        // Allow modules to render custom fields. No payload is passed
        // since the user has not been created, yet.
        //Events::trigger('render_user_form');
        ?>
		<!-- Start of User Meta -->
		<?php //$this->load->view('users/user_meta', array('frontend_only' => true));?>
		<!-- End of User Meta -->
	</fieldset>
<?php echo form_close(); ?>	
<div class="row mt-5">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a class="btn btn-primary" href="<?php echo site_url('Web-Design/Send-Email/' . $controller . '/' . $directory . '/' . $email); ?>">Send Test</a>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('Web_Design/Test_Page_ToDoList');
?>														
<?php $this->load->view('Dashboard/includes/bottom-additions'); ?>
