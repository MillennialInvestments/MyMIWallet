<?php
$stockMarket = $this->uri->segment(2);
$stockSym = $this->uri->segment(3);
?>
<style>
	.tradingview-widget-container {
		width: 100% !important;
	}
	.tradingview-widget-container > iframe {
		width: inherit !important; 
	}
</style>
<div style="height: 775px;">
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		<div class="tradingview-widget-container__widget" id="tradingview_fd12"></div>
		<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-financials.js" async>
		{
			<?php
            echo '
				"symbol": "' . $stockMarket . ':' . $stockSym . '",
				"colorTheme": "light",
				"isTransparent": false,
				"largeChartUrl": "",
				"displayMode": "regular",
				"width": "100%",
				"height": "100%",
				"locale": "en" 
				';
            ?>
		}
	  </script>
	</div>
	<!-- TradingView Widget END -->
</div>
