<?php
$pageURIA               = $this->uri->segment(1);
$pageURIA               = $this->uri->segment(1);
$pageURIA               = $this->uri->segment(1);
$pageURIA               = $this->uri->segment(1);
$pageURIA               = $this->uri->segment(1);
$dashboardData          = array(

);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Dashboard/Markets/header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php $this->load->view('User/Dashboard/index/financial_overview', $dashboardData); ?>
			<?php
            if (!empty($assetNetValue)) {
                $this->load->view('User/Dashboard/index/asset_overview', $dashboardData);
            }
            ?>
		</div>
		<div class="col-12 col-md-9">
			<?php $this->load->view('User/Dashboard/index/Announcements'); ?>
		</div>
	</div>
</div>