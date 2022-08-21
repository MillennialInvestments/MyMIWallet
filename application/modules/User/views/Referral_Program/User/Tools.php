<?php
// Get User ID
$currentUserID 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
// Get User Information
$this->db->from('bf_users');
$this->db->where('id', $currentUserID);
$getCurUserInfo		= $this->db->get();

foreach ($getCurUserInfo->result_array() as $curUser) {
    $referrer_code	= $curUser['referrer_code'];
}

?>
<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title">My Referral Links</h5>
						<p class="card-description">Your Assigned Referral Links to Share!</p>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-default">
							<tbody>
								<tr>
									<th>Basic Membership Referral Link</th>
									<td>
										<?php echo '<a href="https://www.mymillennialinvestments.com/Free-Trial/Basic/' . $referrer_code . '">https://www.mymillennialinvestments.com/Free-Trial/Basic/' . $referrer_code . '</a>'; ?>
									</td>
								</tr>
								<tr>
									<th>Premium Membership Referral Link</th>
									<td>
										<?php echo '<a href="https://www.mymillennialinvestments.com/Free-Trial/Premium/' . $referrer_code . '">https://www.mymillennialinvestments.com/Free-Trial/Premium/' . $referrer_code . '</a>'; ?>
									</td>
								</tr>
								<tr>
									<th>Gold Membership Referral Link</th>
									<td>
										<?php echo '<a href="https://www.mymillennialinvestments.com/Free-Trial/Gold/' . $referrer_code . '">https://www.mymillennialinvestments.com/Free-Trial/Gold/' . $referrer_code . '</a>'; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
