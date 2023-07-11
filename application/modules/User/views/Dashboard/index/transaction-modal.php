<?php
<<<<<<< HEAD
$pageURIA   = $this->uri->segment(1);
$pageURIB   = $this->uri->segment(2);
$pageURIC   = $this->uri->segment(3);
$pageURID   = $this->uri->segment(4);
$pageURIE   = $this->uri->segment(5);
$cuID       = $_SESSION['allSessionData']['userAccount']['cuID'];
?>
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog" id="transModalDialog">
=======
$cuID		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
		<div class="modal-content" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="transactionContainer">
		</div>
	</div>
</div>
<<<<<<< HEAD
<?php 
   //$this->load->view('User/Wallets/Add/wallet-transaction-modal');
// if ($pageURIA === 'Wallets' || $pageURIA === 'Wallet-Selection') {
//    $this->load->view('User/Wallets/Add/wallet-transaction-modal');
// }
?>

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Deposit-Funds/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Withdraw-Funds/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Add-Wallet-Deposit-Fetch/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Add-Wallet-Withdraw-Fetch/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	});	
	$('.purMyMIGold').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
<<<<<<< HEAD
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
=======
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	});	
	$('.purMyMIGoldWallet').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
<<<<<<< HEAD
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
=======
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	});	
	// PURCHASE MYMI GOLD MODAL
	$('#purMyMIGoldNavbar').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
<<<<<<< HEAD
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>,
=======
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('MyMI-Gold/Purchase/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Purchase-Wallet/Fiat/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Purchase-Wallet/Digital/' . $cuID) . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Wallets/Address-Generator') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Add-Wallet/Fiat') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
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
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	});
	$('.addBankAccount').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
<<<<<<< HEAD
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
	// $('.addDebtAccount').click(function(e) {
	// 	// prevent the default action when a nav button link is clicked
	// 	e.preventDefault();

	// 	// ajax query to retrieve the HTML view without refreshing the page.
	// 	$('#loading-image').show();
	// 	$.ajax({
	// 		type: 'get',
	// 		url: <?php //echo '\'' . site_url('Budget/Add/Expense/Form') . '\''; ?>,
	// 		dataType: 'html',
	// 		beforeSend: function() {
	// 			$('#loading-content').show(); 
	// 			$('#transactionContainer').hide(); 
	// 		},
	// 		// complete: function(){
	// 		// 	$('#loading-content').hide(); 
	// 		// },
	// 		success: function (html) {
	// 		// success callback -- replace the div's innerHTML with
	// 		// the response from the server.
	// 			$('#loading-content').hide(); 
	// 			$('#transactionContainer').show(); 
	// 			$('#transactionContainer').html(html);
	// 		}
	// 	});
    //     console.log(<?php //echo '\'' . site_url('Budget/Add/Expense/Form') . '\''; ?>);
	// });	
	$('.addInvestAccount').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Wallets/Investment/Add/Account/Modal') . '\''; ?>,
			// url: <?php //echo '\'' . site_url('Wallets/Connect-Bank-Account') . '\''; ?>,
=======
			url: <?php echo '\'' . site_url('Wallets/Connect-Bank-Account') . '\''; ?>,
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Wallets/Connect-Bank-Account') . '\''; ?>);
	});	
	$('.walletSelectionFreeFiat').click(function(e) {
        // Change Transaction Modal to become large for more real estate for more content
        const transModalDialog            = document.getElementById('transModalDialog');
        transModalDialog.classList.add("modal-lg");
        transModalDialog.classList.add("testDiv");
        
=======
	});	
	$('.walletSelectionFreeFiat').click(function(e) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
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
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Wallet-Selection/Free/Fiat') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Wallet-Selection/Digital') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Announcements/Post') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Admin/Add-External-Site') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
        console.log(<?php echo '\'' . site_url('Exchange/Coin-Listing/Asset-Information-Modal/Existing') . '\''; ?>);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
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
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
