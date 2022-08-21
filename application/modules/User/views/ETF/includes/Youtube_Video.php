<?php
$getStockInfo = $this->stock_model->get_trade_alert($symbol);

foreach ($getStockInfo->result_array() as $stockInfo) {
    $postVideoLink								= $stockInfo['video_link'];
    
    if (isset($postVideoLink)) {
        $string     							= $postVideoLink;
        $search     							= '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $replace    							= "youtube.com/embed/$1";
        $url 									= preg_replace($search, $replace, $string);
        $postContent	= '
		<div class="col px-0">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="' . $url . '" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		';
        echo $postContent;
    }
}
