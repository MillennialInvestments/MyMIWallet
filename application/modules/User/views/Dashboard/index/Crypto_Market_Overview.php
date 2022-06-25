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
    $btc							= 'USD-BTC';
    $btcGetSum 						= $client->public()->getMarketSummary($btc);
    $btc_mark						= $btcGetSum['result'][0]['Last'];
    $btc_prev						= $btcGetSum['result'][0]['PrevDay'];
    $btc_netChange					= $btc_mark - $btc_prev;
    if ($btc_mark > $btc_prev) {
        $btc_perChange				= ($btc_netChange / $btc_prev) * 100;
    } elseif ($btc_mark < $btc_prev) {
        $btc_perChange				= ($btc_netChange / $btc_mark) * 100;
    }
    $description					= $btc;
    // Get ETH
    $eth							= 'USD-ETH';
    $ethGetSum 						= $client->public()->getMarketSummary($eth);
    $eth_mark						= $ethGetSum['result'][0]['Last'];
    $eth_prev						= $ethGetSum['result'][0]['PrevDay'];
    $eth_netChange					= $eth_mark - $eth_prev;
    if ($eth_mark > $eth_prev) {
        $eth_perChange				= (($eth_mark - $eth_prev) / $eth_prev) * 100;
    } elseif ($eth_mark < $eth_prev) {
        $eth_perChange				= (($eth_prev - $eth_mark) / $eth_mark) * 100;
    }
    $description					= $eth;
    // Get ADA
    $ada							= 'USD-ADA';
    $adaGetSum 						= $client->public()->getMarketSummary($ada);
    $ada_mark						= $adaGetSum['result'][0]['Last'];
    $ada_prev						= $adaGetSum['result'][0]['PrevDay'];
    $ada_netChange					= $ada_mark - $ada_prev;
    if ($ada_mark > $ada_prev) {
        $ada_perChange				= (($ada_mark - $ada_prev) / $ada_prev) * 100;
    } elseif ($ada_mark < $ada_prev) {
        $ada_perChange				= (($ada_prev - $ada_mark) / $ada_mark) * 100;
    }
    $description					= $ada;
    // Get XRP
    $xrp							= 'USD-XRP';
    $xrpGetSum 						= $client->public()->getMarketSummary($xrp);
    $xrp_mark						= $xrpGetSum['result'][0]['Last'];
    $xrp_prev						= $xrpGetSum['result'][0]['PrevDay'];
    $xrp_netChange					= $xrp_mark - $xrp_prev;
    if ($xrp_mark > $xrp_prev) {
        $xrp_perChange				= (($xrp_mark - $xrp_prev) / $xrp_prev) * 100;
    } elseif ($xrp_mark < $xrp_prev) {
        $xrp_perChange				= (($xrp_prev - $xrp_mark) / $xrp_mark) * 100;
    }
    $description					= $xrp;
    $crypto_perChange				= round(($btc_perChange + $eth_perChange + $ada_perChange + $xrp_perChange)/4, 2);
    //~ $crypto_perChange				= '+' . $btc_perChange ;
    if ($btc_perChange >= 0) {
        $btcScore					= 1;
        $btcScoreCard				= '<span class="statusGreen statusGreenBg">+' . $btcScore . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($btc_perChange <= 0) {
        $btcScore					= -1;
        $btcScoreCard 				= '<span class="statusRed statusRedBg">' . $btcScore . ' </span> <span class="pl-3 statusRed">Bearish</span>';
    }
    if ($eth_perChange >= 0) {
        $ethScore					= 1;
        $ethScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $ethScore . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($eth_perChange <= 0) {
        $ethScore					= -1;
        $ethScoreCard 				= '<span class="statusRed statusRedBg">' . $ethScore . ' </span> <span class="pl-3 statusRed">Bearish</span>';
    }
    if ($ada_perChange >= 0) {
        $adaScore					= 1;
        $adaScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $adaScore . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($ada_perChange <= 0) {
        $adaScore					= -1;
        $adaScoreCard 				= '<span class="statusRed statusRedBg">' . $adaScore . ' </span> <span class="pl-3 statusRed">Bearish</span>';
    }
    if ($xrp_perChange >= 0) {
        $xrpScore					= 1;
        $xrpScoreCard 				= '<span class="statusGreen statusGreenBg">+' . $xrpScore . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($xrp_perChange <= 0) {
        $xrpScore					= -1;
        $xrpScoreCard 				= '<span class="statusRed statusRedBg">' . $xrpScore . ' </span> <span class="pl-3 statusRed">Bearish</span>';
    }
    $cryptoScore 					= $btcScore + $ethScore + $adaScore + $xrpScore;
    $crypto_mark					= round(($btc_netChange + $eth_netChange + $ada_netChange + $xrp_netChange)/4, 2);
    $cryptoScoreCard 				= $btcScore + $ethScore + $adaScore + $xrpScore;
    if ($cryptoScoreCard >= 0) {
        $cryptoScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $cryptoScoreCard . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($cryptoScoreCard <= 0) {
        $cryptoScoreCard			= '<span class="statusRed statusRedBg">' . $cryptoScoreCard . ' </span> <span class="pl-3 statusRed">Bearish</span>';
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
					<div class="tranx-label"><a href="">Crypto Overall Markets</a></div>
					<div class="tranx-date">Score: <?php echo $cryptoScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $crypto_mark; ?></div>
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
				<div class="number"><?php echo number_format($btc_mark, 2); ?></div>
				<div class="number-sm"><?php echo round($btc_perChange, 2); ?>%</div>
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
				<div class="number"><?php echo number_format($eth_mark, 2); ?></div>
				<div class="number-sm"><?php echo round($eth_perChange, 2); ?>%</div>
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
				<div class="number-sm"><?php echo round($ada_perChange, 2); ?>%</div>
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
				<div class="number-sm"><?php echo round($xrp_perChange, 2); ?>%</div>
			</div>
		</div>
	</div>
</div>
