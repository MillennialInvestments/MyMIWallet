<style>
p {font-size: 20px;}
</style>
<?php
$referrer_code	= 'MyMI2020-2';
echo'
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-2">
			</div>
			<div class="col-sm-7"></div>
			<div class="col-sm-2">
				<a class="btn btn-primary" href="https://www.mymillennialinvestments.com/Dashboard">View Account</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 p-5" style="border: 5px solid black !important; padding: 3rem !important;">
				<div class="row justify-content-center pb-3">
					<a href="https://www.mymillennialinvestments.com/Dashboard">
						<img style="width: 100%; max-width: 100%;" src="https://www.mymillennialinvestments.com/assets/images/Millennial-Investments-The-Best-In-Investments-Logo.png">
					</a>
				</div>
				<div class="row justify-content-center">
					<h2 style="text-align: center;">
						<strong>Millennial Investments</strong>
						<a href="https://www.mymillennialinvestments.com/Dashboard" target="_blank"><strong><br>Referral Program</strong></a>
					</h2>
				</div>
				<div class="row justify-content-center">
					<h3 style="text-align: center;">
						New Affiliate Application
					</h3>
				</div>
				<br>
				<br>
				<div class="row justify-content-center">
					<p>
						We have received a New Affiliate Application at Millennial Investments. Review the information below regarding the new Affiliate Applicant:
					</p>
					<table class="table">
						<tbody>
							<tr>
								<th>User ID:</th>
								<td>' . $user_id . '</td>
							</tr>
							<tr>
								<th>Referral Code:</th>
								<td>' . $referrer_code . '</td>
							</tr>
							<tr>
								<th>Sign-Up Date:</th>
								<td>' . $signup_date . '</td>
							</tr>
							<tr>
								<th>Membership:</th>
								<td>' . $user_type . '</td>
							</tr>
							<tr>
								<th>Name</th>
								<td>' . $first_name . ' ' . $last_name . '</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $email . '" target="_blank">' . $email . '</a></td>
							</tr>
							<tr>
								<th>Phone:</th>
								<td><a href="tel:+1' . $phone . '" target="_blank">' . $phone . '</a></td>
							</tr>
							<tr>
								<th>Address:</th>
								<td>' . $address . '</td>
							</tr>
							<tr>
								<th> City:</th>
								<td>' . $city . ', ' . $state . '</td>
							</tr>
							<tr>
								<th>Zipcode:</th>
								<td>' . $zipcode . '</td>
							</tr>';
							if ($paypal !== 'Yes') {
							echo '
							<tr>
								<th>PayPal</th>
								<td>Yes</td>
							</tr>
							';	
							} else {
							echo '
							<tr>
								<th>PayPal</th>
								<td>No</td>							
							</tr>
							';	
							}
							echo '
						</tbody>
					</table>
				</div>
				<br>
				<hr>
				<br>
				<div class="row justify-content-center">
					<h4>Affiliate Application Dashboard</h4>
					<p>Visit the <a href="">Referral Program Dashboard</a> to review/approve the Affiliate Application and complete the process for setting up a new account.</p>
					<a style="text-align: center" href="https://www.mymillennialinvestments.com/Referral-Program/Applications">Review Now!</a>
				</div>
				<br>
				<hr>
				<br>
				<div class="row justify-content-center">
					<p>
						<strong>Need Support?</strong> <a href="https://www.mymillennialinvestments.com/Customer-Support">Contact Us</a>.
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
';
?>
