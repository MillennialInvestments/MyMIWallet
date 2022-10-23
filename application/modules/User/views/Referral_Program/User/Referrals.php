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
// Get Referrals
$this->db->from('bf_users');
$this->db->where('active', 1);
$this->db->where('referral_code', $referrer_code);
$getActiveReferrals		= $this->db->get();
?>
<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title">My Referrals</h5>
						<p class="card-description">View Information Regarding Your Current Referrals &amp; Income</p>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-default" id="userReferralsDatatable">
							<thead>
								<tr>
									<th>Sign-Up Date</th>
									<th class="text-center">Name</th>
									<th class="text-center">Membership</th>
									<th class="text-center">Monthly Income</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                    foreach ($getActiveReferrals->result_array() as $refs) {
                                        $signup_date	= $refs['signup_date'];
                                        $displayName	= $refs['display_name'];
                                        $membership		= $refs['type'];
                                        if ($membership === 'Basic') {
                                            $monthly_income		= '$9.50';
                                        } elseif ($membership === 'Premium') {
                                            $monthly_income		= '$49.50';
                                        } elseif ($membership === 'Gold') {
                                            $monthly_income		= '$74.50';
                                        }
                                        echo '
										<tr>
											<td>' . $signup_date . '</td>
											<td class="text-center">' . $displayName . '</td>
											<td class="text-center">' . $membership . '</td>
											<td class="text-center">' . $monthly_income . '</td>
										</tr>
										';
                                    }
                                ?>
							</tbody>
							<tfoot>
								<th colspan="3" class="text-right">Total Monthly Income:</th>
								<td class="text-center"></td>
							</tfoot>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
