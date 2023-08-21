<?php
$exchange 	= $this->uri->segment(2);
$symbol 	= $this->uri->segment(3);
?>
<style>
.tv-embed-widget-wrapper__body {
	border: none !important;
}


</style>
<!-- TradingView Widget BEGIN -->
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container pr-3">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><?php echo '<a href="https://www.tradingview.com/symbols/' . $exchange . '-' . $symbol . '/" rel="noopener" target="_blank"><span class="blue-text">' . $symbol . ' Quotes</span></a>'; ?> by TradingView</div>
  <?php
  echo '
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
  {
  "symbol": "' . $exchange . ':' . $symbol . '",
  "width": "100%",
  "height": "100%",
  "locale": "en",
  "dateRange": "1D",
  "colorTheme": "dark",
  "trendLineColor": "#37a6ef",
  "underLineColor": "rgba(55, 166, 239, 0.15)",
  "isTransparent": true,
  "autosize": true,
  "largeChartUrl": ""
}
  </script> '; ?>
</div>
<!-- TradingView Widget END -->
