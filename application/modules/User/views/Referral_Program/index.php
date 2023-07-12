<style>
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
		color: #195d64;
		background-color: white;
	}
</style>
<?php
//$this->load->view('includes/dashboard-navbar');
?>
<?php
?>
<div class="row quick-action-toolbar">
	<div class="col-md-12 grid-margin">
		<div class="card">
			<div class="card-header d-block d-md-flex">
				<h5 class="mb-0"><?php echo $dashName . ' - Navigation'; ?></h5>
				<p class="ml-auto mb-0">Task Quick Links<i class="icon-bulb"></i></p>
			</div>
			<ul class="nav nav-pills d-md-flex row m-0 quick-action-btns" style="border-bottom:1px solid grey;" role="group" aria-label="Quick action buttons">
				<li class="nav-item col-sm-6 col-md-3 p-3 text-center btn-wrapper">
					<a class="nav-link btn px-0" data-toggle="pill" href="#' . $inDashNavbar['subpage_link'] . '"><i class="' . $inDashNavbar['subpage_icon'] . ' mr-2"></i> ' . $inDashNavbar['subpage_name'] . '</a>
				</li>
			</ul>
			<div class="tab-content full-width">
				<div class="tab-pane " id="">';
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('Dashboard/includes/bottom-additions');
?>
