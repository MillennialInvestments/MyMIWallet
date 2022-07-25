<style>
p {font-size: 20px;}
</style>
<?php
$referrer_code	= 'MyMI2020-2';
echo'
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
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
						Affiliate Application Approved
					</h3>
				</div>
				<br>
				<br>
				<div class="row justify-content-center">
					<p>
						We have approved your Affiliate Application at Millennial Investments. You can now start referring memberships using the link below:
					</p>
					<table class="table">
						<tbody>
							<tr>
								<th style="text-align:left;">Basic Membership Link</th>
								<td><a href="https://www.mymillennialinvestments.com/Basic/register/' . $referrer_code . '">https://www.mymillennialinvestments.com/Basic/register/' . $referrer_code . '</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>
				<hr>
				<br>';
                $this->load->view('Referral_Program/Apply/Referral_Policy');
                echo '
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
	<div class="col-sm-3"></div>
</div>
';
?>
