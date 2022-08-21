<style>
	textarea {width: 100%;}
	select {width: 100%;}
</style>
<?php /* /users/views/user_fields.php */
$date = date("F j, Y");
date_default_timezone_set('UTC');
$currentMethod = $this->router->fetch_method();

$errorClass    	 	= empty($errorClass) ? ' error' : $errorClass;
$controlClass  	 	= empty($controlClass) ? 'span4' : $controlClass;
$registerClass  	= $currentMethod == 'register' ? ' required' : '';
$editSettings   	= $currentMethod == 'edit';
?>
<?php
$year				= date("Y");
$today				= date("m/d/Y");
$currentUserID 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$refID		 		= $pageURIC;
$this->db->from('bf_users_referral_program');
$this->db->where('id', $refID);
$getUserInfo = $this->db->get();
foreach ($getUserInfo->result_array() as $userInfo) {
    $user_id		= $userInfo['user_id'];
    $referrer_code	= 'MyMI' . $year . '-' . $user_id;
    $active			= 1;
    $signup_date	= $today;
    $user_type		= $userInfo['type'];
    $first_name 	= $userInfo['first_name'];
    $last_name 		= $userInfo['last_name'];
    $email 			= $userInfo['email'];
    $phone 			= $userInfo['phone'];
    $address 		= $userInfo['address'];
    $city 			= $userInfo['city'];
    $state 			= $userInfo['state'];
    $country 		= $userInfo['country'];
    $zipcode 		= $userInfo['zipcode'];
    $paypal 		= $userInfo['paypal'];
}
?>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col">
						<h1 class="text-center">Referral Program Application</h1>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12 col-md-4 pr-3 border-right">
						<h4 class="card-title">Account Information</h4>
						<p class="card-description"> Please fill out information below </p>
						
						<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $user_id); ?>"> 
						<input type="hidden" class="form-control" name="referrer_code" id="referrer_code" value="<?php echo set_value('referrer_code', isset($user) ? $user->referrer_code : $referrer_code); ?>"> 
						<input type="hidden" class="form-control" name="active" id="active" value="<?php echo set_value('active', isset($user) ? $user->active : $active); ?>"> 
						<input type="hidden" class="form-control" name="signup_date" id="signup_date" value="<?php echo set_value('signup_date', isset($user) ? $user->signup_date : $signup_date); ?>"> 
						<input type="hidden" class="form-control" name="user_type" id="user_type" value="<?php echo set_value('user_type', isset($user) ? $user->user_type : $user_type); ?>"> 
						<div class="form-group row">
							<label for="first_name" class="col-sm-3 col-form-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $first_name); ?>">						
							</div>
						</div>     
						<div class="form-group row">
							<label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $last_name); ?>">						
							</div>
						</div>  
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo set_value('email', isset($user) ? $user->email : $email); ?>">						
							</div>
						</div>     
						<div class="form-group row">
							<label for="phone" class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $phone); ?>">						
							</div>
						</div>  
						<div class="form-group row">
							<label for="address" class="col-sm-3 col-form-label">Address</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="<?php echo set_value('address', isset($user) ? $user->address : $address); ?>">						
							</div>
						</div>     
						<div class="form-group row">
							<label for="city" class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city', isset($user) ? $user->city : $city); ?>">						
							</div>
						</div>  
						<div class="form-group row">
							<label for="state" class="col-sm-3 col-form-label">State</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="state" id="state" placeholder="Enter State" value="<?php echo set_value('state', isset($user) ? $user->state : $state); ?>">						
							</div>
						</div>     
						<div class="form-group row">
							<label for="country" class="col-sm-3 col-form-label">Country</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="country" id="country" placeholder="Enter Country" value="<?php echo set_value('country', isset($user) ? $user->country : $country); ?>">						
							</div>
						</div>  
						<div class="form-group row">
							<label for="zipcode" class="col-sm-3 col-form-label">Zipcode</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $zipcode); ?>">						
							</div>
						</div>   
						<h4 class="card-title">Payment Information</h4>
						<p class="card-description"> Please fill out information below </p>
						<div class="form-group row">
							<label for="paypal" class="col-sm-3 col-form-label">PayPal</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="paypal" id="paypal" placeholder="Enter PayPal" value="<?php echo set_value('paypal', isset($user) ? $user->paypal : $paypal); ?>">						
							</div>
						</div>
						<div class="form-group row">
							<label for="basic_code" class="col-sm-3 col-form-label">Basic Client ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="basic_code" id="basic_code" placeholder="Enter Basic Client ID" value="<?php echo set_value('basic_code', isset($user) ? $user->basic_code : $basic_code); ?>">			
							</div>
						</div>   
						<div class="form-group row">
							<label for="premium_code" class="col-sm-3 col-form-label">Premium Client ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="premium_code" id="premium_code" placeholder="Enter Premium Client ID" value="<?php echo set_value('premium_code', isset($user) ? $user->premium_code : $premium_code); ?>">						
							</div>
						</div>
						<div class="form-group row">
							<label for="gold_code" class="col-sm-3 col-form-label">Gold Client ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="gold_code" id="gold_code" placeholder="Enter Premium Client ID" value="<?php echo set_value('gold_code', isset($user) ? $user->gold_code : $gold_code); ?>">						
							</div>
						</div>   
						<div class="form-group row">
							<label for="other_payment" class="col-sm-3 col-form-label">Other Payment Method</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="other_payment" id="other_payment" placeholder="Enter Other Payment Method" value="<?php echo set_value('other_payment', isset($user) ? $user->other_payment : $other_payment); ?>">						
							</div>
						</div>
					</div>
					<div class="col-12 col-md-8">
						<?php $this->load->view('Referral_Program/New_Affiliate_Information/Setup_Procedure'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

