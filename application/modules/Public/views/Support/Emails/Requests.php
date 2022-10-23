<style>
p {font-size: 20px;}
</style>
<?php
echo'
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-2">
			</div>
			<div class="col-sm-7"></div>
			<div class="col-sm-2">
				<a class="btn btn-primary" href="https://www.mymillennialinvestments.com/Support-Management">View Account</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 p-5" style="border: 5px solid black !important; padding: 3rem !important;">
				<div class="row justify-content-center pb-3">
					<a href="https://www.mymillennialinvestments.com/Support-Management">
						<img style="width: 100%; max-width: 100%;" src="https://www.mymillennialinvestments.com/assets/images/Millennial-Investments-The-Best-In-Investments-Logo.png">
					</a>
				</div>
				<div class="row justify-content-center">
					<h2 style="text-align: center;">
						<a href="https://www.mymillennialinvestments.com/Support-Management" target="_blank"><strong>Customer Support Request Details</strong></a>
					</h2>
				</div>
				<div class="row justify-content-center">
					<div class="col-12 col-md-8 col-lg-8">
						<table class="table table-default">
							<tbody>
								<tr>
									<td><strong>Email:</strong></td>  
									<td> </td>
									<td>' . $email . '</td>
								</tr>
								<tr>
									<td><strong>Name:</strong></td>  
									<td> </td>
									<td>' . $name . '</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>	
				<div class="row justify-content-center">
					<div class="col-12 col-md-8 col-lg-8">
						<p>' . $details . '</p>
					</div>
				</div>
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
