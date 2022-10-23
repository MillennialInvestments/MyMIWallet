<style>
	textarea {width: 100%;}
	select {width: 100%;}
</style>
<?php /* /users/views/user_fields.php */
$cuID 						= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuRoleID 					= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$cuEmail					= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuDisplayName 				= isset($current_user->display_name) && ! empty($current_user->display_name) ? $current_user->display_name : '';
$cuType 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';

$date = date("F j, Y");
date_default_timezone_set('UTC');
$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';
?>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Service Request Information</h4>
				<p class="card-description"> Please fill out information below </p>
				<?php
                if ($cuID === null) {
                    ?>  
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label">First/Last Name</label>
					<div class="col-sm-9">
						<input type="name" class="form-control" name="name" id="name" placeholder="Enter Your First/Last Name" value="<?php echo set_value('name', isset($user) ? $user->name : ''); ?>">						
					</div>
				</div> 
				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>">						
					</div>
				</div> 
				<?php
                } elseif ($cuID !== null) {
                    ?>   
				<input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="Enter Your First/Last Name" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">
				<input type="hidden" class="form-control" name="name" id="name" placeholder="Enter Your First/Last Name" value="<?php echo set_value('name', isset($user) ? $user->name : $cuDisplayName); ?>">
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label">First/Last Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter Your First/Last Name" value="<?php echo set_value('name', isset($user) ? $user->name : $cuDisplayName); ?>">						
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">						
					</div>
				</div> 
				<?php
                }
                ?>    
				<div class="form-group row">
					<label for="details" class="col-sm-3 col-form-label">Problem/Issue</label>
					<div class="col-sm-9">
						<textarea type="text" class="form-control" name="details" id="details" rows="5" placeholder="Enter Details Regarding Your Issue" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>						
					</div>
				</div>  
			</div>
		</div>
	</div>
</div>

