<style>
.tv-embed-widget-wrapper__body {
	border: none !important;
}


</style>
<!-- TradingView Widget BEGIN -->
<div class="tv-chart-container">
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		  <div id="tradingview_de114"></div>
		  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text"><?php echo $exchange . ':' . $symbol; ?> Chart</span></a> by TradingView</div>
		  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
		  <?php
          echo '
		  <script type="text/javascript">
		  new TradingView.widget(
		  {
		  "autosize": true,
		  "symbol": "' . $symbol . '",
		  "interval": "60",
		  "timezone": "America/Chicago",
		  "theme": "dark",
		  "style": "1",
		  "locale": "en",
		  "toolbar_bg": "#f1f3f6",
		  "enable_publishing": true,
		  "withdateranges": true,
		  "hide_side_toolbar": false,
		  "allow_symbol_change": true,
		  "details": true,
		  "studies": [
			"MACD@tv-basicstudies",
			"MAExp@tv-basicstudies",
			"PivotPointsHighLow@tv-basicstudies",
			"RSI@tv-basicstudies",
			"VWAP@tv-basicstudies"
		  ],
		  "container_id": "tradingview_de114"
		}
		  );
		  </script>
		  ';?>
	</div>
<!-- TradingView Widget END -->
</div>
<!-- TradingView Widget END -->
