<?php
$pageURIA               = $this->uri->segment(1);
$pageURIB               = $this->uri->segment(2);
$pageURIC               = $this->uri->segment(3);
$pageURID               = $this->uri->segment(4);
$pageURIE               = $this->uri->segment(5);
$marketType             = $pageURIB; 
if ($marketType === 'US-Markets') {
    $marketTitle        = 'US Markets';
    $marketView         = 'User/Dashboard/index/US_Market_Overview'; 
} elseif ($marketType === 'Additional-Markets') {
    $marketTitle        = 'Additional US Markets';
    $marketView         = 'User/Dashboard/index/US_Additional_Overview'; 
} elseif ($marketType === 'International-Markets') {
    $marketTitle        = 'International Markets';
    $marketView         = 'User/Dashboard/index/International_Market_Overview'; 
} elseif ($marketType === 'Crypto-Markets') {
    $marketTitle        = 'Crypto Markets';
    $marketView         = 'User/Dashboard/index/Crypto_Market_Overview'; 
} elseif ($marketType === 'MyMI-Markets') {
    $marketTitle        = 'MyMI Markets';
    $marketView         = 'User/Dashboard/index/MyMI_Market_Overview'; 
}
$dashboardData          = array(
    ''
    'marketTitle'       => $marketTitle,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Dashboard/Markets/header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
            <?php $this->load->view($marketView, $dashboardData); ?>
		</div>
		<div class="col-12 col-md-9">
			<?php $this->load->view('User/Dashboard/Markets/Announcements', $dashboardData); ?>
		</div>
	</div>
</div>