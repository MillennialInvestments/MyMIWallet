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
    $package_a							= 60;
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
								<h1 class="card-title display-5">BROKERAGE API INTEGRATIONS</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-5 pt-4">What is our Brokerage API Integration?</h2>
								<p class="card-text blog-text pt-3">
									Our Brokerage API Integration allows our members to integrate their brokerage accounts into our platform. This allows our members to create Wallets for every Brokerage Account that they own, as well as automatically log the trades associated with each indiviudal brokerage accounts daily to minimize the manual labor in obtaining analytical reports regarding their Financial Growth. 
								</p>
								<hr>       
								<h3 class="card-title display-5 pt-4">How the Due Diligence Database Work?</h3>
								<p class="card-text blog-text pt-3">
									As we continue to integrate with Brokerage Accounts of all types, members will gain the ability to log into each of their individual investment/trading accounts per brokerage firm. Once authenticated and authorized, the member can pull all transactional data associated with each brokerage account into our database.    
								</p>
								<p class="card-text blog-text pt-3">
									This will provide quick analytical reports on Daily, Weekly, Monthly and Annual Performance across each of those brokerage accounts. By purchasing our Brokerage API Integration and our Advanced Trade Tracker, the combination of our Premium Feature provides the ultimate in truly defining your Financial Growth at lightening speeds.
								</p>    
								<hr> 
								<h4 class="card-title display-5 pt-4">How to access our Brokerage API</h4>
								<p class="card-text blog-text pt-3">
									In order to purchase access to Brokerage API Integration, you will need to purchase <a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">MyMI Gold Coins</a> and purchase the Premium Feature.
								</p>       
								<p class="card-text blog-text pt-3 text-center"> 
									<strong>The current cost of Due Diligence Database:</strong> 
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
										<a href="<?php echo site_url('Premium-Features/Advanced-Charting'); ?>">How to use Advanced Charting</a> 
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
