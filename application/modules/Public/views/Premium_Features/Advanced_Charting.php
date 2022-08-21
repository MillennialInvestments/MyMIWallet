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
    $package_a							= 15;
    $package_a_coins					= number_format($package_a / $coin_value, 0);
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
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Premium-Features'); ?>">Premium Features</a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">ADVANCED CHARTING INTEGRATIONS</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-5 pt-4">What is Advanced Charting?</h2>
								<p class="card-text blog-text pt-3">
									All members gain access to our Interactive Standard Charts (provided by TradingView) when tracking or review their trades. By purchasing our Advanced Charting Integration, you will gain access to a full list of indicators, tools and more to accurate chart and make better investment &amp; trading decisions. 
								</p>
								<hr>       
								<h3 class="card-title display-5 pt-4">How does the Advanced Chart Work?</h3>
								<p class="card-text blog-text pt-3">
									The Advanced Charting provides a full overview of the stock or cryptocurrency that you have searched in MyMI Wallet. You also gain access to the full library of charting indicators provided by TradingView to analyze and determine the best plan of action in every trade you conduct.   
								</p>    
								<hr> 
								<h4 class="card-title display-5 pt-4">How to access our Advanced Charting</h4>
								<p class="card-text blog-text pt-3">
									In order to purchase access to Advanced Charting Integration, you will need to purchase <a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">MyMI Gold Coins</a> and purchase the Premium Feature.
								</p>       
								<p class="card-text blog-text pt-3 text-center"> 
									<strong>The current cost of Advanced Charting Integration:</strong> 
									<table class="table table-borderless">
										<thead>
											<tr>
												<th class="text-center">Cost of Wallet(s)</th>
												<th class="text-center">Total MyMI Gold Coins</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">$<?php echo $package_a; ?>/Month</td>
												<td class="text-center"><?php echo $package_a_coins; ?> MyMI Gold</td>
											</tr>
										</tbody>
									</table>
								</p>   
								<hr> 
								<?php $this->load->view('Support/Need_Assistance'); ?>
							</div>
							<div class="col-md-1 border-right px-5"></div>
							<div class="col-12 col-md-4 pl-5">
								<h2 class="card-title display-5 pt-4">Related Topics:</h2>
								<ul>
									<li>
										<a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">How to purchase MyMI Gold</a>
									</li>                        
									<li>
										<a href="<?php echo site_url('Premium-Features/Wallets'); ?>">How to use Additional Wallets</a>
									</li>
									<li>
										<a href="<?php echo site_url('Premium-Features/Advanced-Trade-Tracker'); ?>">How to use Advanced Trade Tracker</a>
									</li>
									<li>                             
										<a href="<?php echo site_url('Premium_Features/Brokerage-Integrations'); ?>">How to integrate Brokerage Accounts</a>
									</li>
									<li>                                                    
										<a href="<?php echo site_url('Premium-Features/Due-Diligence-Database'); ?>">How Community Due Database works</a>   
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
