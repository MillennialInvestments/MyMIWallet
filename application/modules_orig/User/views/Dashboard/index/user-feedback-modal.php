<div class="modal fade" id="userFeedbackModal" tabindex="-1" aria-labelledby="userFeedbackModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="user-information-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Would you like to provide feedback?</h3>
                <button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nk-block pt-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php $this->load->view('User/Support/Feedback'); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>