<?php
$currentUserRoleID 	= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$setWeeklyWatchlistLink = Template::get('setWeeklyWatchlistLink');
?>
<h4>Weekly Watchlist</h4>
The Weekly Watchlist is used to identify stocks that are expected to breakout or move throughout the upcoming trading week to give investors a head-start in placing positions before the stock breakouts.
<br>
<br>
<?php
if ($currentUserRoleID === 1) {
    $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Targeting/Market_Movers');
}
?>
<br>
To submit a <strong>Weekly Watchlist Alert</strong>, simply click the link below.
<br>
<a class="btn btn-primary btn-sm" href="<?php echo site_url($setWeeklyWatchlistLink); ?>" target="_blank">Submit Weekly Watchlist</a>
