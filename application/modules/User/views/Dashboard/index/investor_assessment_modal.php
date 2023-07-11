<?php
// application/views/user/assessment_status_modal.php

// // Get the user's status from the session data
// $user = $this->session->userdata('user');

// // Determine which sections have been completed
// $financial_info_completed           = $user['financial_info_completed'];
// $retirement_goals_completed         = $user['retirement_goals_completed'];
// $risk_tolerance_completed           = $user['risk_tolerance_completed'];

// Generate the message
$message = "Please complete the following sections of the Investor Assessment: ";
if (!$financial_info_completed) {
  $message .= "<br>- Financial Information";
}
if (!$retirement_goals_completed) {
  $message .= "<br>- Retirement Goals";
}
if (!$risk_tolerance_completed) {
  $message .= "<br>- Risk Tolerance";
}
?>

<div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="assessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assessmentModalLabel">Investor Assessment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $message; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Display the modal if necessary
  <?php if (!$financial_info_completed || !$retirement_goals_completed || !$risk_tolerance_completed): ?>
    $("#assessmentModal").modal('show');
  <?php endif; ?>
});
</script>
