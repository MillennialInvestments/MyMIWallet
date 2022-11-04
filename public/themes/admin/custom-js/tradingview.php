<?php

$currentUserType				= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
$type 							= Template::get('alertType');
$alertLink						= Template::get('alertLink');
$alertLinkB						= Template::get('alertLinkB');
$database						= 'bf_investment_trade_alerts';
$pageURIA						= $this->uri->segment(1);
if ($pageURIA === 'Breakout-Stocks') {
    $dbType = 'Breakout Stock';
} elseif ($pageURIA === 'Liquidity-Stock') {
    $dbType = 'Liquidity Stock';
} elseif ($pageURIA === 'Morning-Movers') {
    $dbType = 'Morning Mover';
} elseif ($pageURIA === 'Penny-Stocks') {
    $dbType = 'Penny Stock';
} elseif ($pageURIA === 'Weekly-Options') {
    $dbType = 'Weekly Option';
}
$this->db->from($database);
$this->db->where('category', $dbType);
$this->db->where('status', 'Opened');
$this->db->where($currentUserType, 'Yes');
$this->db->order_by('id', 'DESC');
$getAlert = $this->db->get();

foreach ($getAlert->result_array() as $alertInfo) {
    // Get Database Stock Information
    $symbol			= $alertInfo['stock'];
    $exchangeName	= $alertInfo['exchange'];
    $current_price	= $alertInfo['current_price'];
    echo '
	<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
	{
		"symbol": "' . $exchangeName . ':' . $symbol . '",
		"width": "100%",
		"height": "100%",
		"locale": "en",
		"dateRange": "1d",
		"colorTheme": "light",
		"trendLineColor": "#37a6ef",
		"underLineColor": "#E3F2FD",
		"isTransparent": false,
		"autosize": true,
		"largeChartUrl": "' . site_url('Stock/' . $exchangeName . '/' . $symbol) . '"
	}
	</script>
	';
}
