<?php $this->load->view('Forms/Post/Add_Video', $userData); ?> 
<div class="modal show active" id="addVideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-white">
		<?php $this->load->view('Forms/Post/Add_Video'); ?>
		</div>
	</div>
</div>

<div class="modal show active" id="addTradeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-white">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Add New Stock to Stock Listings</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-0">
				<?php $this->load->view('Forms/User/Search'); ?>
			</div>
		</div>
	</div>
</div>
