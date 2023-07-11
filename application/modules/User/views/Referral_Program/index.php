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
<<<<<<< HEAD

=======
$pageURI = $this->uri->segment(1);
$this->db->from('bf_dashboard_navbar_indash');
$this->db->where('url_link', $pageURI);
$this->db->where('navbar', 'Yes');
$getInDashNavbar = $this->db->get();

$this->db->from('bf_dashboard_navbar_indash');
$this->db->where('url_link', $pageURI);
$getInDashNavbarContent = $this->db->get();

$this->db->from('bf_dashboards');
$this->db->where('dashboard_link', $pageURI);
$getDashQuery = $this->db->get();

foreach ($getDashQuery->result_array() as $dashInfo) {
    $dashName = $dashInfo['dashboard'];
}
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
?>
<div class="row quick-action-toolbar">
	<div class="col-md-12 grid-margin">
		<div class="card">
			<div class="card-header d-block d-md-flex">
				<h5 class="mb-0"><?php echo $dashName . ' - Navigation'; ?></h5>
				<p class="ml-auto mb-0">Task Quick Links<i class="icon-bulb"></i></p>
			</div>
			<ul class="nav nav-pills d-md-flex row m-0 quick-action-btns" style="border-bottom:1px solid grey;" role="group" aria-label="Quick action buttons">
<<<<<<< HEAD
				<li class="nav-item col-sm-6 col-md-3 p-3 text-center btn-wrapper">
					<a class="nav-link btn px-0" data-toggle="pill" href="#' . $inDashNavbar['subpage_link'] . '"><i class="' . $inDashNavbar['subpage_icon'] . ' mr-2"></i> ' . $inDashNavbar['subpage_name'] . '</a>
				</li>
			</ul>
			<div class="tab-content full-width">
				<div class="tab-pane " id="">';
				</div>
=======
			<?php
                foreach ($getInDashNavbar->result_array() as $inDashNavbar) {
                    echo '
				<li class="nav-item col-sm-6 col-md-3 p-3 text-center btn-wrapper">
					<a class="nav-link btn px-0" data-toggle="pill" href="#' . $inDashNavbar['subpage_link'] . '"><i class="' . $inDashNavbar['subpage_icon'] . ' mr-2"></i> ' . $inDashNavbar['subpage_name'] . '</a>
				</li>
				';
                }
            ?>
			</ul>
			<div class="tab-content full-width">
			<?php
                foreach ($getInDashNavbarContent->result_array() as $inDashContent) {
                    $pageLink = $inDashContent['subpage_content'];
                    echo '
				<div class="tab-pane ' . $inDashContent['subpage_status']  . '" id="' . $inDashContent['subpage_link'] . '">';
                    $this->load->view($pageLink);
                    echo'	
				</div>
				';
                }
            ?>
				
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('Dashboard/includes/bottom-additions');
?>
