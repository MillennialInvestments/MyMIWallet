<style>
	textarea {width: 100%;}
	select {width: 100%;}
</style>
<?php /* /users/views/user_fields.php */
$date                   = date("F j, Y");
date_default_timezone_set('UTC');
$currentMethod          = $this->router->fetch_method();

$errorClass    	 	    = empty($errorClass) ? ' error' : $errorClass;
$controlClass  	 	    = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  	    = $currentMethod == 'register' ? ' required' : '';
$editSettings   	    = $currentMethod == 'edit';
?>
<?php
$year				    = date("Y");
$today				    = date("m/d/Y");
$userAccount            = $_SESSION['allSessionData']['userAccount'];
$cuID 				    = $userAccount['cuID'];
$cuUserType			    = $userAccount['cuUserType'];
$cuEmail			    = $userAccount['cuEmail'];
$cuFirstName		    = $userAccount['cuFirstName'];
$cuLastName      	    = $userAccount['cuLastName'];
$cuPhone			    = $userAccount['cuPhone'];
$cuAddress			    = $userAccount['cuAddress'];
$cuCity				    = $userAccount['cuCity'];
$cuState			    = $userAccount['cuState'];
$cuCountry			    = $userAccount['cuCountry'];
$cuZipCode			    = $userAccount['cuZipCode'];
$cuWalletID			    = $userAccount['cuWalletID'];
// Add PayPal to All Session Data
$paypal                 = '';
// Referral Program Parameters
$referrer_code	        = 'MyMI' . $year . '-' . $cuID;
$active			        = 1;
$signup_date	        = $today;
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
<h4 class="card-title">Account Information</h4>
<p class="card-description"> Please fill out information below </p>
<input type="hidden" class="<?php echo $formControl; ?>" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>"> 
<input type="hidden" class="<?php echo $formControl; ?>" name="referrer_code" id="referrer_code" value="<?php echo set_value('referrer_code', isset($user) ? $user->referrer_code : $referrer_code); ?>"> 
<input type="hidden" class="<?php echo $formControl; ?>" name="active" id="active" value="<?php echo set_value('active', isset($user) ? $user->active : $active); ?>"> 
<input type="hidden" class="<?php echo $formControl; ?>" name="signup_date" id="signup_date" value="<?php echo set_value('signup_date', isset($user) ? $user->signup_date : $signup_date); ?>"> 
<input type="hidden" class="<?php echo $formControl; ?>" name="user_type" id="user_type" value="<?php echo set_value('user_type', isset($user) ? $user->user_type : $cuUserType); ?>"> 
<div class="<?php echo $formGroup; ?>">
	<label for="first_name" class="<?php echo $formLabel; ?>">First Name</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="first_name" id="first_name" placeholder="Enter First Name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">						
	</div>
</div>     
<div class="<?php echo $formGroup; ?>">
	<label for="last_name" class="<?php echo $formLabel; ?>">Last Name</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="last_name" id="last_name" placeholder="Enter Last Name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">						
	</div>
</div>  
<div class="<?php echo $formGroup; ?>">
	<label for="email" class="<?php echo $formLabel; ?>">Email</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="email" id="email" placeholder="Enter Email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">						
	</div>
</div>     
<div class="<?php echo $formGroup; ?>">
	<label for="phone" class="<?php echo $formLabel; ?>">Phone</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">						
	</div>
</div>  
<div class="<?php echo $formGroup; ?>">
	<label for="address" class="<?php echo $formLabel; ?>">Address</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="address" id="address" placeholder="Enter Address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">						
	</div>
</div>     
<div class="<?php echo $formGroup; ?>">
	<label for="city" class="<?php echo $formLabel; ?>">City</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">						
	</div>
</div>  
<div class="<?php echo $formGroup; ?>">
	<label for="state" class="<?php echo $formLabel; ?>">State</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="state" id="state" placeholder="Enter State" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">						
	</div>
</div>     
<div class="<?php echo $formGroup; ?>">
	<label for="country" class="<?php echo $formLabel; ?>">Country</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="country" id="country" placeholder="Enter Country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">						
	</div>
</div>  
<div class="<?php echo $formGroup; ?>">
	<label for="zipcode" class="<?php echo $formLabel; ?>">Zipcode</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="zipcode" id="zipcode" placeholder="Enter Zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">						
	</div>
</div>   
<h4 class="card-title">Payment Information</h4>
<p class="card-description"> Please fill out information below </p>
<div class="<?php echo $formGroup; ?>">
	<label for="wallet_id" class="<?php echo $formLabel; ?>">Wallet Address</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="wallet_id" id="wallet_id" placeholder="Enter Wallet Address" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>">						
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label for="paypal" class="<?php echo $formLabel; ?>">PayPal</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="paypal" id="paypal" placeholder="Enter PayPal Email" value="<?php echo set_value('paypal', isset($user) ? $user->paypal : $paypal); ?>">						
	</div>
</div>
<?php
/*
<div class="<?php echo $formGroup; ?>">
    <label for="google_pay" class="<?php echo $formLabel; ?>">Google Pay</label>
    <div class="<?php echo $formConCol; ?>">
        <input type="text" class="<?php echo $formControl; ?>" name="google_pay" id="google_pay" placeholder="Enter Google Pay" value="<?php echo set_value('google_pay', isset($user) ? $user->google_pay : $google_pay); ?>">
    </div>
</div>
<div class="<?php echo $formGroup; ?>">
    <label for="cash_app" class="<?php echo $formLabel; ?>">Cash App</label>
    <div class="<?php echo $formConCol; ?>">
        <input type="text" class="<?php echo $formControl; ?>" name="cash_app" id="cash_app" placeholder="Enter Cash App" value="<?php echo set_value('cash_app', isset($user) ? $user->cash_app : $cash_app); ?>">
    </div>
</div>
<div class="<?php echo $formGroup; ?>">
    <label for="venmo" class="<?php echo $formLabel; ?>">Venmo</label>
    <div class="<?php echo $formConCol; ?>">
        <input type="text" class="<?php echo $formControl; ?>" name="venmo" id="venmo" placeholder="Enter Venmo" value="<?php echo set_value('venmo', isset($user) ? $user->venmo : $venmo); ?>">
    </div>
</div>
*/
?>
<div class="<?php echo $formGroup; ?>">
	<label for="other_payment" class="<?php echo $formLabel; ?>">Other Payment Method</label>
	<div class="<?php echo $formConCol; ?>">
		<input type="text" class="<?php echo $formControl; ?>" name="other_payment" id="other_payment" placeholder="Enter Other Payment Method" value="<?php echo set_value('other_payment', isset($user) ? $user->other_payment : ''); ?>">						
	</div>
</div>
					
