<style>
	.dropleft .dropdown-toggle::before {content:none;}
	.img-round{min-height:50px;}
</style>
<?php 
// Set Current UserID
date_default_timezone_set('America/Chicago');
$cuUserID 										= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$yesterday										= date("n/j/y", time() - 60 * 60 * 24);
$date 											= date("F jS, Y");
$hostTime 										= date("g:i A");
$groupID										= $this->uri->segment(3);
$getPosts 										= $this->investor_model->get_user_posts($groupID); 
foreach ($getPosts->result_array() as $posts) {
	$postID										= $posts['id'];
	$postDate									= $posts['submitted_date'];
	$postTime									= $posts['time'];
	$userID										= $posts['user_id'];
	$details									= $posts['details'];
	$postVideoLink								= $posts['video_link'];
	
	if (isset($postVideoLink)) {
		$string     							= $postVideoLink;
		$search     							= '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
		$replace    							= "youtube.com/embed/$1";    
		$url 									= preg_replace($search,$replace,$string);
		$postContent	= '
		<div class="col px-0">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="' . $url . '" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		';
	} else {
		$postContent	= '
		<div class="col pl-4">
			<p class="card-text" style="white-space: pre-line">' . $details . '</p>
		</div>
		';
	}
	// Get Post Likes
	$getPostLikes								= $this->investor_model->get_post_likes($postID);
	$getUserInfo 								= $this->investor_model->get_user_info($userID); 
	foreach ($getUserInfo->result_array() as $userInfo) {
		$displayName							= $userInfo['display_name'];
		$memberType								= $userInfo['type'];	
		$memberID								= $userInfo['id'];	
		$memberEmail							= $userInfo['email'];	
		// Set Comment Post Member ID Data
		$followData['date']						= $date;
		$followData['hostTime']					= $hostTime;
		$followData['member_id']				= $userInfo['id'];
		$followData['cuID']						= $cuUserID;
		$followData['redirectURL']				= $redirectURL;
		$likeData['date']						= $date;
		$likeData['hostTime']					= $hostTime;
		$likeData['like_post_id']				= $postID;
		$likeDate['cache']						= $cache;
		$getSocialInfo 							= $this->investor_model->get_user_social_media($memberEmail); 
		foreach ($getSocialInfo->result_array() as $social) {
			 $profile_pic						= $social['profile_pic']; 
		} 
		// $getPostLikes							= 
		// User Post
		echo'
		<div clas="container-fluid border-dark" style="border-bottom: none;">
			<div class="row pt-4"> 
				<div class="col-2 col-sm-1 pl-4">
					<label style="max-width:50px;">
						<a href="' . site_url('/Profile/' . $memberID) . '"><img src="' . base_url('assets/images/Users/Profile_Pictures/' . $profile_pic) . '" class="img-round rounded-circle img-fluid"></a>
					</label>
				</div>
				<div class="col-10 col-sm-11">
					<h5 class="card-title mb-0">
						<span class="float-left"><a href="' . site_url('/Profile/' . $memberID) . '">' . $displayName . '</a> <small class="text-muted">' . $memberType . ' ' . $cache . '</small></span>';
						/*
						<div class="btn-group float-right dropleft">
						* <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="icon-options"></i>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
							
						</div>*/
						echo '
					</h5>
					<br>
					<p class="text-muted" style="font-weight: 500;">' . $postDate . ' - ' . $postTime . '</p>
				</div>
			</div>
			<div class="row">
				' . $postContent . '
			</div>
			<!--
			<div class="row">
				<div class="col-1"></div>
				<div class="col">
					<p class="text-muted mb-0">85 Likes</p>
				</div>
			</div>
			-->
			<div class="row justify-content-center mt-3 mx-0 border-top border-bottom">
				<div class="col-4 col-sm-4 pr-0">';
					$this->load->view('Forms/User/Likes', $likeData); 
				echo '
				</div>
				<div class="col-4 col-sm-4 px-0">';
					$getFollowStatus 						= $this->investor_model->get_follower_status($memberID, $cuUserID); 
					foreach ($getFollowStatus->result_array() as $follStat) {
						$followStatusID						= $follStat['id'];
					}
					if ($followStatusID !== NULL) {						
						echo '
						<a class="btn btn-secondary btn-block d-none d-sm-block" style="border:none;color:#212529 !important;"  href="' . site_url('/Profile/' . $member_id) . '">
							<i class="icon-user mr-2"></i><span style="color: #343a40">Profile</span>
						</a>
						<a class="btn btn-secondary btn-block d-block d-sm-none" style="border:none;color:#212529 !important;"  href="' . site_url('/Profile/' . $member_id) . '">
							<i class="icon-user mr-2"></i><span style="color: #343a40">Profile</span>
						</a>
						';
					} else {
						$this->load->view('Forms/User/Follow', $followData); 
					}
				echo '
				</div>
				<div class="col-4 col-sm-4 pl-0">              
					<a class="btn btn-secondary btn-block d-none d-sm-block" href="#add-comment-section">
						<i class="icon-note"></i>
						<span>Comment</span>
					</a>
					<a class="btn btn-secondary btn-block d-block d-sm-none" href="#add-comment-section">
						<i class="icon-note"></i>
					</a>
				</div>
			</div>
			';
			// Set Comment Post ID Data
			$postData['postID']				= $postID;
			// Get Last User Comment & Set User ID
			$getLastComment						= $this->investor_model->get_last_comment($postID); 
			foreach ($getLastComment->result_array() as $comment) {
				//Set User ID
				$commentID									= $comment['id'];
				$commentUserID								= $comment['user_id'];
				$commentDetails								= $comment['details']; 
				// Get Comment User Info
				$getCommentUser					= $this->investor_model->get_last_comment_user_info($commentUserID); 
				foreach ($getCommentUser->result_array() as $comUser) {
					$comDisplayName							= $comUser['display_name'];
					$comEmail								= $comUser['email'];
				}
				//Get Comment User Social
				$getComUserSoc					= $this->investor_model->get_user_social_media($comEmail);
				foreach ($getComUserSoc->result_array() as $comUserSoc) {
					$comUserProPic							= $comUserSoc['profile_pic'];
				}
				// Set Comment Likes Data
				$comLikeData['redirect_url']				= $this->uri->uri_string();
				$comLikeData['like_comment_id']				= $commentID;
				$comLikeData['cache']						= $cache;
				echo '
				<div class="row pt-3 px-3">
					<div class="col-1">
						<label style="max-width:50px;">
							<img src="' . base_url('assets/images/Users/Profile_Pictures/' . $comUserProPic) . '" class="img-round rounded-circle img-fluid">
						</label>
					</div>	
					<div class="col">
						<p class="card-text">' . $commentDetails . '</p>
					</div>			
				</div>
				<!--
				<div class="row">
					<div class="col-1"></div>
					<div class="col">
						<p class="text-muted mb-0">85 Likes</p>
					</div>
				</div>
				-->
				<div class="row mt-0">
					<div class="col-3 px-0">';
						$this->load->view('Forms/User/Comment_Likes', $comLikeData); 
					echo '
					</div>
				</div>
				';
			}
		
		?>
		<?php
		// Get User Comment & Set User ID
		$getAddComments							= $this->investor_model->get_remaining_user_comments($postID);
		foreach ($getAddComments->result_array() as $checkAddComment) {
			$getAddCommentID			= $checkAddComment['id'];
		}
		if ($getAddCommentID !== NULL) {
		?>
			<div class="tab-content">
				<div id="home" class="tab-pane in active">
					<div class="row justify-content-center">		
						<div class="col-10">
							<ul style="list-style: none;">
								<li class="active"><a data-toggle="pill" href="#menu1">View More Comments..</a></li>
							</ul>
							<hr>
						</div>
					</div>	
				</div>
				<div id="menu1" class="tab-pane border-top pt-3 fade">
				<?php
					foreach ($getAddComments->result_array() as $comment) {
						//Set User ID
						$commentID				= $comment['id'];
						$commentUserID			= $comment['user_id'];
						$commentDetails			= $comment['details']; 
						$getCommentUser			= $this->investor_model->get_last_comment_user_info($commentUserID);
						foreach ($getCommentUser->result_array() as $comUser) {
							$comDisplayName		= $comUser['display_name'];
							$comEmail			= $comUser['email'];
						}
						//Get Comment User Social
						$getComUserSoc			= $this->investor_model->get_user_social_media($comEmail);
						foreach ($getComUserSoc->result_array() as $comUserSoc) {
							$comUserProPic		= $comUserSoc['profile_pic'];
						}
						// Set Comment Likes Data
						$comLikeData['like_comment_id']			= $commentID;
						echo '
						<div class="row pt-3 px-3">
							<div class="col-1">
								<label style="max-width:50px;">
									<img src="' . base_url('assets/images/Users/Profile_Pictures/' . $comUserProPic) . '" class="img-round rounded-circle img-fluid">
								</label>
							</div>	
							<div class="col">
								<p class="card-text">' . $commentDetails . '</p>
							</div>			
						</div>
						<!--
						<div class="row">
							<div class="col-1"></div>
							<div class="col">
								<p class="text-muted mb-0">85 Likes</p>
							</div>
						</div>
						-->
						<div class="row mt-0">
							<div class="col-3 px-0">';
								$this->load->view('Forms/User/Comment_Likes', $comLikeData); 
							echo '
							</div>
						</div>
						<hr>
						';
					}
				?>   			
					<ul style="list-style: none;">
						<li class="active"><a data-toggle="pill" href="#home">Hide Comments..</a></li>
					</ul>
					<hr>
				</div>
			</div>
		<?php
			}
		}
		$this->load->view('Forms/Post/Add_Comment', $postData);
	echo '
	</div>
	';
}
?>
