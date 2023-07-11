<?php 
// $userAccount        = $_SESSION['allSessionData']['userAccount'];
// $cuRole             = $userAccount['cuRole'];
// if ($cuRole === 1) {
//     $modalTitle     = 'User Data Overview'; 
// } elseif ($cuRole === 4) {
//     $modalTitle     = 'Would you like to provide feedback?';
// }
?>
<div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="user-information-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">User Data Transfer</h3>
                <button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nk-block pt-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php print_r($_SESSION['allSessionData']); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>