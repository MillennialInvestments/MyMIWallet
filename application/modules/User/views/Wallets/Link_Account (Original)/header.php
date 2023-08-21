<?php
if ($pageURIC === 'Confirm') {
    $title              = 'Confirm Account Information';
    $subtitle           = '';
    $description        = 'Please View & Confirm Your Account Information';
} elseif ($pageURIC === 'Upload-Trades') {
    $title              = 'Bulk Import Trades';
    $subtitle           = '';
    $description        = 'Import/Manage Trades For This Account';
} elseif ($pageURIC === 'Success') {
    $title              = 'Account Added Successfully';
    $subtitle           = '';
    $description        = 'Your Account Was Added Successfully';
} elseif ($pageURIC === 'TD-Ameritrade' OR $pageURIC === '1') {
    $title              = 'Authorize TD Ameritrade Account';
    $subtitle           = '';
    $description        = 'Please Provide Authorization To Access Your Account Transactions';
} elseif ($pageURIC === 'Brokerage') {
    $title              = 'Select Your Brokerage Account';
    $subtitle           = '';
    $description        = 'Choose The Brokerage Account You Would Like To Connect';
}
?>
<div class="nk-block">
	<div class="nk-block-head">
		<?php echo theme_view('navigation_breadcrumbs'); ?>
		<div class="nk-block-between-md g-4">
			<div class="nk-block-head-content">
				<h2 class="nk-block-title fw-bold"><?= $title; ?> <small class="fw-light"><?= $subtitle; ?></small></h2>
				<div class="nk-block-des"><p><?= $description; ?></p></div>
			</div>
			<?php //$this->load->view('User/Wallets/index/header-tools');?>
		</div>
	</div>
</div>
