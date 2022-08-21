<?php
$currentUserID 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$manDashboardID 	= $this->uri->segment(1);

$this->db->from('bf_dashboards');
$this->db->where('dashboard_link', $manDashboardID);
$getDashQuery = $this->db->get();

foreach ($getDashQuery->result_array() as $dashInfo) {
    $dashboard = $dashInfo['dashboard'];
    $link	   = $dashInfo['dashboard_link'];
};

if ($currentUserID === 2) {
    ; ?>

<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Dashboard Information</h2>
				<table class="table table-default">
					<thead>
						<tr>
							<th>Dashboard</th>
							<th>URL</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $dashboard; ?></td>
							<td><a href="<?php echo site_url('/') . $link; ?>"><?php echo $link; ?></a></td>
							<td><a href="<?php echo site_url('Dashboard-Management/Dashboard-Overview/') . $manDashboardID; ?>" target="_blank"><i class="icon-wrench"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
} else {
        return;
    };
?>
