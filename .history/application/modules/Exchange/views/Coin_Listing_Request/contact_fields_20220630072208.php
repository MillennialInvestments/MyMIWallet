<?php /* /users/views/user_fields.php */
$this->load->library('MyMIUser');
date_default_timezone_set('America/Chicago');
$date                   		= date("F jS, Y");
$hostTime               		= date("g:i A");
$time                   		= date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod          		= $this->router->fetch_method();

$errorClass             		= empty($errorClass) ? ' error' : $errorClass;
$controlClass           		= empty($controlClass) ? 'span4' : $controlClass;
$registerClass          		= $currentMethod == 'register' ? ' required' : '';
$editSettings           		= $currentMethod == 'edit';
// Set Form Config
$formGroup						= $this->config->item('form_container');
$formLabel						= $this->config->item('form_label');
$formConCol						= $this->config->item('form_control_column');
$formControl					= $this->config->item('form_control');
$formSelect						= $this->config->item('form_select');
$formSelectPicker				= $this->config->item('form_selectpicker');
$formText						= $this->config->item('form_text');
$formCustomText					= $this->config->item('form_custom_text');
$cuKYC                          = $_SESSION['allSessionData']['userAccount']['cuKYC'];
$cuKYC                          = $_SESSION['allSessionData']['userAccount']['cuKYC'];
$cuFirstName                    = $_SESSION['allSessionData']['userAccount']['cuFirstName'];
$cuMiddleName                   = $_SESSION['allSessionData']['userAccount']['cuMiddleName'];
$cuLastName                     = $_SESSION['allSessionData']['userAccount']['cuLastName'];
$cuNameSuffix                   = $_SESSION['allSessionData']['userAccount']['cuNameSuffix'];
$cuPhone                        = $_SESSION['allSessionData']['userAccount']['cuPhone'];
$cuCompany                      = $_SESSION['allSessionData']['userAccount']['cuCompany'];
$cuAddress                      = $_SESSION['allSessionData']['userAccount']['cuAddress'];
$cuCity                         = $_SESSION['allSessionData']['userAccount']['cuCity'];
$cuState                        = $_SESSION['allSessionData']['userAccount']['cuState'];
$cuCountry                      = $_SESSION['allSessionData']['userAccount']['cuCountry'];
$cuZipCode                      = $_SESSION['allSessionData']['userAccount']['cuZipCode'];
?>
<style>
.table th, .table td {
    font-size: 0.6rem;
    font-weight: bold;
}
</style>
<h4 class="nk-block-subtitle fw-bold">New Asset Information</h4>
<p class="card-description"> Please fill out information below</p>		
<hr>
<input type="hidden" class="form-control" name="kyc" id="kyc" value="<?php echo set_value('kyc', isset($user) ? $user->kyc : $cuKYC); ?>">		
<input type="hidden" class="form-control" name="stage" id="stage" value="<?php echo set_value('stage', isset($user) ? $user->stage : 'Contact'); ?>">		
<input type="hidden" class="form-control" name="partner" id="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : $cuPartner); ?>">		
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">First Name</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="first_name" id="first_name" placeholder="Enter First Name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Middle Name</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Last Name</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="last_name" id="last_name" placeholder="Enter Last Name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Suffix</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="name_suffix" id="name_suffix" placeholder="Enter Suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Phone</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Company <small>(Optional)</small></label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="company_name" id="company_name" placeholder="Enter Company Name" value="<?php echo set_value('company_name', isset($user) ? $user->company_name : $cuCompany); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Address</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="address" id="address" placeholder="Enter Address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">City</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">State</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="state" id="state" placeholder="Enter State'" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Country</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="country" id="country" placeholder="Enter Country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Zipcode</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="zipcode" id="zipcode" placeholder="Enter Zip Code" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> pt-3">
	<div class="col-md-4"></div>
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="col-6 px-1">                   
			</div>
			<div class="col-6 px-1">                   
				<input class="btn btn-primary btn-md" type="submit" name="register" id="appNextOne" value="Submit!" />
			</div>
		</div>
	</div>
</div>
