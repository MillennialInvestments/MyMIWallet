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
    $package_a							= 20;
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
								<h1 class="card-title display-5">DUE DILIGENCE DATABASE</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-5 pt-4">What is our Due Diligence Database?</h2>
								<p class="card-text blog-text pt-3">
									Every member has the ability to track their own Due Diligence Database for free when they register a membership with MyMI Wallet. 
								</p>
								<p class="card-text blog-text pt-3">	
									By purchasing our Advance Due Diligence Database, you will receive access to our MyMI Due Diligence Database which contains information and news pretaining to individual companies and cryptocurrencies currently in the market or will be accessible in the market in the near future.
								</p>
								<p class="card-text blog-text pt-3">
									<strong>Individual Due Diligence Database</strong><br>
									Each Free Membership comes with an Individual Due Diligence Database to track every individual members DD that they submit.
								</p>
								<p class="card-text blog-text pt-3">
									<strong>Community Due Diligence Database</strong><br>
									By purchasing the Advanced Due Diligence Database, you gain access to the MyMI Community Due Diligence Database, which is compiled of other member submitted information, as well as Certified Due Diligence Information provided directly by MyMI Wallet.
								</p>
								<hr>       
								<h3 class="card-title display-5 pt-4">How the Due Diligence Database Work?</h3>
								<p class="card-text blog-text pt-3">
									Once a members obtains important information that could assist in making better investment and trading decisions, they are able to submit that information to our Due Diligence Database. Once submitted, the information can be collected over time regarding individual stocks/cryptocurrencies or the overall market to provide an all-in-one place to access information quickly.   
								</p>
								<p class="card-text blog-text pt-3">
									Our Certified Due Diligence Database is information that we provide and certify before releasing to the community. The notifications provide a Bearish or Bullish Sentiment Variable to assist in determining the effect of the catalyst on the individual company, stock, or cryptocurrency.
								</p>    
								<hr> 
								<h4 class="card-title display-5 pt-4">How to access our MyMI Due Diligence Database</h4>
								<p class="card-text blog-text pt-3">
									In order to purchase access to MyMI Due Diligence Database, you will need to purchase <a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">MyMI Gold Coins</a> and purchase the Premium Feature.
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
										<a href="<?php echo site_url('Premium_Features/Brokerage-Integrations'); ?>">How to integrate Brokerage Accounts</a>
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
