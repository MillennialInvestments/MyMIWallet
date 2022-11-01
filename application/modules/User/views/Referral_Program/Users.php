<?php
$today 			= date("m/d/Y");
$pageURIA 		= $this->uri->segment(1);
$pageURIB 		= $this->uri->segment(2);
$pageURIC 		= $this->uri->segment(3);

if ($pageURIB === 'Applications') {
    $active		= 0;
    $pageTitle	= 'Referral Program - Applications';
} elseif ($pageURIB === 'Affiliates') {
    $active		= 1;
    $pageTitle	= 'Referral Program - Affiliates';
}
$this->db->from('bf_users_referral_program');
$this->db->where('active', $active);
$getUsers		= $this->db->get();


?>
<style>
	.statusGreen {
		background-color: green;
		color: black;
		padding: 3px;
	}
	.statusYellow {
		background-color: yellow;
		color: black;
		padding: 3px;
	}
	.statusRed {
		background-color: red;
		color: black;
		padding: 3px;
	}
</style>
<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title"><?php echo $pageTitle; ?></h5>
					<p class="card-description">Information regarding our <?php echo $pageTitle; ?></p>
					Current Date: <?php e($today); ?>
					</div>
				</div>
				<div class="row">
					<table class="table table-responsive display" id="membersOverviewDatatable">
						<thead>
							<?php
                                if ($pageURIB === 'Applications') {
                                    echo '
									<tr>
										<th>Sign-Up Date</th>
										<th>Status</th>
										<th>Referrer Code</th>
										<th>First/Last Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>City/State</th>
										<th>Actions</th>
									</tr>
									';
                                } elseif ($pageURIB === 'Affiliates') {
                                    echo '
									<tr>
										<th>Sign-Up Date</th>
										<th>Referrer Code</th>
										<th>First/Last Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>City/State</th>
										<th>Actions</th>
									</tr>
									';
                                }
                            ?>
						</thead>
						<tbody>
							<?php
                            foreach ($getUsers->result_array() as $userInfo) {
                                $basic_code	= $userInfo['basic_code'];
                                $active		= $userInfo['active'];
                                if ($basic_code !== null and $active === '0') {
                                    $status 	= '<td class="statusYellow"></td>';
                                } elseif ($basic_code !== null and $active === '1') {
                                    $status 	= '<td class="statusYellow"></td>';
                                } else {
                                    $status 	= '<td class="statusRed"></td>';
                                }
                                if ($pageURIB === 'Applications') {
                                    echo '
									<tr>      
										<td>' . $userInfo['signup_date'] . '</td>
										' . $status . '
										<td>' . $userInfo['referrer_code'] . '</td>
										<td>' . $userInfo['first_name'] . ' ' . $userInfo['last_name'] . '</td>
										<td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $userInfo['email'] . '" target="_blank">' . $userInfo['email'] . '</a></td>
										<td><a href="tel:+1' . $userInfo['phone'] . '" target="_blank">' . $userInfo['phone'] . '</a></td>
										<td>' . $userInfo['city'] . ', ' . $userInfo['state'] . '</td>
										<td>';
                                    if ($basic_code !== null) {
                                        echo '
											<a style="color: green;" href="' . site_url('Referral-Program/Activate-Affiliate/' . $userInfo['id']) . '"><i class="icon-check"></i></a>
											';
                                    } else {
                                        echo '
											<a style="color: blue;" href="' . site_url('Referral-Program/New-Affiliate-Information/' . $userInfo['id']) . '"><i class="icon-note"></i></a>
											';
                                    }
                                    echo ' 
											<a data-toggle="modal" data-target="#userModal' . $userInfo['id'] . '"><i class="icon-notebook"></i></a>
										</td>
									</tr>
									';
                                } elseif ($pageURIB === 'Affiliates') {
                                    echo '
									<tr>      
										<td>' . $userInfo['signup_date'] . '</td>
										<td>' . $userInfo['referrer_code'] . '</td>
										<td>' . $userInfo['first_name'] . ' ' . $userInfo['last_name'] . '</td>
										<td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $userInfo['email'] . '" target="_blank">' . $userInfo['email'] . '</a></td>
										<td><a href="tel:+1' . $userInfo['phone'] . '" target="_blank">' . $userInfo['phone'] . '</a></td>
										<td>' . $userInfo['city'] . ', ' . $userInfo['state'] . '</td>
										<td>                                                                                      
											<a data-toggle="modal" data-target="#userModal' . $userInfo['id'] . '"><i class="icon-notebook"></i></a>
											<a data-toggle="modal" data-target="#referralModal' . $userInfo['id'] . '"><i class="icon-people"></i></a>
										</td>
									</tr>
									';
                                }
                            }
                            ?>
						</tbody>
					</table>
				</div>
				<hr>
				<div class="row pt-3">
					<h3 class="card-title">Mailing List Resources</h3>
				</div>
				<div class="row pt-3 mb-3">
					<a class="btn btn-sm btn-primary btn-rounded" href="https://dreamhost.com" target="_target">Email Server</a>
				</div>
				<div class="row pt-3">
					<h5 class="card-title">Email Lists:</h5>
				</div>
				<div class="row">
					admin@timothyburks.com<br>
					<?php
                    $this->db->from('bf_users');
                    $this->db->where('active', 1);
                    $this->db->where('type', 'Gold');
                    $this->db->not_like('email', 'test@timothyburks.com');
                    $this->db->order_by('email', 'ASC');
                    $getGoldUsersEmails = $this->db->get();
                    foreach ($getGoldUsersEmails->result_array() as $userInfo) {
                        echo $userInfo['email'] . '<br>';
                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
        
foreach ($getUsers->result_array() as $modalInfo) {
    $modalRefCode		= $modalInfo['referrer_code'];
    echo '
	<div class="modal fade" id="userModal' . $modalInfo['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class=" modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">';
    if ($pageURIB === 'Applications') {
        echo '<h5 class="modal-title" id="exampleModalLabel">Referral Program - Application Information</h5>';
    } elseif ($pageURIB === 'Affiliates') {
        echo '<h5 class="modal-title" id="exampleModalLabel">Referral Program - Application Information</h5>';
    }
    echo '
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6 class="modal-subtitle">Contact Information</h6>
					<table class="table table-responsive">
						<tbody>
							<tr>
								<th>Membership Type:</th>
								<td>' . $modalInfo['user_type'] . '</td>
							</tr>
							<tr>
								<th>First/Last Name:</th>
								<td>' . $modalInfo['first_name'] . ' ' . $modalInfo['last_name'] . '</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $modalInfo['email'] . '" target="_blank">' . $modalInfo['email'] . '</a></td>
							</tr>
							<tr>
								<th>Phone:</th>
								<td><a href="tel:+1' . $modalInfo['phone'] . '" target="_blank">' . $modalInfo['phone'] . '</a></td>
							</tr>
							<tr>
								<th>Address:</th>
								<td>' . $modalInfo['address'] . '</td>
							</tr>
							<tr>
								<th>City/State:</th>
								<td>' . $modalInfo['city'] . ', ' . $modalInfo['state'] . '</td>
							</tr>
							<tr>
								<th>Country:</th>
								<td>' . $modalInfo['country'] . '</td>
							</tr>
							<tr>
								<th>Zipcode:</th>
								<td>' . $modalInfo['zipcode'] . '</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<h6 class="modal-subtitle">Payment Information</h6>
					<table class="table table-responsive">
						<tbody>
							<tr>
								<th>Sign-Up Date:</th>
								<td>' . $modalInfo['signup_date'] . '</td>
							</tr>
							<tr>
								<th>Referrer Code:</th>
								<td>' . $modalInfo['referrer_code'] . '</td>
							</tr>
						';
    if ($modalInfo['paypal'] !== null) {
        echo '
							<tr>
								<th>PayPal:</th>
								<td>' . $modalInfo['paypal'] . '</td>
							</tr>
							';
    }
    if ($modalInfo['basic_code'] !== null) {
        echo '
							<tr>
								<th>Basic PayPal ID:</th>
								<td><a href="https://www.mymillennialinvestments.com/Free-Trial/Basic/' . $modalInfo['referrer_code'] . '" target="_blank">' . $modalInfo['basic_code'] . '</a></td>
							</tr>
							';
    }
    if ($modalInfo['other_payment'] !== null) {
        echo '
							<tr>
								<th>Other Payment Type:</th>
								<td>' . $modalInfo['other_payment'] . '</td>
							</tr>
							';
    }
    echo '
						</tbody>
					</table>
				</div>
				<div class="modal-footer">';
                
    if ($pageURIB === 'Applications') {
        echo '
					<a type="button" class="btn btn-success" href="' . site_url('Referral-Program/Activate-Affiliate/' . $userInfo['id']) . '">Approve</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					';
    } elseif ($pageURIB === 'Affiliates') {
        echo '
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					';
    }
    echo '
				</div>
			</div>
		</div>
	</div>
	';
    if ($pageURIB === 'Affiliates') {
        foreach ($getUsers->result_array() as $referralInfo) {
            echo '
			<div class="modal fade" id="referralModal' . $referralInfo['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Affilate Referrals</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<h6 class="modal-subtitle">Referral Information</h6>
							<table class="table table-responsive" id="userReferralsDatatable">
								<thead>
									<tr>
										<th>Sign-Up Date:</th>
										<th>Membership:</th>
										<th>Email:</th>
										<th>City/State:</th>
										<th>Monthy Income:</th>
									</tr>
								</thead>
								<tbody>';
            $this->db->from('bf_users');
            $this->db->where('active', 1);
            $this->db->where('referral_code', $modalInfo['referrer_code']);
            $getReferrals	= $this->db->get();
            foreach ($getReferrals->result_array() as $refInfo) {
                $membership		= $refInfo['type'];
                if ($membership === 'Basic') {
                    $monthly_income		= '$9.50';
                }
                echo '
									<tr>
										<td>' . $refInfo['signup_date'] . '</td>
										<td>' . $membership . '</td>
										<td>' . $refInfo['email'] . '</td>
										<td>' . $refInfo['city'] . ', ' . $refInfo['state'] . '</td>
										<td>' . $monthly_income . '</td>
									</tr>
									';
            }
            echo '
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" class="text-right">Total Monthly Income:</th>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			';
        }
    }
}
?>
