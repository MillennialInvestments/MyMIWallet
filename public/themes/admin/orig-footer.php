<?php
$pageURIA 					= $this->uri->segment(1);
$cuWalletID					= $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuWalletCount              = $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$MyMIGCoinSum				= $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$walletCost					= $this->config->item('wallet_cost');

?>
<?php
if (!empty($cuWalletID)) {
    if ($pageURIA === 'Dashboard' or $pageURIA === 'Wallets') {
        if ($cuWalletCount < 2) {
            echo '
			<div class="modal fade" id="purchaseFiatWalletModal" tabindex="-1" aria-labelledby="useCoinModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">';
            if ($cuWalletCount < 2) {
                $modalTitle			= 'Add Fiat Wallet';
                $fiatData					= array(
                                'addModalTitle'			=> $modalTitle,
                                'purchaseModalTitle'	=> '',
                                'walletType'			=> 'Fiat',
                            );
            } else {
                $purchaseModalTitle	= 'Purchase Fiat Wallet';
                $fiatData					= array(
                                'addModalTitle'			=> '',
                                'purchaseModalTitle'	=> $purchaseModalTitle,
                                'walletType'			=> 'Fiat',
                            );
            }
            if ($cuWalletCount < 2) {
                $this->load->view('User/Wallets/Add', $fiatData);
            } else {
                $this->load->view('User/Wallets/Purchase', $fiatData);
            };
            echo '
					</div>
				</div>
			</div>
			<div class="modal fade active show" id="purchaseDigitalWalletModal" tabindex="-1" aria-labelledby="useCoinModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">';
            if ($cuWalletCount < 2) {
                $modalTitle			= 'Add Crypto Wallet';
                $digitalData			= array(
                                'addModalTitle'			=> $modalTitle,
                                'purchaseModalTitle'	=> '',
                                'walletType'			=> 'Digital',
                            );
            } else {
                $purchaseModalTitle	= 'Purchase Crypto Wallet';
                $digitalData			= array(
                                'addModalTitle'			=> '',
                                'purchaseModalTitle'	=> $purchaseModalTitle,
                                'walletType'			=> 'Digital',
                            );
            };
            if ($cuWalletCount < 2) {
                $this->load->view('User/Wallets/Add', $digitalData);
            } else {
                $this->load->view('User/Wallets/Purchase', $digitalData);
            };
            echo '
					</div>
				</div>
			</div>
			';
        } elseif ($cuWalletCount > 2) {
            if ($MyMIGCoinSum < $walletCost) {
                echo '
					<div class="modal fade" id="coinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog model-md">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title" id="exampleModalLabel">Purchase MyMI Gold</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">' . $this->load->view('User/Wallets/Purchase_Coins') . '</div>
							</div>
						</div>
					</div>
				';
            } elseif ($MyMIGCoinSum > $walletCost) {
                echo '
				<div class="modal fade" id="purchaseFiatWalletModal" tabindex="-1" aria-labelledby="useCoinModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">';
                if ($cuWalletCount < 2) {
                    $modalTitle			= 'Add Fiat Wallet';
                } else {
                    $purhcaseModalTitle	= 'Purchase Fiat Wallet';
                }
                $fiatData					= array(
                                'addModalTitle'			=> $modalTitle,
                                'purhcaseModalTitle'	=> $purhcaseModalTitle,
                                'walletType'			=> 'Fiat',
                            );
                if ($cuWalletCount < 2) {
                    $this->load->view('User/Wallets/Add', $fiatData);
                } else {
                    $this->load->view('User/Wallets/Purchase', $fiatData);
                };
                echo '
						</div>
					</div>
				</div>
				<div class="modal fade active show" id="purchaseDigitalWalletModal" tabindex="-1" aria-labelledby="useCoinModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">';
                if ($cuWalletCount < 2) {
                    $modalTitle			= 'Add Crypto Wallet';
                } else {
                    $purhcaseModalTitle	= 'Purchase Crypto Wallet';
                };
                $digitalData			= array(
                                'addModalTitle'			=> $modalTitle,
                                'purhcaseModalTitle'	=> $purhcaseModalTitle,
                                'walletType'			=> 'Digital',
                            );
                if ($cuWalletCount < 2) {
                    $this->load->view('User/Wallets/Add', $digitalData);
                } else {
                    $this->load->view('User/Wallets/Purchase', $digitalData);
                };
                echo '
						</div>
					</div>
				</div>
				';
            }
        }
    } ?>              

<?php
} else {
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
<?php
    }
?>
<div class="nk-footer nk-footer-fluid">
	<div class="container-fluid">
		<div class="nk-footer-wrap">
			<div class="nk-footer-copyright">
				&copy; <?php echo date("Y"); ?> Millennial Investments, LLC. Powered by <a href="https://timothyburks.com">TBI Solutions</a>  
			</div>
			<div class="nk-footer-links"> 
<!--
				<ul class="nav nav-sm">
					<li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
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
$this->load->view('User/Dashboard/index/trade-tracker-modal');
$this->load->view('User/Trade_Tracker/Search');
?>           
<div id="debug"><!-- Stores the Profiler Results --></div>
<?php
echo theme_view('js-links');
echo theme_view('custom-js');
echo theme_view('page_views');
?>
