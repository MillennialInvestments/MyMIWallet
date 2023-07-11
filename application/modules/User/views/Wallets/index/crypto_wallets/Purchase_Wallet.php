<?php
echo '
<<<<<<< HEAD
<div class="col-xxl-3 col-lg-4 col-sm-6 mt-3">
	<div class="card card-bordered dashed h-100">
		<div class="nk-wgw-add">
            <div class="nk-wgw-inner">            
                <h6 class="title">' . $elementTitle . '</h6>
                <span class="sub-text">
                    ' . $elementText . '
                </span>
            </div>
            <div class="nk-wgw-actions">
                <ul class="vertical-divider">
                    <li class="' . $btnSizing . '">
                        <a href="#" id="link-button"><i class="icon ni ni-search mr-1"></i> <span>Search</span></a>
                    </li>
                    <li class="' . $btnSizing . '">
                        <a  class="' . $btnID . '" data-toggle="modal" data-target="#transactionModal"><i class="icon ni ni-note-add mr-1"></i> <span>Manually Add</span></a>
                    </li>
                </ul>
            </div>
=======
<div class="col-md-6 col-lg-4 mt-3">
	<div class="card card-bordered dashed h-100">
		<div class="nk-wgw-add">
			<div class="nk-wgw-inner">
				<a data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
					<div class="add-icon"><i class="icon ni ni-plus"></i></div>
					<h6 class="title">Add New Wallet</h6>
				</a>
				<span class="sub-text">
					<strong>Cost: <small>Free</small></strong><br>
					Utilize your Free Wallet to manage an additional brokerage account separately.
				</span>
			</div>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
		</div>
	</div>
</div>
';
?>


