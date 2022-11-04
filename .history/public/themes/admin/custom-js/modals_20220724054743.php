<?php
$pageURIA                               = $this->uri->segment(1);
$pageURIB                               = $this->uri->segment(2);
$pageURIC                               = $this->uri->segment(3);
$pageURID                               = $this->uri->segment(4);
$pageURIE                               = $this->uri->segment(5);

if ($pageURIA === 'Investor-Profile') {
    echo '
    <div class="modal fade" id="createBankAccountModal" tabindex="-1" aria-labelledby="createBankAccountModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Connect a Bank Account</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">'; 
            $this->load->view('users/reset_password')
    echo '        
            </div>
        </div>
    </div>
    ';     
}