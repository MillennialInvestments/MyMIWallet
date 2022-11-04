<?php
    $pageURIA							= $this->uri->segment(1);
    $pageURIB							= $this->uri->segment(2);
    $page_title							= str_replace("-", " ", $pageURIB);
    
    $getCoinValue						= $this->mymigold_model->get_coin_value();
    foreach ($getCoinValue->result_array() as $MyMIGold) {
        $initial_coin_value				= $MyMIGold['coin_value'];
        $initial_available_coins		= number_format($MyMIGold['available_coins'], 0);
        $initial_percent_increase		= 0.25;
        $initial_percent_increase_num	= $percent_increase * 100;
        $initial_new_available_coins	= $available_coins * $percent_increase;
    }
    $getInitialCoinValue				= $this->mymigold_model->get_initial_coin_value();
    foreach ($getCoinValue->result_array() as $MyMIGold) {
        $current_value					= number_format($MyMIGold['current_value'], 2);
        $coin_value						= number_format($MyMIGold['coin_value'], 8);
        $new_availability				= number_format($MyMIGold['new_availability'], 0);
    }
    $percent_increase					= 0.25;
    $percent_increase_num				= $percent_increase * 100;
    $new_available_coins				= number_format($initial_available_coins * $percent_increase * 1000000, 0);
    $package_a							= 10;
    $package_a_coins					= number_format($package_a / $coin_value, 0);
    $package_b							= 25;
    $package_b_coins					= number_format($package_b / $coin_value, 0);
    $package_c							= 50;
    $package_c_coins					= number_format($package_c / $coin_value, 0);
?>
<style>
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
	.breadcrumb{background-color: transparent !important;}
	.blog-text{font-size:1.25rem;} 
