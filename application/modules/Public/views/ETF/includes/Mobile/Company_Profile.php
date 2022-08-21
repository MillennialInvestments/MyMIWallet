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
<?php
// Mobile Version
if ($this->agent->is_mobile()) {
    echo '
		<div style="height: 300px !important;">
	';
} else {
    echo '
		<div style="height: 750px !important;">
	';
}
?>
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		<div class="tradingview-widget-container__widget"></div>
		
		<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-profile.js" async>
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
</div>
<!-- TradingView Widget END -->
