<?php
$pageURIA 					= $this->uri->segment(1);
$cuWalletID					= $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuRole 					= $_SESSION['allSessionData']['userAccount']['cuRole'];
$cuWalletCount              = $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$MyMIGCoinSum				= $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$walletCost					= $this->config->item('wallet_cost');

?>
  
<div class="modal fade" id="coinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Generate MyMI Wallet Address</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<?php $this->load->view('User/Wallets/Generate_Wallet'); ?>
			</div>
		</div>
	</div>
</div>
<div class="nk-footer nk-footer-fluid">
	<div class="container-fluid">
		<div class="nk-footer-wrap">
			<div class="nk-footer-copyright">
				&copy; <?php echo date("Y"); ?> Millennial Investments, LLC. Powered by <a href="https://timothyburks.com">TBI Solutions</a>  
			</div>
			<div class="nk-footer-links"> 
<!--
				<ul class="nav nav-sm"> /li>
					<li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
				</ul>
-->
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('User/Dashboard/index/transaction-modal');
// $this->load->view('User/Dashboard/index/transaction-purchase-modal');
//$this->load->view('User/Trade_Tracker/Search');

if ($cuRole === '1') {
$this->load->view('User/Dashboard/index/user-information-modal'); 
}
?>           
<div id="debug"><!-- Stores the Profiler Results --></div>
<?php
echo theme_
echo theme_view('js-links');
echo theme_view('custom-js');
echo theme_view('page_views');
?>
