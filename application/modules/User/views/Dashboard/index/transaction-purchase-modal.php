<?php
$cuID		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<div class="modal fade" id="transactionPurchaseModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="wallet-loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="transactionPurchaseContainer">
		</div>
        <!-- <div class="modal-content" id=""></div> -->
	</div>
</div>
<script>
	$('.purMyMIGoldWallet').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('MyMI-Gold/Purchase/') . $cuID . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#transactionModal').modal('hide'); 
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
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
				$('#wallet-loading-content').show(); 
				$('#transactionPurchaseContainer').hide(); 
			},
			// complete: function(){
			// 	$('#wallet-loading-content').hide(); 
			// },
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#wallet-loading-content').hide(); 
				$('#transactionPurchaseContainer').show(); 
				$('#transactionPurchaseContainer').html(html);
			}
		});
	});
	$('.closeModalBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		$('body').ajaxComplete(function() {
			$('#transactionPurchaseContainer').empty();
		});
	});
	$("#transactionModal").on("hidden.bs.modal", function () {
		$('#transactionPurchaseContainer').empty();
	});
</script>
