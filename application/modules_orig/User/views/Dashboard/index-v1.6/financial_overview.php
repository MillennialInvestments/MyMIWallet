<div class="nk-block">  
	<div class="nk-block-head-xs py-3">
		<div class="nk-block-head-content"><h5 class="nk-block-title title pb-2 fw-bold">Financial Overview</h5></div>
	</div>
	<?php
    echo '
	<div class="nk-block">
		<div class="card card-bordered text-light is-dark">
			<div class="card-inner">
				<div class="nk-wg7">
					<div class="nk-wg7-stats">
						<div class="nk-wg7-title">Available Balance in USD</div>
						<div class="number-lg amount">' . $walletSum . '
						</div>
					</div>
					<div class="nk-wg7-stats-group">
						<div class="nk-wg7-stats w-50">
							<div class="nk-wg7-title">Wallets</div>
							<div class="number-lg">' . $cuWalletCount . '</div>
						</div>
						<div class="nk-wg7-stats w-50">
							<div class="nk-wg7-title">Today\'s Gains</div>
							<div class="number">' . $walletGains . '</div>
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
