<?php
echo '
<div class="col-6 col-md-3">
	<div class="card bg-light">
		<div class="nk-wgw sm">
			<a class="nk-wgw-inner ' . $btnID . '" href="" data-toggle="modal" data-target="#transactionModal" data-value="Deposit Funds">
				<div class="nk-wgw-name">
					<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
					<h5 class="nk-wgw-title title">' . $elementTitle . '</h5>
				</div>
				<div class="nk-wgw-balance">
					<div class="amount text-left">' . $elementText . '</div>
				</div>
			</a>
		</div>
	</div>
</div>
';
