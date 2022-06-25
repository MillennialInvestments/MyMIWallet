<?php
$currentUserRoleID 	= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$setBreakoutStockAlertLink 			= Template::get('setBreakoutStockAlertLink');
$dateAndTime	 					= Template::get('dateAndTime');
$stockExchangeInfo	 				= Template::get('stockExchangeInfo');
$personalizedDetails	 			= Template::get('personalizedDetails');
$sendToAllUsers	 					= Template::get('sendToAllUsers');
$setBreakoutStockAlertLink			= Template::get('setBreakoutStockAlertLink');
?>
<h4>Breakout Stock Alerts</h4>
<br>
Breakout Stock Alerts are sent to inform end-users of breakout stock positions that we will <strong>NOT</strong> be conducting new positions with at Millennial Investments. Breakout Alerts are meant to simply inform the user of potential investment opportunities. 
<br>
<br>
Breakout Stock Alerts provide Millennial Investors with the following information:
<ul>
	<li>Date/Time <a href="#" data-toggle="tooltip" title="<?php e($dateAndTime); ?>"><i class="icon-info"></i></a></li>
	<li>Specified Stock</li>
	<li>Stock Exchange <a href="#" data-toggle="tooltip" title="<?php e($stockExchangeInfo); ?>"><i class="icon-info"></i></a></li>
	<li>Current Price of Stock</li>
	<li>Personalized Details <a href="#" data-toggle="tooltip" title="<?php e($personalizedDetails); ?>"><i class="icon-info"></i></a></li>
	<li>Send to All Users? <a href="#" data-toggle="tooltip" title="<?php e($sendToAllUsers); ?>"><i class="icon-info"></i></a></li>
</ul>
<br>	
<?php
if ($currentUserRoleID === 1) {
    $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Targeting/Breakout_Stocks');
}
?>
<br>	
To submit a <strong>Breakout Stock Alert</strong>, simply click the link below.
<br>
<a class="btn btn-primary btn-sm" href="<?php echo site_url($setBreakoutStockAlertLink); ?>" target="_blank">Submit Breakout Alert</a>
