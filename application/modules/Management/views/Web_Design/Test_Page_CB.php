<?php
//$this->load->view('Dashboard/includes/dashboard-navbar');
// Page SEO Overview
//$this->load->view('Web_Design/Page_SEO_Overview');
// Change this Link for Testing
$userData['groupID'] = 0;
echo '
<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">';
            $this->load->view('User/User_Posts_Announcement', $userData);
echo '
			</div>
		</div>
	</div>
</div>';
//$this->load->view('Web_Design/Infrastructure_Overview/Information_ToDoList');
//$this->load->view('Dashboard/includes/bottom-additions');
