<?php
// Set Date & Time
$userData['date']						= date("F jS, Y");
$userData['hostTime'] 					= date("g:i A");
// Get Page Segments
$pageURIA								= $this->uri->segment(1);
$pageURIB								= $this->uri->segment(2);
$pageURIC								= $this->uri->segment(3);
// Get Page Segments
$userData['pageURIA']					= $this->uri->segment(1);
$userData['pageURIB']					= $this->uri->segment(2);
$userData['pageURIC']					= $this->uri->segment(3);
// Set Group ID
$userData['groupID']				= $pageURIC;
$userData['redirectURL']			= $this->uri->uri_string();
// Get User Type -> Alert Type
$userData['cuID']	 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$userData['cuRole']	 					= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$cuEmail			 					= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$userData['cuEmail'] 					= $cuEmail;
$userData['cuUsername']					= isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$userData['cuType'] 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
$userData['address'] 					= isset($current_user->address) && ! empty($current_user->address) ? $current_user->address : '';
$getSocialInfo							= $this->investor_model->get_user_social_media($cuEmail);
foreach ($getSocialInfo->result_array() as $userInfo) {
    if ($userInfo['coverart'] === 'N/A') {
        $userData['coverart'] 			= 'Blue-Stock-Charts5.jpg';
    } else {
        $userData['coverart']			= $userInfo['coverart'];
    }
    $userData['profile_pic']		= $userInfo['profile_pic'];
}
// User Contact Information
$getUserInfo							= $this->investor_model->get_user_social_media($cuEmail);
foreach ($getUserInfo->result_array() as $userInfo) {
    $userData['userID']					= $userInfo['id'];
    $userData['signup_date']			= $userInfo['signup_date'];
    $userData['email']					= $userInfo['email'];
    $userData['displayName']			= $userInfo['display_name'];
    $userData['userType']				= $userInfo['type'];
}
?>
<div class="row">
	<div class="col grid-mard stretch-card">
		<div class="card">
			<div class="card-body">
				<?php
                //~ if ($pageURIC === 'Weekly-Option') {
                    //~ echo '<hr>';
                    //~ $this->load->view('Forms/Alerts/includes/Stock_Option_Overview');
                //~ }
                ?> 
				<?php
                // Mobile Version
                if ($this->agent->is_mobile()) {
                    echo '<h4 class="card-title text-center">Daily Trade Discussions</h4>';
                } else {
                    echo '<h1 class="card-title">Daily Trade Discussions</h1>';
                }
                ?>
				<p class="card-description text-center">Join The <?php echo $symbol; ?> Daily Discussions</p>				
				<?php
                    if (!empty($cuEmail)) {
                        $this->load->view('Forms/Post/Add_Post', $userData);
                        $this->load->view('User/User_Posts_Overview', $userData);
                    } else {
                        echo '
						<p class="card-text text-center display-4 border-top border-bottom py-3">
							<a href="">Log In</a> or <a href="">Register Free</a> To Join The Conversation!
						</p>
						';
                    }
                ?>
			</div>
		</div>
	</div>
</div>
