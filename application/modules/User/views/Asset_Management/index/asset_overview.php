<div class="nk-block">  
	<div class="nk-block-head-xs py-3">
		<div class="nk-block-head-content"><h5 class="nk-block-title title pb-2 fw-bold">Asset Overview</h5></div>
	</div>
	<?php
    echo '
	<div class="nk-block">
		<div class="card card-bordered text-light is-dark h-100">
			<div class="card-inner">
				<div class="nk-wg7">
					<div class="nk-wg7-stats">
						<div class="nk-wg7-title">Total Value in USD</div>
						<div class="number-lg amount">$' . number_format($assetNetValue, 2) . '
						</div>
					</div>
					<div class="nk-wg7-stats-group">
						<div class="nk-wg7-stats w-50">
							<div class="nk-wg7-title">Total Assets</div>
							<div class="number-lg">' . $assetTotalCount . '</div>
						</div>
						<div class="nk-wg7-stats w-50">
							<div class="nk-wg7-title">Total P/L</div>
							<div class="number">$' . $assetTotalGains . '</div>
						</div>
					</div>
					<div class="nk-wg7-foot">
						<!-- <span class="nk-wg7-note">Last activity at <span>' . $lastTradeActivity . '</span></span>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	';
    ?>
</div>
