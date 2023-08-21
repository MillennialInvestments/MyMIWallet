<div class="nk-block"> 
	<div class="nk-block-head pt-5">
		<div class="nk-block-between-md">
			<div class="nk-block-head-content">
				<div class="nk-block-head-sub">
					<a class="back-to" href="<?php echo site_url('/Wallets'); ?>"><em class="icon ni ni-arrow-left"></em><span>My Wallets</span></a>
				</div>
				<div class="nk-wgwh">
					<em class="icon-circle icon-circle-lg icon ni ni-sign-usd"></em>
					<div class="nk-wgwh-title h5">
						<?php echo $walletTitle; ?>
<!--
						<div class="dropdown">
							<a class="dropdown-indicator-caret" data-offset="0,4" href="#" data-toggle="dropdown"><small>USD</small></a>
							<div class="dropdown-menu dropdown-menu-xxs dropdown-menu-center">
								<ul class="link-list-plain text-center">
									<li><a href="#">BTC</a></li>
									<li><a href="#">ETH</a></li>
									<li><a href="#">YEN</a></li>
								</ul>
							</div>
						</div>
-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
<div class="nk-block">
	<div class="nk-block-between-md g-4">
		<div class="nk-block-content">
			<div class="nk-wg1">
				<div class="nk-wg1-group g-2">
					<div class="nk-wg1-item mr-xl-4">
						<div class="nk-wg1-title text-soft">Available Balance</div>
						<div class="nk-wg1-amount">
							<div class="amount"><?php echo number_format($walletFunds, 2); ?> <small class="currency currency-usd">USD</small></div>
							<div class="amount-sm">
								Total Growth <span><?php echo $walletGains; ?> <span class="currency currency-usd">%</span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--
		<div class="nk-block-content">
			<ul class="nk-block-tools gx-3">
				<li class="btn-wrap">
					<a href="<?php //echo site_url('/Edit-Wallet/' . $walletID);?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Settings</span>
				</li>
				<li class="btn-wrap dropdown">
					<a class="btn btn-icon btn-xl btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Quick Trade</span>
					<div class="dropdown-menu">
						<ul class="link-list-opt">
							<li>
								<a data-toggle="modal" data-target="#quickEquityTradeModel">Equity Trade</a>
							</li>
							<li>
								<a data-toggle="modal" data-target="#quickOptionTradeModel">Option Trade</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="btn-wrap">
					<a href="<?php echo site_url('/MyMI-Wallet'); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Purchase</span>
				</li>
				<li class="btn-wrap">
					<a class="btn btn-icon btn-xl btn-primary text-white" data-toggle="modal" data-target="#coinModal"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw</span>
				</li>
			</ul>
		</div>
-->
	</div>
</div> 
