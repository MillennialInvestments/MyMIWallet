<?php
// Set Date & Time
$date						            = date("F jS, Y");
$hostTime 					            = date("g:i A");
// Get Page Segments
$pageURIA								= $this->uri->segment(1);
$pageURIB								= $this->uri->segment(2);
$pageURIC								= $this->uri->segment(3);
// Set Group ID
$groupID				                = $pageURIC;
$redirectURL            			    = $this->uri->uri_string();
// Get User Type -> Alert Type
$userAccount                            = $_SESSION['allSessionData']['userAccount'];
$cuID	 					            = $userAccount['cuID'];
$cuEmail	 					        = $userAccount['cuEmail'];
$cuUsername	 					        = $userAccount['cuUsername'];
$cuUserType	 					        = $userAccount['cuUserType'];
$cuFirstName                            = $userAccount['cuFirstName'];
$cuMiddleName                           = $userAccount['cuMiddleName'];
$cuLastName                             = $userAccount['cuLastName'];
$cuNameSuffix                           = $userAccount['cuNameSuffix'];
$cuPhone                                = $userAccount['cuPhone'];
$cuAddress	 					        = $userAccount['cuAddress'];
$cuCity                                 = $userAccount['cuCity'];
$cuState                                = $userAccount['cuState'];
$cuCountry                              = $userAccount['cuCountry'];
$cuZipcode                              = $userAccount['cuZipCode'];
$cuPartner                              = $userAccount['cuPartner']; 
$cuReferrer                             = $userAccount['cuReferrer']; 
$cuSignupDate                           = $userAccount['cuSignupDate']; 
$cuCoverart                             = $userAccount['cuCoverart']; 
$cuProfilePic                           = $userAccount['cuProfilePic']; 

$userData                               = array(
    'date'                              => $date,
    'hostTime'                          => $hostTime,
    'pageURIA'                          => $pageURIA,
    'pageURIB'                          => $pageURIB,
    'pageURIC'                          => $pageURIC,
    'groupID'                           => $pageURIC,
    'redirectURL'                       => $redirectURL,
    'cuID'                              => $cuID,
    'cuEmail'                           => $cuEmail,
    'cuDisplayName'                     => $cuFirstName . ' ' . $cuLastName[0] . '.',
    'cuUsername'                        => $cuUsername,
    'cuUserType'                        => $cuUserType,
    'cuPhone'                           => $cuPhone,
    'cuAddress'                         => $cuAddress,
    'cuCity'                            => $cuCity,
    'cuState'                           => $cuState,
    'cuCountry'                         => $cuCountry,
    'cuZipcode'                         => $cuZipcode,
    'cuPartner'                         => $cuPartner,
    'cuReferrer'                        => $cuReferrer,
    'cuCoverart'                        => $cuCoverart,
    'cuProfilePic'                      => $cuProfilePic,
);
// User Contact Information
// print_r($userData); 
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
                        $this->load->view('User/Post/Add_Post', $userData);
                        $this->load->view('User/Post/User_Posts_Overview', $userData);
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
