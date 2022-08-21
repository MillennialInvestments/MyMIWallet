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
$requestID					= $this->uri->segment(3);

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
				<h4 class="card-subtitle">Leave A Comment</h4>
				<p class="card-description"> Please fill out information below </p>
				<input 
				<?php
                if ($cuID === null) {
                    ?>  
				<input type="hidden" class="form-control" name="res_id" id="res_id" value="<?php echo set_value('res_id', isset($user) ? $user->res_id : $requestID); ?>">
				<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">
				<input type="hidden" class="form-control" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">
				<input type="hidden" class="form-control" name="name" id="name" value="<?php echo set_value('name', isset($user) ? $user->name : $cuDisplayName); ?>">
				<div class="form-group row">
					<div class="col-sm-12">
						<textarea type="text" class="form-control" name="details" id="details" rows="5" placeholder="Enter Details Regarding Your Issue" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>						
					</div>
				</div> 
				<?php
                } elseif ($cuID !== null) {
                    ?>   
				<input type="hidden" class="form-control" name="res_id" id="res_id" value="<?php echo set_value('res_id', isset($user) ? $user->res_id : $requestID); ?>">
				<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">
				<input type="hidden" class="form-control" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">
				<input type="hidden" class="form-control" name="name" id="name" value="<?php echo set_value('name', isset($user) ? $user->name : $cuDisplayName); ?>">
				<div class="form-group row">
					<div class="col-sm-12">
						<textarea type="text" class="form-control" name="details" id="details" rows="5" placeholder="Reply to Message" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>						
					</div>
				</div> 
				<?php
                }
                ?>     
			</div>
		</div>
	</div>
</div>

