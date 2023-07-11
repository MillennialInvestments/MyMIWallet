<?php
$pageURIA   = $this->uri->segment(1);
$pageURIB   = $this->uri->segment(2);
$pageURIC   = $this->uri->segment(3);
$pageURID   = $this->uri->segment(4);
$pageURIE   = $this->uri->segment(5);
$cuID       = $_SESSION['allSessionData']['userAccount']['cuID'];
?>
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog" id="transModalDialog">
		<div class="modal-content" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="transactionContainer">
		</div>
	</div>
</div>
<?php 
   //$this->load->view('User/Wallets/Add/wallet-transaction-modal');
// if ($pageURIA === 'Wallets' || $pageURIA === 'Wallet-Selection') {
//    $this->load->view('User/Wallets/Add/wallet-transaction-modal');
// }
?>

<script>
	$('#depositFundsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
				// success callback -- replace the div's innerHTML with
				// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>);
	});	
	$('.depositFundsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>);
	});	
	$('#withdrawFundsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>);
	});
	$('.withdrawFundsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>);
	});
	$('#trackDepositBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet-Deposit-Fetch/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
				// success callback -- replace the div's innerHTML with
				// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet-Deposit-Fetch/' . $cuID) . '\''; ?>);
	});	
	$('#trackWithdrawBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet-Withdraw-Fetch/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet-Withdraw-Fetch/' . $cuID) . '\''; ?>);
	});	
	$('.purMyMIGold').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
	});	
	$('.purMyMIGoldWallet').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
			dataType: 'html',
			// beforeSend: function() {
			// 	$('#transactionContainer').hide(); 
			// 	$('#loading-content').show(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				// $('#loading-content').hide(); 
				// $('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
	});	
	// PURCHASE MYMI GOLD MODAL
	$('#purMyMIGoldNavbar').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
	});	
	// PURCHASE FIAT WALLET
	$('.purFiatWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Purchase-Wallet/Fiat/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Purchase-Wallet/Fiat/' . $cuID) . '\''; ?>);
	});
	// PURCHASE DIGITAL WALLET
	$('.purDigitalWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Purchase-Wallet/Digital/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Purchase-Wallet/Digital/' . $cuID) . '\''; ?>);
	});
	$('#generateWalletAddressBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Address-Generator') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallets/Address-Generator') . '\''; ?>);
	});
	$('.addFiatWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet/Fiat') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
                $('#transaction-modal').hide();
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet/Fiat') . '\''; ?>);
	});
	$('#addFiatWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet/Fiat') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet/Fiat') . '\''; ?>);
	});
	$('.addDigitalWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet/Digital') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
                $('#transaction-modal').hide();
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet/Digital') . '\''; ?>);
	});
	$('#addDigitalWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Add-Wallet/Digital') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Add-Wallet/Digital') . '\''; ?>);
	});
	$('.addBankAccount').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Banking/Add/Account') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallets/Banking/Add/Account') . '\''; ?>);
	});
	$('.addCreditAccount').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Credit/Add/Account') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallets/Credit/Add/Account') . '\''; ?>);
	});	
	$('.addInvestAccount').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Investment/Add/Account/Modal') . '\''; ?>,
			// url: <?php //echo '\'' . site_url('Wallets/Connect-Bank-Account') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallets/Connect-Bank-Account') . '\''; ?>);
	});	
	$('.walletSelectionFreeFiat').click(function(e) {
        // Change Transaction Modal to become large for more real estate for more content
        const transModalDialog            = document.getElementById('transModalDialog');
        transModalDialog.classList.add("modal-lg");
        transModalDialog.classList.add("testDiv");
        
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallet-Selection/Fiat') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallet-Selection/Fiat') . '\''; ?>);
	});	
	$('.walletSelection').click(function(e) {
        // Change Transaction Modal to become large for more real estate for more content
        const transModalDialog            = document.getElementById('transModalDialog');
        transModalDialog.classList.add("modal-lg");
        transModalDialog.classList.add("testDiv");
        
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallet-Selection') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallet-Selection') . '\''; ?>);
	});		
	$('#walletSelection').click(function(e) {
        // Change Transaction Modal to become large for more real estate for more content
        const transModalDialog            = document.getElementById('transModalDialog');
        transModalDialog.classList.add("modal-lg");
        transModalDialog.classList.add("testDiv");
        
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallet-Selection') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallet-Selection') . '\''; ?>);
	});		
    $('.walletSelectionFiat').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallet-Selection/Free/Fiat') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallet-Selection/Free/Fiat') . '\''; ?>);
	});	
    $('.walletSelectionDigital').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallet-Selection/Digital') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallet-Selection/Digital') . '\''; ?>);
	});
	$('.postAnnouncementBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Announcements/Post') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Announcements/Post') . '\''; ?>);
	});
	$('.addExternalSiteBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Admin/Add-External-Site') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Admin/Add-External-Site') . '\''; ?>);
	});	
    $('.completeAssetRequest').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Asset-Information-Modal/Existing') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Exchange/Coin-Listing/Asset-Information-Modal/Existing') . '\''; ?>);
	});
    $('.createAssetRequest').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Request') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Exchange/Coin-Listing/Request') . '\''; ?>);
	});
    $('#deleteWalletBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Delete/' . $pageURIC) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#transactionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#transactionContainer').show(); 
				$('#transactionContainer').html(html);
			}
		});
        console.log(<?php echo '\'' . site_url('Wallets/Delete/' . $pageURIC) . '\''; ?>);
	});
	$('.closeModalBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		$('body').ajaxComplete(function() {
			$('#transactionContainer').empty();
		});
	});
	$("#transactionModal").on("hidden.bs.modal", function () {
		$('#transactionContainer').empty();
	});
</script>