</style>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-11 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body px-5 pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/How-To-Guides'); ?>">How It Works</a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">MYMI GOLD COINS</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-5 pt-4">What is MyMI Gold?</h2>
								<p class="card-text blog-text pt-3">
									MyMI Gold is a cryptocurrency coin dedicated to gain access to our Premium Features offered at MyMI Wallet to assist in improving your Investment Accounting and determining your Total Financial Growth.
								</p>
								<p class="card-text blog-text pt-3">
									The MyMI Gold is based on the Digibyte Blockchain and currently has <strong><?php echo $available_coins; ?> Coins</strong> available to purchase and use for our Premium Features. The price of MyMI Gold is currently determined by the Total Market Cap of the Coin which is then divided by the total coins remaining for purchase. 
								</p>  
								<p class="card-text blog-text pt-3">
									Once we reached the Maximum Amount of MyMI Gold Coins that are owned by Members of MyMI Wallet, we will release an additional <strong><?php echo $percent_increase_num; ?>% (<?php echo $new_available_coins; ?> Coins)</strong> of MyMI Gold to the network to allow for additional purchases of the coin to become available for newcomers to the MyMI Wallet Platform. 
								</p>
								<p class="card-text blog-text pt-3">
									The current value of MyMI Gold is as follows: 
									<table class="table">
										<tbody>
											<tr>
												<th>Market Cap</th>
												<td>$<?php echo $current_value; ?></td>
											</tr>
											<tr>
												<th>Available Coins</th>
												<td><?php echo $new_availability; ?> Coins</td>
											</tr>
											<tr>
												<th>Current Value</th>
												<td>$<?php echo $coin_value; ?>/Coin</td>
											</tr>
										</tbody>
									</table>
								</p>     
								<h3 class="card-title display-5 pt-4">How to purchase MyMI Gold</h3>
								<p class="card-text blog-text pt-3">
									To purchase your MyMI Gold, a wallet is required to receive the coins once they are purchased and pay for Premium Features within the MyMI Wallet Platform. If you do not have a wallet, you will be prompted to generate an address that will be designated to your Membership Account. 
								</p> 
								<p class="card-text blog-text pt-3">
									Once you have a MyMI Gold Wallet Address, you will then be able to purchase MyMI Gold via the Membership Dashboard and purchase access to Premium Features to get started.
								</p>
								<h4 class="card-title display-5 pt-4">How It Works</h4>
								<p class="card-text blog-text pt-3">
									Once your purchase your MyMI Gold, you will receive your MyMI Gold in your MyMI Account to utilize within the App and access additional features. You will also be able to trade MyMI Gold with other Members on our MyMI Exchange.
								</p>
								<h5 class="card-title display-5 pt-4">Current MyMI Gold Packages</h5>
								<p class="card-text blog-text pt-3"> 
									The current value of MyMI Gold is as follows: 
									<table class="table">
										<tbody>
											<tr>
												<th>$<?php echo $package_a; ?> Bundle</th>
												<td class="text-center"><?php echo $package_a_coins; ?> MyMI Gold</td>
											</tr>
											<tr>
												<th>$<?php echo $package_b; ?> Bundle</th>
												<td class="text-center"><?php echo $package_b_coins; ?> MyMI Gold</td>
											</tr>
											<tr>
												<th>$<?php echo $package_c; ?> Bundle</th>
												<td class="text-center"><?php echo $package_c_coins; ?> MyMI Gold</td>
											</tr>
										</tbody>
									</table>
								</p>
								<h6 class="card-title display-5 pt-4">How to use MyMI Gold</h6>
								<p class="card-text blog-text pt-3">
									To use MyMI Gold, simply select the Premium Feature that you would like to purchase access to and your MyMI Gold will be sent to give you access for the allotted amount of time for each Premium Feature. 
								</p>
								<h3 class="card-title display-5 pt-4">Our Premium Features</h3>
								<p class="card-text blog-text pt-3">
									The Premium Features that we provide at MyMI Wallet include the following:
								</p>                                 
								<ul class="card-list">
									<li><a href="<?php echo site_url('Premium-Features/Wallets'); ?>">Additional Wallets (Trading Accounts)</a></li>
									<li><a href="<?php echo site_url('Premium-Features/Advanced-Trade-Tracker'); ?>">Advanced Charting Integrations</a></li>
									<li><a href="<?php echo site_url('Premium-Features/Advanced-Charting-Integration'); ?>">Advanced Trade Tracker</a></li>
									<li><a href="<?php echo site_url('Premium-Features/Brokerage-API-Integration'); ?>">Brokerage Account API Integration</a></li>
									<li><a href="<?php echo site_url('Premium-Features/Due-Diligence-Database'); ?>">Community Due Diligence Database</a></li>
								</ul>
								<h6 class="card-title display-5 pt-4">Need Additional Assistance</h6>
								<p class="card-text blog-text">
									Contact us by email via <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a> or the Social Media Links below: 
								</p>
								<?php $this->load->view('Support/Need_Assistance'); ?>
							</div>
							<div class="col-md-1 border-right px-5"></div>
							<div class="col-12 col-md-4 pl-5">
								<h6 class="card-title display-5 pt-4">Related Topics:</h6>
								<ul>
									<li>
										<a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">How to purchase MyMI Gold</a>
									</li>
									<li>
										<a href="<?php echo site_url('Premium-Features/Wallets'); ?>">How to purchase Additional Wallets</a>
									</li>
									<li>
										<a href="<?php echo site_url('Premium-Features/Advanced-Trade-Tracker'); ?>">How to use Advanced Trade Tracker</a>
									</li>
									<li>                    
										<a href="<?php echo site_url('Premium-Features/Advanced-Charting'); ?>">How to use Advanced Charting</a> 
									</li>
									<li>                             
										<a href="<?php echo site_url('Premium_Features/Brokerage-Integrations'); ?>">How to integrate Brokerage Accounts</a>
									</li>
									<li>                                                    
										<a href="<?php echo site_url('Premium-Features/Due-Diligence-Database'); ?>">How our Due Database works</a>   
									</li>
								</ul>                                       
							</div>
						</div>       
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
