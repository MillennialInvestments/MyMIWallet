<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Crypto Markets</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
	<?php
    use Codenixsv\BittrexApi\BittrexClient;

// Reference https://github.com/codenix-sv/bittrex-api for coding;
    $client = new BittrexClient();
    $client->setCredential('82122111507946599fe903f058758e92', '466bfcbc6ba0425e8b429bde2eaecf13');

    // Get BTC
    $btc							= 'BTC-USD';
    $btcGetTicker                   = $client->public()->getMarketSummaryTicker($btc); 
    $btcGetSum 						= $client->public()->getMarketSummary($btc);
    $btc_mark						= number_format($btcGetTicker['lastTradeRate'],2);
    if ($btcGetSum['percentChange'] > 0) {
        $btc_perChange				= '<strong class="statusGreen">' . $btcGetSum['percentChange'] . '</strong>';
    } elseif ($btcGetSum['percentChange'] < 0) {
        $btc_perChange				= '<strong class="statusRed">' . $btcGetSum['percentChange'] . '</strong>';
    }
    $description					= $btc;
    // Get ETH
    $eth							= 'ETH-USD';
    $ethGetTicker                   = $client->public()->getMarketSummaryTicker($eth); 
    $ethGetSum 						= $client->public()->getMarketSummary($eth);
    $eth_mark						= number_format($ethGetTicker['lastTradeRate'],2);
    if ($ethGetSum['percentChange'] > 0) {
        $eth_perChange				= '<strong class="statusGreen">' . $ethGetSum['percentChange'] . '</strong>';
    } elseif ($ethGetSum['percentChange'] < 0) {
        $eth_perChange				= '<strong class="statusRed">' . $ethGetSum['percentChange'] . '</strong>';
    }
    $description					= $eth;
    // Get ADA
    $ada							= 'ADA-USD';
    $adaGetTicker                   = $client->public()->getMarketSummaryTicker($ada); 
    $adaGetSum 						= $client->public()->getMarketSummary($ada);
    $ada_mark						= number_format($adaGetTicker['lastTradeRate'],2);
    if ($adaGetSum['percentChange'] > 0) {
        $ada_perChange				= '<strong class="statusGreen">' . $adaGetSum['percentChange'] . '</strong>';
    } elseif ($adaGetSum['percentChange'] < 0) {
        $ada_perChange				= '<strong class="statusRed">' . $adaGetSum['percentChange'] . '</strong>';
    }
    $description					= $ada;
    // Get XRP
    $xrp							= 'XRP-USD';
    $xrpGetTicker                   = $client->public()->getMarketSummaryTicker($xrp); 
    $xrpGetSum 						= $client->public()->getMarketSummary($xrp);
    $xrp_mark						= number_format($xrpGetTicker['lastTradeRate'],2);
    if ($xrpGetSum['percentChange'] > 0) {
        $xrp_perChange				= '<strong class="statusGreen">' . $xrpGetSum['percentChange'] . '</strong>';
    } elseif ($xrpGetSum['percentChange'] < 0) {
        $xrp_perChange				= '<strong class="statusRed">' . $xrpGetSum['percentChange'] . '</strong>';
    }
    $description					= $xrp;
    //~ $crypto_perChange				= '+' . $btc_perChange ;
    if ($btcGetSum['percentChange'] >= 0) {
        $btcScore					= 1;
        $btcScoreCard				= '<span class="statusGreen statusGreenBg">+' . $btcScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($btcGetSum['percentChange'] <= 0) {
        $btcScore					= -1;
        $btcScoreCard 				= '<span class="statusRed statusRedBg">' . $btcScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($ethGetSum['percentChange'] >= 0) {
        $ethScore					= 1;
        $ethScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $ethScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($ethGetSum['percentChange'] <= 0) {
        $ethScore					= -1;
        $ethScoreCard 				= '<span class="statusRed statusRedBg">' . $ethScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($adaGetSum['percentChange'] >= 0) {
        $adaScore					= 1;
        $adaScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $adaScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($adaGetSum['percentChange'] <= 0) {
        $adaScore					= -1;
        $adaScoreCard 				= '<span class="statusRed statusRedBg">' . $adaScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($xrpGetSum['percentChange'] >= 0) {
        $xrpScore					= 1;
        $xrpScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $xrpScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($xrpGetSum['percentChange'] <= 0) {
        $xrpScore					= -1;
        $xrpScoreCard 				= '<span class="statusRed statusRedBg">' . $xrpScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    $cryptoScore 					= $btcScore + $ethScore + $adaScore + $xrpScore;
    $crypto_perChange			    = round(($btcGetSum['percentChange'] + $ethGetSum['percentChange'] + $adaGetSum['percentChange'] + $xrpGetSum['percentChange'])/4, 2);
    $cryptoScoreCard 				= $btcScore + $ethScore + $adaScore + $xrpScore;
    if ($cryptoScoreCard >= 0) {
        $cryptoScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $cryptoScoreCard . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($cryptoScoreCard <= 0) {
        $cryptoScoreCard			= '<span class="statusRed statusRedBg">' . $cryptoScoreCard . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    ?>

	<style>
	th, td {
		font-size: 0.75rem !important;
	}
	</style>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label"><a href="">Crypto Markets</a></div>
					<div class="tranx-date">Score: <?php echo $cryptoScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo 'N/A'; ?></div>
				<div class="number-sm"><?php echo round($crypto_perChange, 2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label"><a href="">Bitcoin (BTC)</a></div>
					<div class="tranx-date">Score: <?php echo $btcScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $btc_mark; ?></div>
				<div class="number-sm"><?php echo round($btcGetSum['percentChange'], 2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label"><a href="">Ethereum (ETH)</a></div>
					<div class="tranx-date">Score: <?php echo $ethScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $eth_mark; ?></div>
				<div class="number-sm"><?php echo round($ethGetSum['percentChange'], 2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label"><a href="">Cardano (ADA)</a></div>
					<div class="tranx-date">Score: <?php echo $adaScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $ada_mark; ?></div>
				<div class="number-sm"><?php echo round($adaGetSum['percentChange'], 2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label"><a href="">XRP (XRP)</a></div>
					<div class="tranx-date">Score: <?php echo $xrpScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $xrp_mark; ?></div>
				<div class="number-sm"><?php echo round($xrpGetSum['percentChange'], 2); ?>%</div>
			</div>
		</div>
	</div>
</div>
