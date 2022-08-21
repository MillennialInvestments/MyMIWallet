<?php
$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
$userID				= $pageURIC;

$this->db->from('bf_users_referral_program');
$this->db->where('user_id', $userID);
$getUserInfo		= $this->db->get();

foreach ($getUserInfo->result_array() as $userInfo) {
    $referrer_code	= $userInfo['referrer_code'];
    $user_id		= $userInfo['user_id'];
    $first_name		= $userInfo['first_name'];
    $last_name		= $userInfo['last_name'];
    $email			= $userInfo['email'];
    $phone			= $userInfo['phone'];
    $address		= $userInfo['address'];
    $city			= $userInfo['city'];
    $state			= $userInfo['state'];
    $country		= $userInfo['country'];
    $zipcode		= $userInfo['zipcode'];
    $paypal			= $userInfo['paypal'];
    $basic_code		= $userInfo['basic_code'];
    $premium_code	= $userInfo['premium_code'];
    $gold_code		= $userInfo['gold_code'];
    $other_payment	= $userInfo['other_payment'];
}
?>
<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?php echo $first_name . ' ' . $last_name; ?></h5>
				<p class="card-description">New Affilate Information</p>
				<table class="table table-default">
					<tbody>
						<?php
                        echo '
						<tr>
							<th>Name:</th>
							<td>' . $first_name . ' ' . $last_name . '</td>
						</tr>
						<tr>
							<th>Email:</th>
							<td>' . $email . '</td>
						</tr>
						<tr>
							<th>Phone:</th>
							<td>' . $phone . '</td>
						</tr>
						<tr>
							<th>Address:</th>
							<td>' . $address . '</td>
						</tr>
						<tr>
							<th>City/State:</th>
							<td>' . $city . ' ' . $state . '</td>
						</tr>  
						<tr>
							<th>Zipcode:</th>
							<td>' . $zipcode . '</td>
						</tr>
						<tr>
							<th>PayPal:</th>
							<td>' . $paypal . '</td>
						</tr>  
						<tr>
							<th>Gold PayPal ID:</th>
							<td>' . $other_payment . '</td>
						</tr>
						<tr>
							<th>Basic PayPal ID:</th>
							<td>' . $basic_code . '</td>
						</tr>
						<tr>
							<th>Premium PayPal ID:</th>
							<td>' . $premium_code . '</td>
						</tr>
						<tr>
							<th>Gold PayPal ID:</th>
							<td>' . $gold_code . '</td>
						</tr>
						<tr>
							<th>Basic Referral Link:</th>
							<td>
								<a href="https://www.mymillennialinvestments.com/Free-Trial/Basic/' . $referrer_code . '">https://www.mymillennialinvestments.com/Free-Trial/Basic/' . $referrer_code . '</a>
							</td>
						</tr>
						';
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<hr>
<?php $this->load->view('Referral_Program/includes/New_Affiliate_Procedure_Setup'); ?>
