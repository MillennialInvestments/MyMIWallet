<?php 
echo '
<div class="modal fade" id="resetUserPasswordModal" tabindex="-1" aria-labelledby="resetUserPasswordModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Connect a Bank Account</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">'; 
            $this->load->view('users/reset_password'); 
    echo '        
            </div>
        </div>
    </div>
</div>
';     
?>