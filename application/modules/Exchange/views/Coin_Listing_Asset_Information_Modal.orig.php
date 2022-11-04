<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$cuID				= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail			= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$errorClass   		= empty($errorClass) ? ' error' : $errorClass;
$controlClass 		= empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'cuID'			=> $cuID,
    'cuEmail'		=> $cuEmail,
);

$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
?>
<div class="modal-header">
	<h3 class="modal-title" id="coinListingModal">Add Digital Asset</h3>
	<button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="nk-block pt-1">
		<div class="card card-bordered bg-light">
			<div class="card-inner">
				<div class="nk-wg7">
					<div class="nk-wg7-stats-group">
						<div class="nk-wg7-stats w-50 text-center">
							<a href="<?php echo site_url('Exchange/Coin-Listing/Asset-Information/New'); ?>">
								<div class="nk-wg1-title">New Asset</div>
								<div class="number-lg">
									<em class="icon ni ni-property-add ni-cf-size"></em>
								</div>
							</a>
						</div>
						<div class="nk-wg7-stats w-50 text-center">
							<a href="<?php echo site_url('Exchange/Coin-Listing/Asset-Information/Existing'); ?>">
								<div class="nk-wg1-title">Existing Asset</div>
								<div class="number-lg">
									<em class="icon ni ni-property-add ni-cf-size"></em>
								</div>
							</a>
						</div>
					</div>
					<div class="nk-wg7-foot">
						<!-- <span class="nk-wg7-note">Last activity at <span>' . $lastTradeActivity . '</span></span>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
