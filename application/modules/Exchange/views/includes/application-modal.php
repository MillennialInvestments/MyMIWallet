<?php
$cuID		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<div class="modal fade" id="coinListingApplicationModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content show" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="applicationContainer">
		</div>
	</div>
</div>
<script>	
	$('#contactAppBtn').click(function(e) {
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
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('#createAssetBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Asset-Information-Modal') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('#contactAppSubmitBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Asset-Information') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('#supportAppBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Customer-Support/Member-Request/' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('#coinDashboardBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Overview') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('#multipleAppsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();

		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Exchange/Coin-Listing/Multiple-Applications') . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#applicationContainer').hide(); 
			},
			success: function (html) {
			// success callback -- replace the div's innerHTML with
			// the response from the server.
				$('#loading-content').hide(); 
				$('#applicationContainer').show(); 
				$('#applicationContainer').html(html);
			}
		});
	});
	$('.closeModalBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		$('body').ajaxComplete(function() {
			$('#applicationContainer').empty();
		});
	});
	$("#transactionModal").on("hidden.bs.modal", function () {
		$('#applicationContainer').empty();
	});
</script>
