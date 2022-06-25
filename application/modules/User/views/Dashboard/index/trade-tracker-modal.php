<?php
$cuID		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<div class="modal fade" id="tradeTrackerModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content show" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="trackerContainer">
		</div>
	</div>
</div>
<script>
	$('#depositFundsBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		// ajax query to retrieve the HTML view without refreshing the page.
		$('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url('Trade-Tracker/Add-Trade' . $cuID) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#trackerContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
				// success callback -- replace the div's innerHTML with
				// the response from the server.
				$('#loading-content').hide(); 
				$('#trackerContainer').show(); 
				$('#trackerContainer').html(html);
			}
		});
	});	
	$('.closeModalBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		$('body').ajaxComplete(function() {
			$('#trackerContainer').empty();
		});
	});
	$("#transactionModal").on("hidden.bs.modal", function () {
		$('#trackerContainer').empty();
	});
</script>
