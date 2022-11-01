<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

$pageURIA		= $this->uri->segment(1);
$pageURIB		= $this->uri->segment(2);
$pageURIC		= $this->uri->segment(3);
$pageURID		= $this->uri->segment(4);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-4 mb-3">  
			<?php $this->load->view('User/Wallets/MyMI_Gold/order_form'); ?>
		</div>
		<div class="col-md-8 mb-3">  
			<?php $this->load->view('User/Wallets/MyMI_Gold/description'); ?>
		</div>
	</div>
</div>						
