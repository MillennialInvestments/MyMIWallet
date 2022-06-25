<?php
$cuID		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="transactionContainer">
		</div>
	</div>
</div>
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
	});	
	$('.purMyMIGold').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
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
	});	
	$('.purMyMIGoldWallet').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
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
	});	
	// PURCHASE MYMI GOLD MODAL
	$('#purMyMIGoldNavbar').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
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
	});
	$('.walletSelectionFreeFiat').click(function(e) {
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
