<?php
$pageURIA                       = $this->uri->segment(1);
$pageURIB                       = $this->uri->segment(2);
$pageURIC                       = $this->uri->segment(3);
$pageURID                       = $this->uri->segment(4);
$pageURIE                       = $this->uri->segment(5);
$marketType                     = $pageURIB; 
$date						    = date("m/d/Y");
if ($marketType === 'US-Markets') {
    $marketTitle                = 'US Financial Markets';
    $marketView                 = 'User/Dashboard/index/US_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'US Financial Market Overview'; 
} elseif ($marketType === 'US-Additional-Markets') {
    $marketTitle                = 'Additional US Markets';
    $marketView                 = 'User/Dashboard/index/US_Additional_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'Additional US Financial Market Overview'; 
} elseif ($marketType === 'International-Markets') {
    $marketTitle                = 'International Markets';
    $marketView                 = 'User/Dashboard/index/International_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'International Financial Market Overview'; 
} elseif ($marketType === 'Crypto-Markets') {
    $marketTitle                = 'Crypto Markets';
    $marketView                 = 'User/Dashboard/index/Crypto_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Content_Coming_Soon';
    $marketOverviewTitle        = 'Crypto Financial Market Overview'; 
} elseif ($marketType === 'MyMI-Markets') {
    $marketTitle                = 'MyMI Markets';
    $marketView                 = 'User/Dashboard/index/MyMI_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Content_Coming_Soon';
    $marketOverviewTitle        = 'MyMI Financial Market Overview'; 
}
$dashboardData          = array(
    'marketType'        => $marketType,
    'marketTitle'       => $marketTitle,
    'marketOverview'    => $marketOverview,
    'overviewTitle'     => $marketOverviewTitle,
    'date'              => $date,
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
    <hr>
    <div class="row gy-gs">
        <div class="col-md-12 mb-3">
            <?php $this->load->view($marketOverview, $dashboardData); ?>
        </div>
    </div>
</div>