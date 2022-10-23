<?php /* /users/views/user_fields.php */
// Set Date & Time
$date						= date("F jS, Y");
$hostTime 					= date("g:i A");
// Get Page Segments
$pageURIA					= $this->uri->segment(1); 
$pageURIB					= $this->uri->segment(2); 
$pageURIC					= $this->uri->segment(3); 
// Set Group ID		
if ($pageURIA === 'Dashboard') {
	$groupID				= 0;
}
// Get User Type -> Alert Type
$cuID	 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuUsername					= isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$cuType 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
// User Social Media Information
$this->db->from('bf_users_social_media');
$this->db->where('id', $cuID);
$getSocialInfo		= $this->db->get();
foreach ($getSocialInfo->result_array() as $userInfo) {
	if ($userInfo['coverart'] === 'N/A') {
		$coverart 		= 'Blue-Stock-Charts5.jpg';
	} else {
		$coverart		= $userInfo['coverart'];
	}
	if ($userInfo['profile_pic'] !== 'N/A') {
		$profile_pic	= $userInfo['profile_pic'];
	} else {
		$profile_pic	= 'generic-user-purple.png';
	}
}
?>
<style>
	.textarea-modal-btn {border:none;background:none;width:100%;max-width:100%}
	.btn-outline-primary {color: #007bff;border-color: #007bff;}
	.btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {background: #007bff;color: #ffffff;}
</style>
<input type="hidden" class="form-control" name="submitted_date" id="submitted_date" placeholder="Enter Alert Date" value="<?php echo set_value('submitted_date', isset($user) ? $user->submitted_date : $date); ?>">						
<input type="hidden" name="time" id="time" value="<?php echo set_value('time', isset($user) ? $user->time : $hostTime); ?>">							
<input type="hidden" name="post_id" id="post_id" value="<?php echo set_value('post_id', isset($user) ? $user->post_id : $postID); ?>">				
<input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">				
<div id="add-comment-section"></div>
<div class="form-group row pt-4 mb-0">
	<div class="d-none col-sm-1 py-2">
		<label>
			<img src="<?php echo base_url('assets/images/Users/Profile_Pictures/' . $profile_pic); ?>" class="rounded-circle img-fluid">
		</label>
	</div>
	<div class="col-12 col-sm-11">
		<div class="input-group mb-3">
			<textarea class="form-control mt-1" name="details" id="details" rows="1" placeholder="Leave a comment..." value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>
			<div class="input-group-append mt-1">
				<button class="btn btn-outline-primary" type="submit" name="register" id="submit"><i class="icon-note"></i></button>
			</div>
		</div>
	</div>
</div>
