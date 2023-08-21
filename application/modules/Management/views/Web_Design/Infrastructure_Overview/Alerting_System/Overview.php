<?php
// Hyperlinks
$setBreakoutStockAlertLink = 'Investments/Alerts/Breakout-Stocks';
$setInstantBuyAlertLink = 'Investments/Alerts/Instant-Buy-Alerts';
$setMarketMoversLink = 'Investments/Alerts/Market-Movers';
$setWeeklyWatchlistLink = 'Investments/Alerts/Weekly-Watchlist';
Template::set('setBreakoutStockAlertLink', $setBreakoutStockAlertLink);
Template::set('setInstantBuyAlertLink', $setInstantBuyAlertLink);
Template::set('setMarketMoversLink', $setMarketMoversLink);
Template::set('setWeeklyWatchlistLink', $setWeeklyWatchlistLink);
// Tooltips
$dateAndTime = 'The Date & Time when the alert is being sent is auto-generated by the system itself to confirm when the alert when sent';
$stockExchangeInfo = 'Used to create hyperlink to review the stock and it\'s performance on the Front-End of the Millennial Investments Website';
$personalizedDetails = 'Additional information to provide the investors in order to confirm why a stock is set to breakout or what is expected to cause the breakout';
$sendToAllUsers = 'The ability to select whether or not to send the alert to ALL USERS, ADMIN ONLY or NOT AT ALL (For Testing Purposes)';
$levelsOfResistance = 'Top Levels of Resistance are sell-off prices where the stock will climb to and then retreat back down to lower-levels of price';
Template::set('dateAndTime', $dateAndTime);
Template::set('stockExchangeInfo', $stockExchangeInfo);
Template::set('personalizedDetails', $personalizedDetails);
Template::set('sendToAllUsers', $sendToAllUsers);
Template::set('levelsOfResistance', $levelsOfResistance);
?>
<h5>Scheduled Tasks &amp; Weekly To-Do Lists</h5>
<hr>
<ul style="list-style: none;">
	<li class="pb-3">
		<?php $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Breakout_Stock_Alerts'); ?>
	</li> 
	<hr>
	<li class="pb-3">
		<?php $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Instant_Buy_Alerts'); ?>
	</li>
	<hr>	
	<li class="pb-3">
		<?php $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Market_Movers'); ?>
	</li>
	<hr>
<!--
	<li class="pb-3">
		<?php //$this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Weekly_Options');?>
	</li>
	<hr>
-->
	<li class="pb-3">
		<?php $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Weekly_Watchlist'); ?>
	</li>
</ul>
