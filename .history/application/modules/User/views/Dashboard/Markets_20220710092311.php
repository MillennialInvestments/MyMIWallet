<?php
$pageURIA               = $this->uri->segment(1);
$pageURIB               = $this->uri->segment(2);
$pageURIC               = $this->uri->segment(3);
$pageURID               = $this->uri->segment(4);
$pageURIE               = $this->uri->segment(5);
$marketType             = $pageURIB; 
if ($marketType === 'US-Markets') {
    $marketTitle        = 'US Markets';
    $marketView         = $this->load->view('User/Dashboard/index/US_Market_Overview', $dashboardData); 
} elseif ($marketType === 'Additional-Markets') {
    $marketTitle        = 'Additional US Markets';
    $marketView         = $this->load->view('User/Dashboard/index/US_Additional_Overview', $dashboardData); 
} elseif ($marketType === 'International-Markets') {
    $marketTitle        = 'International Markets';
    $marketView         = $this->load->view('User/Dashboard/index/International_Market_Overview', $dashboardData); 
} elseif ($marketType === 'Crypto-Markets') {
    $marketTitle        = 'Crypto Markets';
    $marketView         = $this->load->view('User/Dashboard/index/Crypto_Market_Overview', $dashboardData); 
} elseif ($marketType === 'MyMI-Markets') {
    $marketTitle        = 'MyMI Markets';
    $marketView         = $this->load->view('User/Dashboard/index/MyMI_Market_Overview', $dashboardData); 
}
$dashboardData          = array(
    'marketTitle'       => $marketTitle,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Dashboard/Markets/header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
            <?php $this-
		</div>
		<div class="col-12 col-md-9">
			<?php $this->load->view('User/Dashboard/index/Announcements'); ?>
		</div>
	</div>
</div>