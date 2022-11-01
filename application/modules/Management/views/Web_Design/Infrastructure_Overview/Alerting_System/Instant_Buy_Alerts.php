<?php
$currentUserRoleID 	= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$setInstantBuyAlertLink 			= Template::get('setInstantBuyAlertLink');
$stockExchangeInfo	 				= Template::get('stockExchangeInfo');
$personalizedDetails	 			= Template::get('personalizedDetails');
$sendToAllUsers	 					= Template::get('sendToAllUsers');
?>
<h4>Instant Buy Alerts</h4>
<br>
Instant Buy Alerts are sent to inform end-users of new positions that we will be conducting at Millennial Investments. With our Instant Buy Alerts, we are able to let users know why we are placing our position and the quantity of the stock we expect to purchase. After we have completed the buy/sell of the stock position, we are able to close the Instant Buy Alert which will provide the investors with our Profit/Loss Statements to display the gains and losses we acquired on each of the individual positions that were placed.
<br>
<br>
<h5>Instant Buy Alerts provide Millennial Investors with the following information:</h5>
<h6>Type of Alerts</h6>
<table class="table table-default table-hover">
	<tbody>
		<tr>
			<td><a class="text-primary" data-toggle="modal" data-target="#breakoutStocks">Breakout Stocks</a></td>
			<td class="textAreaConvert">
				Breakout Stocks are stocks that are breaking through the <a class="text-primary" data-toggle="modal" data-target="#LevelsOfResistance">Levels of Resistance</a> or below <a class="text-primary" data-toggle="modal" data-target="#LevelsOfSupport">Levels of Support</a>. Learn more about breakout stocks by clicking <a class="text-primary" data-toggle="modal" data-target="#breakoutStocks">here</a>.
			</td>
		</tr>
		<tr>
			<td><a class="text-primary" data-toggle="modal" data-target="#continuationStocks">Continuation Stocks</a></td>
			<td class="textAreaConvert">
				Continuation patterns are an indication traders look for to signal that a price trend is likely to remain in play.
				These patterns occur in the middle of a trend and signal that once a pattern has completed, the trend will most likely resume.
			</td> 
		</tr>
		<tr>
			<td><a class="text-primary" data-toggle="modal" data-target="#momentumStocks">Momentum Stocks</a></td>
			<td class="textAreaConvert">
				Momentum investing involves a strategy to capitalize on the continuance of an existing market trend. It involves going long stocks, futures or market ETFs showing upward-trending prices and short the respective assets with downward-trending prices.
			</td>
		</tr>
		<tr>
			<td><a class="text-primary" data-toggle="modal" data-target="#rsiBounceStocks">RSI Bounce Stocks (Oversold/Overbought)</a></td>
			<td class="textAreaConvert">
				An oversold bounce implies that prices are correcting themselves upward because they went too low just prior to the bounce. Being oversold means that the price of an asset or market has fallen to a level below its fair value. Overbought refers to a security with a price that's higher than its intrinsic value. Many investors use price-earnings (P/E) ratios to determine if a stock is overbought, while traders use technical indicators, like the relative strength index (RSI).
			</td> 
		</tr>
		<tr>
			<td><a class="text-primary" data-toggle="modal" data-target="#weeklyOptions">Weekly Options</a></td>
			<td class="textAreaConvert">
				Weekly Options Based-Alerts is an alternative type of Stock Investment (vs. Standard Purchase of Stock Positions), where we alert investors of directional stock price changes that we expect to occur over a selected period of time. Learn more about <a class="text-primary" data-toggle="modal" data-target="#optionPositions">Options</a> by clicking <a class="text-primary" data-toggle="modal" data-target="#optionPositions">here</a>. 
			</td>
		</tr>
	</tbody>
</table>
<ul>
	<li>Stock Exchange <a href="#" data-toggle="tooltip" title="<?php e($stockExchangeInfo); ?>"><i class="icon-info"></i></a></li>
	<li>Specified Stock</li>
	<li>Price of Stock Position Purchase</li>
	<li>Quantity of Stock Position Purchase</li>
	<li>Personalized Details <a href="#" data-toggle="tooltip" title="<?php e($personalizedDetails); ?>"><i class="icon-info"></i></a></li>
	<li>Send to All Users? <a href="#" data-toggle="tooltip" title="<?php e($sendToAllUsers); ?>"><i class="icon-info"></i></a></li>
</ul>
<br>
<?php
if ($currentUserRoleID === 1) {
    $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Targeting/Instant_Buy_Alerts');
}
?>	
<br>
To submit a <strong>Instant Buy Alert</strong>, simply click the link below.
<br>
<a class="btn btn-primary btn-sm" href="<?php echo site_url($setInstantBuyAlertLink); ?>" target="_blank">Submit Breakout Alert</a>

<?php $this->load->view('Web_Design/Infrastructure_Overview/Modals'); ?>
