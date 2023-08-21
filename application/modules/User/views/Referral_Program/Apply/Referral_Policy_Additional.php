<?php
$getCoinValue	= $this->investment_model->get_coin_value();
foreach ($getCoinValue->result_array() as $coinValue) {
    $initial_value				= number_format($coinValue['coin_value'], 8);
    $sec_initial_value			= $initial_value / 2;
    $available_coins			= $coinValue['available_coins'];
    $coin_value					= $coinValue['coin_value'];
}
$getInitialCoinValue			= $this->investment_model->get_initial_coin_value();
foreach ($getInitialCoinValue->result_array() as $coinValue) {
    $first_initial_value		= $coinValue['coin_value'];
}
$MyMICoinLink                   = '<a href="' . site_url('Exchange/Market/USD/MyMI') . '">MyMI</a>';
$multiplierA                    = 1; 
$multiplierB                    = 2; 
$multiplierC                    = 4; 
$referral						= number_format($this->config->item('referral_rate'), 0);
$sec_referral					= number_format($referral * $multiplierB, 0);
$third_referral					= number_format($referral * $multiplierC, 0);
$referral_amount				= number_format(($referral / $coin_value) * $multiplierA, 0);
$sec_referral_amount			= number_format(($referral / $coin_value) * $multiplierB, 0);
$third_referral_amount			= number_format(($referral / $coin_value) * $multiplierC, 0);
$percent_change					= round((($initial_value - $first_initial_value) / $first_initial_value) * 100, 2) . '%';
if ($percent_change > 0) {
    $percentChange				= '<span class="text-green">' . $percent_change . '</span>';
} else {
    $percentChange				= '<span class="text-red">' . $percent_change . '</span>';
}
?>
<style>
.text-green {color: green;}
.text-red{color:red;}
.list-style {list-style: auto !important;}
</style>
<div class="row">
	<div class="col px-3">
		<h4 class="card-title pt-5 pb-3">Commission</h4>
		<ol class="list-style">
			<li>
				<p>
					<strong>Commission Rates:</strong> You will receive a flat-rate commission for every investor or partner your refer to MyMI Wallet. 
                    The commissions will be determined by the Amount of Transaction Fees incurred per referred user. 
                    You percentage rate will increase based on the Referral Tier that you reach.
					<br>
					<h6 class="card-title display-7 text-center">Commissions - Tier I</h6>
					<table class="table pb-3">
						<thead>
							<tr>
								<th class="text-center">Referrals:</th>
								<th class="text-center">Multiplier:</th>
								<th class="text-center">Referral Fee:</th>
								<th class="text-center">MyMI Coin Value:</th>
								<th class="text-center">Coins Received:</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">0-10</td>
								<td class="text-center"><?php echo $multiplierA; ?>X</td>
								<td class="text-center">$<?php echo $referral; ?> Per User</td>
								<td class="text-center">$<?php echo $initial_value . ' (' . $percentChange . ')'; ?></td>
								<td class="text-center"><?php echo $referral_amount; ?> <a href="<?php echo site_url('Exchange/Market/USD/MyMI'); ?>">MyMI</a></td>
							</tr>
						</tbody>
					</table>
					<br>
					<h6 class="card-title display-7 text-center">Commissions - Tier II</h6>
					<table class="table pb-3">
						<thead>
							<tr>
								<th class="text-center">Referrals:</th>
								<th class="text-center">Multiplier:</th>
								<th class="text-center">Referral Fee:</th>
								<th class="text-center">MyMI Coin Value:</th>
								<th class="text-center">Coins Received:</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">11-25</td>
								<td class="text-center"><?php echo $multiplierB; ?>X</td>
								<td class="text-center">$<?php echo $sec_referral; ?> Per User</td>
								<td class="text-center">$<?php echo $initial_value . ' (' . $percentChange . ')'; ?></td>
								<td class="text-center"><?php echo $sec_referral_amount . ' ' . $MyMICoinLink; ?></td>
							</tr>
						</tbody>
					</table>
					<br>
					<h6 class="card-title display-7 text-center">Commissions - Tier III</h6>
					<table class="table pb-3">
						<thead>
							<tr>
								<th class="text-center">Referrals:</th>
								<th class="text-center">Multiplier:</th>
								<th class="text-center">Referral Fee:</th>
								<th class="text-center">MyMI Coin Value:</th>
								<th class="text-center">Coins Received:</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">25+</td>
								<td class="text-center"><?php echo $multiplierC; ?>X</td>
								<td class="text-center">$<?php echo $third_referral; ?> Per User</td>
								<td class="text-center">$<?php echo $initial_value . ' (' . $percentChange . ')'; ?></td>
								<td class="text-center"><?php echo $third_referral_amount . ' ' . $MyMICoinLink; ?></td>
							</tr>
						</tbody>
					</table>
					<br>
					<strong>For example:</strong><br>If you refer a member and they purchase a membership, you will receive <strong><?php echo $referral_amount . ' ' . $MyMICoinLink; ?></strong> for the first 10 Members, and as long as each member keeps their account active and complete a minimum of $100 in transactions/purchases. 
                    For referrals up to 25 Members, you will receive <strong><?php echo $sec_referral_amount . ' ' . $MyMICoinLink; ?></strong> for each member as long as they meet the requirements to be consider a referral. 
                    For any referrals above 25+ Members, you will receive <strong><?php echo $third_referral_amount . ' ' . $MyMICoinLink; ?></strong> for each member thereafter.
				</p>
			</li>
			<li>
				<p class="pt-3">
					<strong>Validate Referral Limitations:</strong><br>
					<ul class="list-style pl-4">
						<li>You receive commission for the first $100 in purchases or transactions completed by a new member referral who is not in an active sales process with us at the time of the affiliate link click.</li>
						<li class="py-2">The member needs to be an active member for 30 days from the time that the member created an account utilizing the referral link that you provided.
						<br>
						<strong>For example:</strong> A member who makes a purchase on March 15th must still be a member on April 15th.</li>
						<li class="py-2">The member must utilize the Membership Registration Referral Link that will be assigned to your account upon registration and application approval using your Referral Code in order to properly track registration (e.g. we will not be able to track purchases made on our standard registration pages, etc.)</li>
						<li class="py-2">Affiliate links rely on <strong>Referral Codes</strong> to track sales so the member <strong>must</strong> use the assigned referral code assigned to you in order to provide monthly commissions from the referral.</li>
						<li>Only affiliate links can be used to track sales. Incorrect use of affiliate links will cause inability to track referrals. </li>
					</ul>
					<br>
					There are a number of other limitations that may result in commission not being paid - we encourage you to read the <a href="<?php echo site_url('Referral-Program/Marketing-Affiliate-Program-Agreement'); ?>">Marketing Affiliate Program Agreement</a> for more information on this.
				</p>
			</li>
			<li>
				<p class="pt-3">
					<strong>PayPal:</strong> Be sure to add your PayPal email or Digibyte Wallet Address to your Affiliate profile so we can send you your commissions. We pay commissions on the 25th of each month for commissions that qualified in the month prior.
				</p>
			</li>
			<li>
				<p class="pt-3">
					<strong>Attribution:</strong> In the event a single member clicks two different affiliate links, the first affiliate will receive credit for the referral once the members has met the criteria for a Verified Referral.
				</p>
			</li>
			<li>
				<p class="pt-3">
					<strong>Cookie Window:</strong> 90 days of clicking your affiliate link.
				</p>
			</li>
		</ol>
	</div>
</div>
