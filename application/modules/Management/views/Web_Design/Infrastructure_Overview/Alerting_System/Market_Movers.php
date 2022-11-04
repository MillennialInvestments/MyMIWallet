<?php
$currentUserRoleID 	= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$setMarketMoversLink = Template::get('setMarketMoversLink');
?>
<h4>Market Movers</h4>
<br>
Market Movers notify our investors of stocks that are moving within different sessions of the trading periods. Within this process, we use these stock alerts to determine stocks that are moving before Market Open (Pre-Market Movers), we analyze there performance throughout the Open Market Trading Sessions and then we determine how those stocks performed throughout the day.
<ul>
	<li>
		Pre-Market Movers
		<br>
		Scheduled to be conducted and delivered at <strong>7 AM</strong> every business day
	</li>
	<li>
		Market Movers
		<br>
		Scheduled to be conducted and delivered at <strong>12 PM</strong> every business day
	</li>
	<li>
		After-Hour Movers
		<br>
		Scheduled to be conducted and delivered at <strong>5 PM</strong> every business day
	</li>
</ul>
<br>	
<br>	
<?php
if ($currentUserRoleID === 1) {
    $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Targeting/Market_Movers');
}
?>
<br>
To submit a <strong>Market Mover Alert</strong>, simply click the link below.
<br>
<a class="btn btn-primary btn-sm" href="<?php echo site_url($setMarketMoversLink); ?>" target="_blank">Submit Market Movers</a>
