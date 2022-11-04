<?php
$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
$refID				= $pageURIC;

$this->db->from('bf_users_referral_program');
$this->db->where('id', $refID);
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
	<div class="col-sm-12 grid-margin">
		<h4><?php echo $first_name . ' ' . $last_name; ?> - Affiliate Application</h4>
		<p class="card-description">New Affilate Setup Procedure</p>
		<hr>
		<ol>
			<li>
				<h5>Create PayPal IDs</h5>
				<h6 class="pt-5">Create New Application for Basic Membership Referrals</h6>
				<table class="table">
					<tbody>
						<tr>
							<th>App Name:</th>
							<td>MyMI Basic Membership Referral <?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Enter PayPal Client ID:</th>
							<td>Enter Client ID provided by PayPal after Application Creation</td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Configure Live Return URL:</th>
							<td>https://www.mymillennialinvestments.com/Free-Trial/Basic<?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
					</tbody>
				</table>
				
				<h6 class="pt-5">Create New Application for Premium Membership Referrals</h6>
				<table class="table">
					<tbody>
						<tr>
							<th>App Name:</th>
							<td>MyMI Premium Membership Referral <?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Enter PayPal Client ID:</th>
							<td>Enter Client ID provided by PayPal after Application Creation</td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Configure Live Return URL:</th>
							<td>https://www.mymillennialinvestments.com/Free-Trial/Premium<?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
					</tbody>
				</table>
				
				<h6 class="pt-5">Create New Application for Gold Membership Referrals</h6>
				<table class="table">
					<tbody>
						<tr>
							<th>App Name:</th>
							<td>MyMI Gold Membership Referral <?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Enter PayPal Client ID:</th>
							<td>Enter Client ID provided by PayPal after Application Creation</td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
						<tr>
							<th>Configure Live Return URL:</th>
							<td>https://www.mymillennialinvestments.com/Free-Trial/Gold<?php echo $referrer_code; ?></td>
							<td><input type="checkbox" value="">Completed?</td>
						</tr>
					</tbody>
				</table>
			</li>
		</ol>
	</div>
</div>
